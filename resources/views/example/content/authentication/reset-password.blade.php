@extends('example.layouts.default.main')
@section('content')
<div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
    <a href="{{ url('/') }}" class="flex ml-2 md:mr-24">
            <img id="login-logo" src="..." class="h-10 sm:h-12 md:h-14 w-auto mr-3" alt="Logo Aplikasi" /> 
            <span id="login-app-name" class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Stockify</span>
          </a>
    <!-- Card -->
    <div class="w-full max-w-xl p-6 space-y-8 bg-white rounded-lg shadow sm:p-8 dark:bg-gray-800">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            Reset your password
        </h2>
        <form class="mt-8 space-y-6" " method="POST" action="{{ route('reset.post') }}">
            @csrf
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                <input type="email" name="email" id="email" value="{{ $email }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="name@company.com" required>
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New password</label>
                <input type="password" name="password" id="password" placeholder="••••••••" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
            </div>
            <div>
                <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
            </div>
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" required>
                </div>
                <div class="ml-3 text-sm">
                    <label for="remember" class="font-medium text-gray-900 dark:text-white">I accept the <a href="#" class="text-primary-700 hover:underline dark:text-primary-500">Terms and Conditions</a></label>
                </div>
            </div>
            <button type="submit" class="w-full px-5 py-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Reset password</button>
        </form>
    </div>
</div>

<script>
  // Ambil data dari localStorage
  const settings = JSON.parse(localStorage.getItem('appSettings'));

  if (settings && settings.appLogo && document.getElementById('login-logo')) {
    document.getElementById('login-logo').src = settings.appLogo;
  }
</script>

<script>
  const appSettings = JSON.parse(localStorage.getItem('appSettings'));

  if (appSettings) {
    // Update logo
    if (appSettings.appLogo && document.getElementById('login-logo')) {
      document.getElementById('login-logo').src = appSettings.appLogo;
    }

    // Update app name
    if (appSettings.appName && document.getElementById('login-app-name')) {
      document.getElementById('login-app-name').textContent = appSettings.appName;
    }
  }
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const settings = JSON.parse(localStorage.getItem('appSettings')) || {};
    
    const navbarLogo = document.getElementById('login-logo');
    const navbarAppName = document.getElementById('login-app-name');

    if (settings.appLogo && navbarLogo) {
      navbarLogo.src = settings.appLogo;
    }

    if (settings.appName && navbarAppName) {
      navbarAppName.textContent = settings.appName;
    }
  });
</script>
@endsection
