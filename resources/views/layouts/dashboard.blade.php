<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="#" />
    <meta name="author" content="#" />
    <meta name="generator" content="Laravel" />

    <title id="page-title">Stockify</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="canonical" href="{{ request()->fullUrl() }}" />
    @if(isset($page->params['robots']))
        <meta name="robots" content="{{ $page->params['robots'] }}" />
    @endif

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png" />
    <link rel="icon" href="/favicon.ico" />
    <link rel="manifest" href="/site.webmanifest" />
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5" />
    <meta name="theme-color" content="#ffffff" />

    <!-- Dark Mode Detection -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || 
            (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

@php
    $whiteBg = isset($params['white_bg']) && $params['white_bg'];
@endphp

<body class="{{ $whiteBg ? 'bg-white dark:bg-gray-900' : 'bg-gray-50 dark:bg-gray-800' }}">
    <x-navbar-dashboard />

    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        @auth
            @switch(Auth::user()->role)
                @case('Admin')
                    <x-sidebar.admin-sidebar />
                    @break
                @case('Manajer Gudang')
                    <x-sidebar.managergudang-sidebar />
                    @break
                @case('Staff Gudang')
                    <x-sidebar.staffgudang-sidebar />
                    @break
            @endswitch
        @endauth

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main>
                @yield('content')
            </main>
            <x-footer-dashboard />
        </div>
    </div>

    <!-- Scripts -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>

    <script>
        function getLocalizedTime(offsetHours) {
            const now = new Date();
            const utc = now.getTime() + now.getTimezoneOffset() * 60000;
            return new Date(utc + offsetHours * 3600000);
        }

        function updateClock() {
            const settings = JSON.parse(localStorage.getItem('appSettings')) || {};
            const format = settings.timeFormat || '24';
            let time;

            switch (format) {
                case 'wita':
                    time = getLocalizedTime(8).toLocaleTimeString('id-ID', { hour12: false }) + ' WITA';
                    break;
                case 'wit':
                    time = getLocalizedTime(9).toLocaleTimeString('id-ID', { hour12: false }) + ' WIT';
                    break;
                case 'wib':
                    time = getLocalizedTime(7).toLocaleTimeString('id-ID', { hour12: false }) + ' WIB';
                    break;
                default:
                    time = getLocalizedTime(7).toLocaleTimeString('id-ID', { hour12: false });
            }

            const clock = document.getElementById('clock-time');
            if (clock) clock.textContent = time;
        }

        setInterval(updateClock, 1000);
        updateClock();

        document.addEventListener('DOMContentLoaded', function () {
    const settings = JSON.parse(localStorage.getItem('appSettings')) || {};
    if (settings.appName) {
        document.title = settings.appName; // tab title
        const titleEl = document.getElementById('page-title');
        if (titleEl) titleEl.textContent = settings.appName;
    }
});
</script>
