<nav class="fixed z-10 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
        <div class="flex items-center justify-start">
          <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar" class="p-2 text-gray-600 rounded cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            <svg id="toggleSidebarMobileClose" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          </button>
          <a href="{{ url('/') }}" class="flex ml-2 md:mr-24">
            <img id="navbar-logo" src="..." class="h-10 sm:h-12 md:h-14 w-auto mr-3" alt="Logo Aplikasi" /> 
            <span id="navbar-app-name" class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Stockify</span>
          </a>
        </div>
        <div class="flex items-center">

            <div id="clock" class="hidden sm:flex items-center mr-4 px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white font-semibold rounded-lg shadow text-base space-x-2">
  <svg class="w-5 h-5 text-gray-500 dark:text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
  </svg>
  <span id="clock-time">--:--:-- WIB</span>
</div>

            <!-- Search mobile -->
            <button id="toggleSidebarMobileSearch" type="button" class="p-2 text-gray-500 rounded-lg lg:hidden hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
              <span class="sr-only">Search</span>
            <!-- Apps -->
            <button type="button" data-dropdown-toggle="apps-dropdown" class="hidden p-2 text-gray-500 rounded-lg sm:flex hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
              <span class="sr-only">View notifications</span>
              <!-- Icon -->
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            </button>
            <!-- Dropdown menu -->
            <div class="z-20 z-50 hidden max-w-sm my-4 overflow-hidden text-base list-none bg-white divide-y divide-gray-100 rounded shadow-lg dark:bg-gray-700 dark:divide-gray-600" id="apps-dropdown">
              <div class="block px-4 py-2 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  Apps
              </div>
              <div class="grid grid-cols-3 gap-4 p-4">
                <a href="#" class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600">
                  <svg class="mx-auto mb-1 text-gray-500 w-7 h-7 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                  <div class="text-sm font-medium text-gray-900 dark:text-white">Users</div>
                </a>
                <a href="#" class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600">
                  <svg class="mx-auto mb-1 text-gray-500 w-7 h-7 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 2h10v7h-2l-1 2H8l-1-2H5V5z" clip-rule="evenodd"></path></svg>
                  <div class="text-sm font-medium text-gray-900 dark:text-white">Inbox</div>
                </a>
                <a href="#" class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600">
                  <svg class="mx-auto mb-1 text-gray-500 w-7 h-7 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>
                    <div class="text-sm font-medium text-gray-900 dark:text-white">Profile</div>
                </a>
                <a href="#" class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600">
                  <svg class="mx-auto mb-1 text-gray-500 w-7 h-7 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>
                  <div class="text-sm font-medium text-gray-900 dark:text-white">Settings</div>
                </a>
                <a href="#" class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600">
                  <svg class="mx-auto mb-1 text-gray-500 w-7 h-7 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"></path><path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                  <div class="text-sm font-medium text-gray-900 dark:text-white">Products</div>
                </a>
                <a href="#" class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600">
                  <svg class="mx-auto mb-1 text-gray-500 w-7 h-7 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                    <div class="text-sm font-medium text-gray-900 dark:text-white">Logout</div>
                </a>
              </div>
            </div>
            <button id="theme-toggle" data-tooltip-target="tooltip-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
              <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
              <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
            </button>
            <div id="tooltip-toggle" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                Toggle dark mode
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <!-- Profile -->
            <div class="flex items-center ml-3">
              <div>
                <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button-2" aria-expanded="false" data-dropdown-toggle="dropdown-2">
                  <span class="sr-only">Open user menu</span>
                  <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                </button>
              </div>
              <!-- Dropdown menu -->
              <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-2">
                <div class="px-4 py-3" role="none">
                  @auth
                  <p class="text-sm text-gray-900 dark:text-white" role="none">
                    {{ auth()->user()->name }}
                  </p>
                  <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                    {{ auth()->user()->role }}
                  </p>
                  <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                    {{ auth()->user()->email }}
                  </p>
                  @endauth
                </div>
                <ul class="py-1" role="none">
                  <li>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
                  </li>
                  <li>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
                  </li>
                  <li>
                  </li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}">
  @csrf
  <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
    Sign out
  </button>
</form>

                  </li>
                </ul>
              </div>
            </div>
          </div>
      </div>
    </div>
  </nav>  

  <script>
  // Ambil data dari localStorage
  const settings = JSON.parse(localStorage.getItem('appSettings'));

  if (settings && settings.appLogo && document.getElementById('navbar-logo')) {
    document.getElementById('navbar-logo').src = settings.appLogo;
  }
</script>

<script>
  const appSettings = JSON.parse(localStorage.getItem('appSettings'));

  if (appSettings) {
    // Update logo
    if (appSettings.appLogo && document.getElementById('navbar-logo')) {
      document.getElementById('navbar-logo').src = appSettings.appLogo;
    }

    // Update app name
    if (appSettings.appName && document.getElementById('navbar-app-name')) {
      document.getElementById('navbar-app-name').textContent = appSettings.appName;
    }
  }
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const settings = JSON.parse(localStorage.getItem('appSettings')) || {};
    
    const navbarLogo = document.getElementById('navbar-logo');
    const navbarAppName = document.getElementById('navbar-app-name');

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