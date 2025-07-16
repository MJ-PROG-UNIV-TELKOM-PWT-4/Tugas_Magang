<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'Dashboard' }} — Stockify</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <link rel="canonical" href="{{ request()->fullUrl() }}">
  <link rel="icon" type="image/png" href="/favicon.ico">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <script>
    if (
      localStorage.getItem('color-theme') === 'dark' ||
      (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  </script>
</head>

<body class="bg-gray-50 dark:bg-gray-900">
  @php
    $rawRole = Auth::check() ? Auth::user()->role : null;
    $role = match (strtolower($rawRole)) {
        'admin' => 'admin',
        'manager gudang' => 'managergudang',
        'staff gudang' => 'staffgudang',
        default => null
    };
  @endphp

  <div class="flex pt-16 overflow-hidden">
    {{-- Sidebar komponen berdasarkan role --}}
    @if ($role === 'admin')
      <x-sidebar.admin-sidebar />
    @elseif ($role === 'managergudang')
      <x-sidebar.managergudang-sidebar />
    @elseif ($role === 'staffgudang')
      <x-sidebar.staffgudang-sidebar />
    @endif

    {{-- Main content --}}
    <div id="main-content" class="relative w-full h-full overflow-y-auto lg:ml-64">
      <main class="p-4 sm:p-6 md:p-8">
        @yield('content')
      </main>
    </div>
  </div>

  {{-- Clock Script --}}
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
  </script>

  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>
</body>
</html>
