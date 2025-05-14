<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Logistics System') }}</title>

    <!-- KaiAdmin Fonts & Icons -->
    <link rel="stylesheet" href="{{ asset('kaiadmin/assets/css/fonts.min.css') }}">

    <!-- KaiAdmin Core CSS -->
    <link rel="stylesheet" href="{{ asset('kaiadmin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('kaiadmin/assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('kaiadmin/assets/css/kaiadmin.min.css') }}">
    
    <!-- Optional: Demo Styling (jangan pakai di produksi) -->
    <link rel="stylesheet" href="{{ asset('kaiadmin/assets/css/demo.css') }}">

    <!-- Bootstrap Icons (opsional jika ingin pakai ikon tambahan) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <!-- Sidebar -->
    @include('layouts.partials.sidebar')


    <!-- Main Content -->
    <div class="main-content" style="margin-left: 300px;">

        <!-- Topbar -->
        @include('layouts.partials.topbar')

        <div class="container-fluid mt-4">
            @yield('content')
        </div>
    </div>

    <!-- CDN jQuery & Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

<!-- Tetap panggil KaiAdmin -->
<script src="{{ asset('kaiadmin/assets/js/kaiadmin.min.js') }}"></script>

</body>
</html>
