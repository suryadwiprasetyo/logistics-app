<!-- resources/views/prices/index.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Daftar Harga</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tipe</th>
                <th>File</th>
                <th>Upload Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($priceLists as $price)
                <tr>
                    <td>{{ $price->type }}</td>
                    <td><a href="{{ Storage::url($price->file_path) }}" target="_blank">Lihat File</a></td>
                    <td>{{ $price->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada file harga.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
