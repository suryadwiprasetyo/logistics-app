@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">📨 Semua Notifikasi</h3>
    <ul class="list-group">
        @forelse ($notifications as $notification)
            <li class="list-group-item">
                <strong>{{ $notification->data['title'] ?? 'Notifikasi' }}</strong><br>
                {{ $notification->data['message'] ?? '-' }}<br>
                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
            </li>
        @empty
            <li class="list-group-item text-muted">Tidak ada notifikasi.</li>
        @endforelse
    </ul>
</div>
@endsection
