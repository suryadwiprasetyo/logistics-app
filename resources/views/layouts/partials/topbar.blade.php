<script>console.log("✅ topbar.blade.php loaded");</script>

@php
    $unreadCount = Auth::user()->unreadNotifications->count();
@endphp

<div class="dropdown me-3 d-inline-block">
    @php
        $unreadCount = Auth::user()->unreadNotifications->count();
    @endphp

    <a href="#" id="notifDropdown" data-bs-toggle="dropdown" class="position-relative">
        <i class="bi bi-bell fs-5"></i>
        @if ($unreadCount > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $unreadCount }}
            </span>
        @endif
    </a>

    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notifDropdown"
        style="z-index: 1050; min-width: 320px; max-height: 400px; overflow-y: auto;">
        @forelse (Auth::user()->unreadNotifications->take(5) as $notification)
            <li class="border-bottom px-3 py-2">
                <a href="{{ route('notifications.show', $notification->id) }}" class="text-decoration-none text-dark d-block">
                    <strong>{{ $notification->data['title'] ?? 'Notifikasi' }}</strong><br>
                    <small>{{ $notification->data['message'] ?? '-' }}</small><br>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </a>
            </li>
        @empty
            <li class="px-3 py-2 text-muted">Tidak ada notifikasi baru</li>
        @endforelse

        @if ($unreadCount > 0)
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-center" href="{{ route('notifications.index') }}">🔎 Lihat Semua</a></li>
        @endif
    </ul>
</div>

