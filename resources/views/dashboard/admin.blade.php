@extends('layouts.admin')

@section('content')

    <h2 class="mb-4">👨‍💼 Dashboard Admin</h2>
    <p>Selamat datang, {{ Auth::user()->name }} (ADMIN)</p>

    <div class="mt-4">
        <a href="{{ route('shipments.create') }}" class="btn btn-primary">
            📤 Tambah Kiriman
        </a>
    </div>
@endsection
