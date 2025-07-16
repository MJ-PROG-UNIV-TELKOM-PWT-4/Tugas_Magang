@extends('layouts.dashboard')

@section('content')
<div class="p-4 bg-white block border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Pengaturan Aplikasi</h1>

    <form id="appSettingsForm" class="space-y-6">

        <!-- Logo App -->
        <!-- Logo App -->
<div>
  <label for="appLogo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Logo Aplikasi</label>
  <div class="flex items-start space-x-4">
    <img id="logoPreview" src="" alt="Logo Aplikasi" class="h-16 w-16 rounded-lg object-cover border border-gray-300 dark:border-gray-600">
    <div class="flex flex-col w-full space-y-2">
      <input type="file" id="appLogo" name="appLogo" accept="image/*" class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600">
      <input type="url" id="appLogoUrl" name="appLogoUrl" placeholder="Atau tempel URL gambar..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    </div>
  </div>
</div>

        <!-- Nama Aplikasi -->
        <div>
            <label for="appName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Aplikasi</label>
            <input type="text" id="appName" name="appName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Masukkan nama aplikasi" NULLABLE>
        </div>

        <!-- Deskripsi Aplikasi -->
<div>
    <label for="appDescription" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Aplikasi</label>
    <textarea id="appDescription" name="appDescription" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Contoh: Aplikasi untuk membantu manajemen stok barang."></textarea>
</div>


        <!-- Format Waktu -->
        <div>
            <label for="timeFormat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Format Waktu</label>
            <select id="timeFormat" name="timeFormat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
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
  const appDescriptionInput = document.getElementById('appDescription');


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
    if (settings.appDescription) appDescriptionInput.value = settings.appDescription;
    if (settings.timeFormat) timeFormatSelect.value = settings.timeFormat;
    if (settings.appLogo) logoPreview.src = settings.appLogo;
    else logoPreview.src = "https://cdn-icons-png.flaticon.com/128/3638/3638928.png"; // default
  });

  // Preview logo
  // Preview saat file diunggah
appLogoInput.addEventListener('change', function () {
  const [file] = this.files;
  if (file) {
    logoPreview.src = URL.createObjectURL(file);
    appLogoUrl.value = ''; // kosongkan URL jika file dipilih
  }
});

// Preview saat user masukkan URL
appLogoUrl.addEventListener('input', function () {
  if (this.value.trim() !== '') {
    logoPreview.src = this.value.trim();
    appLogoInput.value = ''; // kosongkan file jika URL dimasukkan
  }
});


  // Submit form to save settings
  form.addEventListener('submit', function (e) {
  e.preventDefault();
  const urlInput = appLogoUrl.value.trim();
  const file = appLogoInput.files[0];

  const saveSettings = (logo) => {
  const settings = {
    appName: appNameInput.value,
    appDescription: appDescriptionInput.value,
    appLogo: logo,
    timeFormat: timeFormatSelect.value
  };

  localStorage.setItem('appSettings', JSON.stringify(settings));
  alert('Pengaturan berhasil disimpan!');
  updateClock();
  location.reload(); // Refresh agar perubahan langsung kelihatan
};


  if (file) {
    const reader = new FileReader();
    reader.onloadend = function () {
      saveSettings(reader.result);
    };
    reader.readAsDataURL(file);
  } else if (urlInput !== '') {
    function isImageUrl(url) {
  return /\.(jpg|jpeg|png|webp|gif|bmp|svg)$/i.test(url);
}
    saveSettings(urlInput);
  } else {
    saveSettings(logoPreview.src);
  }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const settings = JSON.parse(localStorage.getItem('appSettings')) || {};

  // Sinkron logo
  const logoEls = document.querySelectorAll('#navbar-logo, #footer-logo, #login-logo');
  logoEls.forEach(el => {
    if (settings.appLogo) {
      el.src = settings.appLogo;
      el.onerror = () => {
        el.src = '/fallback-logo.png';
      };
    }
  });

  // Sinkron nama aplikasi
  const nameEls = document.querySelectorAll('#navbar-app-name, #footer-app-name, #login-app-name');
  nameEls.forEach(el => {
    if (settings.appName) el.textContent = settings.appName;
  });

  // Sinkron deskripsi aplikasi
  const descEl = document.querySelector('#footer-app-description');
  if (descEl && settings.appDescription) {
    descEl.textContent = settings.appDescription;
  }

  // Judul tab browser
  if (settings.appName) document.title = settings.appName;
});
</script>

@endsection