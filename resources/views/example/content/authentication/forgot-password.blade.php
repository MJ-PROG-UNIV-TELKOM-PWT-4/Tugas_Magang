@extends('example.layouts.default.main')
@section('content')
    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
        <a href="{{ url('/') }}" class="flex ml-2 md:mr-24">
            <img id="login-logo" src="..." class="h-10 sm:h-12 md:h-14 w-auto mr-3" alt="Logo Aplikasi" /> 
            <span id="login-app-name" class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Stockify</span>
          </a>
        <!-- Card -->
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800">
            <div class="w-full p-6 sm:p-8">
                <h2 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">
                    Forgot your password?
                </h2>
                <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                    Don't fret! Just type in your email and we will send you a code to reset your password!
                </p>
                <form class="mt-8 space-y-6" method="POST" action="{{ route('forgot.post') }}">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="name@company.com" required>
                        @error('email')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="remember" aria-describedby="remember" name="remember" type="checkbox"
                                class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
                                required>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="remember" class="font-medium text-gray-900 dark:text-white">I accept the <a href="#"
                                    class="text-primary-700 hover:underline dark:text-primary-500">Terms and
                                    Conditions</a></label>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full px-5 py-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Reset
                        password</button>
                    <button type="button"
                        onclick="window.location='{{ route('login.form') }}'" class="w-full px-5 py-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Back</button>
                </form>
            </div>
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