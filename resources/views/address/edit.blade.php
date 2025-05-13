@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Alamat</h2>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('address.update') }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="address_line" class="form-label">Alamat Lengkap</label>
            <input type="text" name="address_line" id="address_line" class="form-control" value="{{ old('address_line', $address->address_line) }}" required>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Kota</label>
            <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $address->city) }}" required>
        </div>

        <div class="mb-3">
            <label for="province" class="form-label">Provinsi</label>
            <input type="text" name="province" id="province" class="form-control" value="{{ old('province', $address->province) }}" required>
        </div>

        <div class="mb-3">
            <label for="postal_code" class="form-label">Kode Pos</label>
            <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ old('postal_code', $address->postal_code) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
