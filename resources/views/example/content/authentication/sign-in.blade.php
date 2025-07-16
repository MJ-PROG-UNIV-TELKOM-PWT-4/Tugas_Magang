@extends('example.layouts.default.main')

@section('content')
    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
        <a href="{{ url('/') }}" class="flex ml-2 md:mr-24">
            <img id="login-logo" src="..." class="h-10 sm:h-12 md:h-14 w-auto mr-3" alt="Logo Aplikasi" /> 
            <span id="login-app-name" class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Stockify</span>
          </a>

        <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Sign in to platform</h2>

            @if($errors->has('email'))
                <div class="p-4 text-red-700 bg-red-100 border border-red-400 rounded-lg">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <form class="mt-8 space-y-6" method="POST" action="{{ route('login.post') }}">
                @csrf

                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="name@company.com" required>
                </div>

                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 pr-10 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            required>
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200">
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                            <svg id="eyeSlashIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" name="remember" type="checkbox"
                            class="w-4 h-4 border-gray-300 rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="font-medium text-gray-900 dark:text-white">Remember me</label>
                    </div>
                    <a href="{{ route('forgot.form') }}"
                        class="ml-auto text-sm text-primary-700 hover:underline dark:text-primary-500">Forgot Password?</a>
                </div>

                @if (session('loginError'))
                    <p id="login-error" class="text-red-600 text-sm font-semibold mb-2">
                        {{ session('loginError') }}
                    </p>

                    <script>
                        setTimeout(() => {
                            const error = document.getElementById('login-error');
                            if (error) {
                                error.style.opacity = '0';
                                setTimeout(() => error.remove(), 300);
                            }
                        }, 4000);
                    </script>
                @endif

                <button type="submit"
                    class="w-full px-5 py-3 text-base font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700">
                    Login to your account
                </button>

                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    Not registered?
                    <a href="{{ route('register.form') }}"
                        class="text-primary-700 hover:underline dark:text-primary-500">Create account</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        });
    </script>


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

<script>
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

    const clock = document.getElementById('clock-time');
    if (clock) clock.textContent = time;
  }

  setInterval(updateClock, 1000);
  updateClock();
</script>
@endsection