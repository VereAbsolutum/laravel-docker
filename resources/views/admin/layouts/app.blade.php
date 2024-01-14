<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://cdn.tailwindcss.com"></script>

    <title>@yield('title') - {{ config('app.name') }}</title>
</head>
<body>
    <section class="container px-4 mx-auto">
        @yield('header')
        <div class="content">
            <x-messages/>
            @yield('content')
        </div>
    </section>
</body>
</html>