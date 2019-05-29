<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('description')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>

<body class="@yield('page_name')_page text-center">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand">Oxford Dictionary</h3>
            </div>
        </header>

        <main role="main" class="inner cover">
            @yield('content')
        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">
                <p>&copy; 2019 Shuttlefinder.com. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <script src="{{ mix('/js/app.js') }}"></script>

</body>
</html>
