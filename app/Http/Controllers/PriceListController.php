<?php

namespace App\Http\Controllers;

use App\Models\PriceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PriceListController extends Controller
{
    public function index()
    {
        $priceLists = PriceList::where('user_id', Auth::id())->get();
        return view('prices.index', compact('priceLists'));
    }

    public function showUploadForm()
    {
        return view('prices.upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'label' => 'required|string',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $filePath = $request->file('file')->store('price_lists', 'public');

        PriceList::create([
            'user_id' => $request->user_id,
            'label' => $request->label,
            'file_path' => $filePath,
        ]);

        return redirect()->route('price.list')->with('success', 'File harga berhasil diupload.');
    }
    public function showForUser()
{
    $userId = auth()->id();
    $filePath = storage_path("app/public/prices/user_{$userId}/price_list.pdf");

    if (!file_exists($filePath)) {
        return redirect()->back()->with('error', 'File harga belum tersedia.');
    }

    return response()->file($filePath);
}

}
