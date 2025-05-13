<?php

namespace App\Http\Controllers;

use App\Imports\ShipmentsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class UploadShipmentController extends Controller
{
    public function showForm()
    {
        // Hanya admin & super yang bisa
        if (!in_array(Auth::user()->role, ['admin', 'super'])) {
            abort(403);
        }

        return view('shipments.upload');
    }

    public function handleUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new ShipmentsImport, $request->file('file'));

        return redirect()->route('shipments.index')->with('success', 'Data berhasil diupload!');
    }
}
