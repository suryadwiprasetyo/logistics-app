@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>📄 Detail Notifikasi</h3>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">{{ $notification->data['title'] ?? 'Notifikasi' }}</h5>
            <p class="card-text">{{ $notification->data['message'] ?? '-' }}</p>
            @if(isset($notification->data['address']))
                <p><strong>Alamat Baru:</strong> {{ implode(', ', $notification->data['address']) }}</p>
            @endif
            <p class="text-muted"><small>Diterima: {{ $notification->created_at->diffForHumans() }}</small></p>
        </div>
    </div>

    <a href="{{ route('notifications.index') }}" class="btn btn-secondary mt-3">← Kembali ke Notifikasi</a>
</div>
@endsection