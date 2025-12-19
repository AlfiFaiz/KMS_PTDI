<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />





    <!-- Tailwind + Vite build -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --admin-bg: #1e3a8a;
            --admin-bg-hover: #2563eb;
            --admin-text: #ffffff;
            --admin-text-light: #e5e7eb;
            --admin-border: #3b82f6;
        }
        body { background: #f3f4f6; }
        .sidebar {
            width: 250px; height: 100vh;
            background: var(--admin-bg); color: var(--admin-text);
            position: fixed; top: 0; left: 0; padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.3);
        }
        .sidebar h4 { color: var(--admin-text); font-weight: bold; }
        .sidebar a {
            color: var(--admin-text-light); display: block;
            padding: 12px 20px; text-decoration: none; font-weight: 500;
            transition: 0.2s ease;
        }
        .sidebar a:hover { background: var(--admin-bg-hover); color: var(--admin-text); }
        .content { margin-left: 250px; padding: 30px; min-height: 100vh; background: #f3f4f6; }
        .content h2 { color: #1e3a8a; font-weight: bold; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <x-sidebar />

    <!-- Content -->
    <div class="content">
        <h2>@yield('page-title')</h2>
        @yield('content')


    </div>
<!-- jQuery dulu -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />




    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
   
</body>
</html>