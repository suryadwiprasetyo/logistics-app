@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">📤 Tambah Kiriman Baru</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('shipments.store') }}">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Customer</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="">-- Pilih Customer --</option>
                @foreach ($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label">Invoice</label>
                <input type="text" name="invoice" class="form-control" required>
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label">CWB</label>
                <input type="text" name="cwb" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label">Origin</label>
                <input type="text" name="origin" class="form-control" required>
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label">Destination</label>
                <input type="text" name="destination" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Kirim</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Customer ID</label>
            <input type="text" name="customer_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Company Name</label>
            <input type="text" name="company_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Receiver Name</label>
            <input type="text" name="receiver_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Type</label>
            <input type="text" name="type" class="form-control" required>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label">Qty</label>
                <input type="number" name="qty" class="form-control" required>
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label">Weight (gr)</label>
                <input type="number" name="weight" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Subtotal (Rp)</label>
            <input type="number" name="subtotal" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">💾 Simpan</button>
    </form>
@endsection
