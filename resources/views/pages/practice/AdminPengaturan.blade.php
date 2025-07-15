@extends('layouts.dashboard')

@section('content')
<div class="p-6 max-w-3xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-md">
    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Pengaturan Aplikasi</h2>

    <form id="appSettingsForm" class="space-y-6">

        <!-- Logo App -->
        <div>
            <label for="appLogo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Logo Aplikasi</label>
            <div class="flex items-center space-x-4">
                <img id="logoPreview" src="" alt="Logo Aplikasi" class="h-16 w-16 rounded-lg object-cover border border-gray-300 dark:border-gray-600">
                <input type="file" id="appLogo" name="appLogo" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600">
            </div>
        </div>

        <!-- Nama Aplikasi -->
        <div>
            <label for="appName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Aplikasi</label>
            <input type="text" id="appName" name="appName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Masukkan nama aplikasi" NULLABLE>
        </div>

        <!-- Format Waktu -->
        <div>
            <label for="timeFormat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Format Waktu</label>
            <select id="timeFormat" name="timeFormat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="24">24 Jam</option>
                <option value="12">12 Jam</option>
                <option value="wib">WIB</option>
                <option value="wita">WITA</option>
                <option value="wit">WIT</option>
            </select>
        </div>

        <!-- Tombol Simpan -->
        <div class="flex justify-end">
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">Simpan Perubahan</button>
        </div>

    </form>
</div>

<!-- Realtime Clock (Optional Display) -->
<div class="text-center mt-4 text-gray-700 dark:text-gray-300">
    <span id="clock-time" class="font-mono text-lg"></span>
</div>

<!-- Scripts -->
<script>
  // ELEMENTS
  const form = document.getElementById('appSettingsForm');
  const timeFormatSelect = document.getElementById('timeFormat');
  const appNameInput = document.getElementById('appName');
  const appLogoInput = document.getElementById('appLogo');
  const logoPreview = document.getElementById('logoPreview');
  const clockTimeSpan = document.getElementById('clock-time');

  // Helper: Get local time based on offset
  function getLocalizedTime(offsetHours) {
      const now = new Date();
      const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
      return new Date(utc + (offsetHours * 3600000));
  }

  function updateClock() {
    const settings = JSON.parse(localStorage.getItem('appSettings')) || {};
    const format = settings.timeFormat || '24';
    let time;

    switch (format) {
        case '12':
            time = getLocalizedTime(7).toLocaleTimeString('en-US', { hour12: true });
            break;
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

    if (clockTimeSpan) clockTimeSpan.textContent = time;
  }

  // Update every second
  setInterval(updateClock, 1000);
  updateClock();

  // Load settings from localStorage
  window.addEventListener('DOMContentLoaded', () => {
    const settings = JSON.parse(localStorage.getItem('appSettings')) || {};

    if (settings.appName) appNameInput.value = settings.appName;
    if (settings.timeFormat) timeFormatSelect.value = settings.timeFormat;
    if (settings.appLogo) logoPreview.src = settings.appLogo;
    else logoPreview.src = "https://cdn-icons-png.flaticon.com/128/3638/3638928.png"; // default
  });

  // Preview logo
  appLogoInput.addEventListener('change', function () {
    const [file] = this.files;
    if (file) {
        logoPreview.src = URL.createObjectURL(file);
    }
  });

  // Submit form to save settings
  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const reader = new FileReader();
    const file = appLogoInput.files[0];

    reader.onloadend = function () {
      const settings = {
        appName: appNameInput.value,
        timeFormat: timeFormatSelect.value,
        appLogo: file ? reader.result : logoPreview.src
      };

      localStorage.setItem('appSettings', JSON.stringify(settings));
      alert('Pengaturan berhasil disimpan!');
      updateClock();
    };

    if (file) {
      reader.readAsDataURL(file);
    } else {
      // No new file selected, use current preview
      const settings = {
        appName: appNameInput.value,
        timeFormat: timeFormatSelect.value,
        appLogo: logoPreview.src
      };
      localStorage.setItem('appSettings', JSON.stringify(settings));
      alert('Pengaturan berhasil disimpan!');
      updateClock();
    }
  });
</script>
@endsection