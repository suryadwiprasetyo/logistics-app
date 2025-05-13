<!-- Sidebar Start -->
<nav class="sidebar bg-dark">
    <div class="sidebar-header text-center py-4">
        <a href="#" class="text-white h4 mb-0">LogisticsApp</a>
    </div>

    <ul class="list-unstyled components">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link text-white">
                <i class="bi bi-house-door me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('shipments.index') }}" class="nav-link text-white">
                <i class="bi bi-box-seam me-2"></i> History Kiriman
            </a>
        </li>
        @if(Auth::user()->role === 'user')
    <li class="nav-item">
        <a href="{{ route('my.price') }}" class="nav-link text-white">
            <i class="bi bi-file-earmark-text me-2"></i> Lihat Harga Saya
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('address.edit') }}" class="nav-link text-white">
            <i class="bi bi-geo-alt me-2"></i> Ubah Alamat
        </a>
    </li>

@endif

<li class="nav-item">
    <a href="{{ route('tracking.index') }}" class="nav-link text-white">
        <i class="bi bi-search me-2"></i> Tracking Kiriman
    </a>
</li>


        @if(in_array(Auth::user()->role, ['admin', 'super']))

        <li class="nav-item">
            <a href="{{ route('shipments.create') }}" class="nav-link text-white">
                <i class="bi bi-upload me-2"></i> Tambah Kiriman
            </a>
        </li>

        <li class="nav-item">
    <a href="{{ route('address.edit') }}" class="nav-link text-white">
        <i class="bi bi-geo-alt me-2"></i> Manajemen Alamat
    </a>
</li>
    @endif

        <li class="nav-item">
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="nav-link text-white">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>
<!-- Sidebar End -->
