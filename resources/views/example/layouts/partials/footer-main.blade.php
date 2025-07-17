<footer class="py-12 bg-white xl:py-24 dark:bg-gray-800">
    <div class="container px-4 mx-auto xl:px-0">
        <div class="grid gap-12 xl:grid-cols-6 xl:gap-24">
            <div class="col-span-2">
                <a href="{{ url('/') }}" class="flex ml-2 md:mr-24">
            <img id="footer-logo" src="..." class="h-10 sm:h-12 md:h-14 w-auto mr-3" alt="Logo Aplikasi" /> 
            <span id="footer-app-name" class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Stockify</span>
          </a>
                <p id="footer-app-description" class="max-w-lg mt-4 text-gray-500 dark:text-gray-400">
  Stockify adalah aplikasi web yang dirancang untuk membantu bisnis, khususnya yang memiliki gudang, dalam mengelola stok barang secara efisien dan akurat.
</p>

            </div>
            <div>
                <h3 class="mb-6 text-sm font-semibold text-gray-600 uppercase dark:text-white">Resources</h3>
                <ul>
                    <li class="mb-4">
                        <a href="https://flowbite.com" target="_blank" rel="noreferrer" class="font-normal text-gray-600 hover:underline dark:text-gray-400">Flowbite</a>
                    </li>
                    <li class="mb-4">
                        <a href="https://www.figma.com/community/file/1179442320711977498" target="_blank" rel="noreferrer" class="font-normal text-gray-600 hover:underline dark:text-gray-400">Figma</a>
                    </li>
                    <li class="mb-4">
                        <a href="https://tailwindcss.com/" target="_blank" rel="noreferrer" class="font-normal text-gray-600 hover:underline dark:text-gray-400">Tailwind CSS</a>
                    </li>
                    <li class="mb-4">
                        <a href="https://flowbite.com/blog/" target="_blank" rel="noreferrer" class="font-normal text-gray-600 hover:underline dark:text-gray-400">Blog</a>
                    </li>
                    <li class="mb-4">
                        <a href="https://flowbite.com/blocks/" target="_blank" rel="noreferrer" class="font-normal text-gray-600 hover:underline dark:text-gray-400">Blocks</a>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="mb-6 text-sm font-semibold text-gray-600 uppercase dark:text-white">Help and support</h3>
                <ul>
                    <li class="mb-4">
                        <a href="https://github.com/themesberg/flowbite-admin-dashboard" target="_blank" rel="noreferrer" class="font-normal text-gray-600 hover:underline dark:text-gray-400">GitHub Repository</a>
                    </li>
                    <li class="mb-4">
                        <a href="https://github.com/themesberg/flowbite" target="_blank" rel="noreferrer" class="font-normal text-gray-600 hover:underline dark:text-gray-400">Flowbite Library</a>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="mb-6 text-sm font-semibold text-gray-600 uppercase dark:text-white">Follow us</h3>
                <ul>
                    <li class="mb-4">
                        <a href="https://github.com/themesberg" target="_blank" rel="noreferrer" class="font-normal text-gray-600 hover:underline dark:text-gray-400">Github</a>
                    </li>
                    <li class="mb-4">
                        <a href="https://twitter.com/zoltanszogyenyi" target="_blank" rel="noreferrer" class="font-normal text-gray-600 hover:underline dark:text-gray-400">Twitter</a>
                    </li>
                    <li class="mb-4">
                        <a href="https://www.facebook.com/themesberg" target="_blank" rel="noreferrer" class="font-normal text-gray-600 hover:underline dark:text-gray-400">Facebook</a>
                    </li>
                    <li class="mb-4">
                        <a href="https://linkedin.com/company/flowbite" target="_blank" rel="noreferrer" class="font-normal text-gray-600 hover:underline dark:text-gray-400">LinkedIn</a>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="mb-6 text-sm font-semibold text-gray-600 uppercase dark:text-white">Legal</h3>
                <ul>
                    <li class="mb-4">
                        <a href="https://flowbite.com/privacy-policy/" target="_blank" rel="noreferrer" class="font-normal text-gray-600 hover:underline dark:text-gray-400">Privacy Policy</a>
                    </li>
                    <li class="mb-4">
                        <a href="https://flowbite.com/terms-and-conditions/" target="_blank" rel="noreferrer" class="font-normal text-gray-600 hover:underline dark:text-gray-400">Terms &amp; Conditions</a>
                    </li>
                    <li class="mb-4">
                        <a href="https://flowbite.com/license/" class="font-normal text-gray-600 hover:underline dark:text-gray-400">EULA</a>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="my-8 border-gray-200 lg:my-12 dark:border-gray-700">
        <span class="block text-center text-gray-600 dark:text-gray-400"> © 2025 <span id="footer-app-name" class="font-semibold">Stockify</span>. All Rights Reserved.
</span>


    </div>
</footer>

 <script>
  // Ambil data dari localStorage
  const settings = JSON.parse(localStorage.getItem('appSettings'));

  if (settings && settings.appLogo && document.getElementById('footer-logo')) {
    document.getElementById('footer-logo').src = settings.appLogo;
  }
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const settings = JSON.parse(localStorage.getItem('appSettings')) || {};

    const logoEl = document.getElementById('footer-logo');
    const nameEl = document.getElementById('footer-app-name');
    const descEl = document.getElementById('footer-app-description');

    if (settings.appLogo && logoEl) {
      logoEl.src = settings.appLogo;
    }

    if (settings.appName && nameEl) {
      nameEl.textContent = settings.appName;
    }

    if (settings.appDescription && descEl) {
      descEl.textContent = settings.appDescription;
    }
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const settings = JSON.parse(localStorage.getItem('appSettings')) || {};

    const nameEls = document.querySelectorAll('#footer-app-name');
    nameEls.forEach(el => {
      if (settings.appName) el.textContent = settings.appName;
    });
  });
</script>
