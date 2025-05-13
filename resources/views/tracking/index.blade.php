@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">📮 Lacak Kiriman</h4>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('tracking.redirect') }}" method="GET" class="row g-3">
        <div class="col-md-6">
            <label for="awb" class="form-label">Masukkan Nomor Resi</label>
            <input type="text" name="awb" id="awb" class="form-control" required placeholder="Contoh: 45500123456">
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Lacak Sekarang</button>
        </div>
    </form>
</div>
@endsection
