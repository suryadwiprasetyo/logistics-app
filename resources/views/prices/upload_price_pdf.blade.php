@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Upload File Harga (PDF) Berdasarkan Price Code</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('price.upload.handle') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="price_code">Kode Harga (price_code)</label>
            <input type="text" name="price_code" id="price_code" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="file">File PDF</label>
            <input type="file" name="file" id="file" class="form-control" accept="application/pdf" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
