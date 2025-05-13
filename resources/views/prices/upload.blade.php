@extends('layouts.admin')

@section('content')
    <h1>Upload File Harga</h1>

    <form action="{{ route('price.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>User ID:</label>
            <input type="number" name="user_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Label (misal: PUB_25):</label>
            <input type="text" name="label" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>File PDF:</label>
            <input type="file" name="file" accept="application/pdf" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
@endsection
