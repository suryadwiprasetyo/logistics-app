@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">📦 History Kiriman</h2>
    <a href="{{ route('shipments.export.csv') }}" class="btn btn-sm btn-primary mb-3">
    Download CSV
</a>
    <table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Invoice</th>
            <th>CWB</th>
            <th>Origin</th>
            <th>Destination</th>
            <th>Tanggal</th>
            <th>Customer ID</th>
            <th>Company Name</th>
            <th>Receiver Name</th>
            <th>Type</th>
            <th>Qty</th>
            <th>Weight (gr)</th>
            <th>Subtotal (Rp)</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($shipments as $s)
            <tr>
                <td>{{ $s->invoice }}</td>
                <td>{{ $s->cwb }}</td>
                <td>{{ $s->origin }}</td>
                <td>{{ $s->destination }}</td>
                <td>{{ $s->date }}</td>
                <td>{{ $s->customer_id }}</td>
                <td>{{ $s->company_name }}</td>
                <td>{{ $s->receiver_name }}</td>
                <td>{{ $s->type }}</td>
                <td>{{ $s->qty }}</td>
                <td>{{ number_format($s->weight, 2) }}</td>
                <td>Rp {{ number_format($s->subtotal, 0, ',', '.') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="12" class="text-center">Belum ada data kiriman.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection