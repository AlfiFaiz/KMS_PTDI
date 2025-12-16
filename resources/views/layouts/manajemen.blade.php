<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-doughnutlabel"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    @vite('resources/css/app.css')
    <title>Manajemen @yield('title')</title>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --manajemen-bg: #1e3a8a;
            /* bg-blue-900 */
            --manajemen-bg-hover: #2563eb;
            /* bg-blue-600 */
            --manajemen-text: #ffffff;
            /* putih */
            --manajemen-text-light: #e5e7eb;
            /* gray-200 */
        }

        body {
            background: #f3f4f6;
            /* bg-gray-100 */
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: var(--manajemen-bg);
            color: var(--manajemen-text);
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
        }

        .sidebar h4 {
            color: var(--manajemen-text);
            font-weight: bold;
        }

        .sidebar a {
            color: var(--manajemen-text-light);
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s ease;
        }

        .sidebar a:hover {
            background: var(--manajemen-bg-hover);
            color: var(--manajemen-text);
        }

        .content {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
            background: #f3f4f6;
        }

        .content h2 {
            color: #1e3a8a;
            font-weight: bold;
        }
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
