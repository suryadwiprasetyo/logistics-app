<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PriceListController;
use App\Http\Controllers\AddressController;



// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Halaman dashboard default (kalau belum login based on role)
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'super') {
        return redirect('/super/dashboard');
    } elseif ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    } else {
        return redirect('/user/dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/tracking', function () {
    return view('tracking.index');
})->middleware(['auth'])->name('tracking.index');

Route::get('/tracking/redirect', function (\Illuminate\Http\Request $request) {
    $awb = $request->input('awb');
    if (!$awb) {
        return redirect()->back()->with('error', 'Nomor resi wajib diisi.');
    }

    // Ganti ini ke URL tracking vendor kamu
    $externalUrl = "https://webcsw.ocs.co.jp/csw/ECSWG0201R00003P.do?cwbno=" . urlencode($awb);
    return redirect()->away($externalUrl);
})->middleware(['auth'])->name('tracking.redirect');


Route::get('/my-price-list', [PriceListController::class, 'showForUser'])->name('prices.view')->middleware('auth');

Route::get('/my-price', function () {
    $user = auth()->user();
    $priceCode = $user->price_code;
    $filePath = public_path("prices/{$priceCode}.pdf");

    if (!file_exists($filePath)) {
        abort(404, 'File harga tidak ditemukan.');
    }

    return response()->file($filePath);
})->middleware(['auth'])->name('my.price');
    

Route::middleware(['auth'])->group(function () {
    Route::get('/prices/upload', [PriceListController::class, 'create'])->name('prices.upload.form');
    Route::post('/prices/upload', [PriceListController::class, 'store'])->name('prices.upload.store');
});

// Halaman profile
Route::middleware('auth')->group(function () {
    Route::get('/address/edit', [AddressController::class, 'edit'])->name('address.edit');
    Route::put('/address/update', [AddressController::class, 'update'])->name('address.update');
    Route::get('/price-list', [\App\Http\Controllers\PriceListController::class, 'index'])->name('price.list');
    Route::get('/price-list/upload', [\App\Http\Controllers\PriceListController::class, 'showUploadForm'])->name('price.upload.form');
    Route::post('/price-list/upload', [\App\Http\Controllers\PriceListController::class, 'upload'])->name('price.upload');
    Route::get('/shipments/upload', [\App\Http\Controllers\UploadShipmentController::class, 'showForm'])->name('shipments.upload');
    Route::post('/shipments/upload', [\App\Http\Controllers\UploadShipmentController::class, 'handleUpload'])->name('shipments.upload.handle');
    Route::get('/shipments', [\App\Http\Controllers\ShipmentController::class, 'index'])->name('shipments.index');
    Route::get('/shipments/export-csv', [\App\Http\Controllers\ShipmentController::class, 'exportCsv'])->name('shipments.export.csv');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/notifications/read/{id}', function ($id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return back();
    })->name('notifications.read');

    Route::get('/notifications/mark-all', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.markAll');

    Route::get('/notifications', function () {
        $notifications = auth()->user()->notifications()->latest()->paginate(10);
        return view('notifications.index', compact('notifications'));
    })->name('notifications.index');

    Route::get('/notifications/{id}', [\App\Http\Controllers\NotificationController::class, 'show'])->name('notifications.show');

});

// ✅ Tambahkan route dashboard sesuai role di bawah sini
Route::middleware(['auth'])->group(function () {
    Route::get('/shipments/create', [\App\Http\Controllers\ShipmentController::class, 'create'])->name('shipments.create');
    Route::post('/shipments', [\App\Http\Controllers\ShipmentController::class, 'store'])->name('shipments.store');
    Route::get('/user/dashboard', fn() => view('dashboard.user'))->name('user.dashboard');
    Route::get('/admin/dashboard', fn() => view('dashboard.admin'))->name('admin.dashboard');
    Route::get('/super/dashboard', fn() => view('dashboard.super'))->name('super.dashboard');
});

// Route untuk auth (login, register, logout, dll)
require __DIR__.'/auth.php';