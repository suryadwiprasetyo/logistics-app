<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PriceUploadController extends Controller
{
    public function showForm()
    {
        return view('prices.upload_price_pdf');
    }

    public function handleUpload(Request $request)
    {
        $request->validate([
            'price_code' => 'required|string',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $priceCode = strtoupper($request->price_code);
        $file = $request->file('file');

        $filename = $priceCode . '.pdf';

        $file->storeAs('public/prices', $filename);

        return redirect()->back()->with('success', 'File harga berhasil diupload!');
    }
}
