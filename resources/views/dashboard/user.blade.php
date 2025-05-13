@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">📊 Dashboard User</h2>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>

    <p class="text-muted">Gunakan menu di sidebar untuk mengakses fitur seperti history kiriman, pengaturan, dan lainnya.</p>
@endsection
