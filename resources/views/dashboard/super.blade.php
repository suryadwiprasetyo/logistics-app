<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard User</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">@if (auth()->user()->unreadNotifications->count())
    <div class="mb-4 p-4 bg-blue-100 border border-blue-300 rounded">
        @foreach (auth()->user()->unreadNotifications as $notification)
            <div class="mb-3">
                <strong>{{ $notification->data['title'] }}</strong><br>
                {{ $notification->data['message'] }}<br>
                <small>Alamat Baru: {{ implode(', ', $notification->data['address']) }}</small>
            </div>
        @endforeach
        @php auth()->user()->unreadNotifications->markAsRead(); @endphp
    </div>
@endif
Selamat datang, SUPER 👋</div>
            </div>
        </div>
    </div>
</x-app-layout>
