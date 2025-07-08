@extends('example.layouts.default.main')

@section('content')
<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto">
    <div class="w-full max-w-4xl p-6 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
        <div class="flex items-center justify-between mb-6 border-b pb-4 dark:border-gray-700">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Kebijakan Cookie
            </h1>
            <a href="{{ url()->previous() }}" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">
                &larr; Kembali
            </a>
        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400 mb-8">
            Berlaku sejak: 3 Juli 2025
        </p>

        <div class="prose prose-sm sm:prose-base max-w-none dark:prose-invert text-gray-700 dark:text-gray-300">
            
            <h2>1. Apa itu Cookie?</h2>
            <p>
                Cookie adalah file teks kecil yang disimpan di perangkat Anda saat Anda mengakses situs atau aplikasi. Cookie digunakan untuk mengingat preferensi Anda, membantu navigasi, dan meningkatkan pengalaman pengguna secara keseluruhan.
            </p>

            <h2>2. Jenis Cookie yang Kami Gunakan</h2>
            <ul>
                <li><strong>Cookie Esensial:</strong> Diperlukan agar situs kami berfungsi dengan baik (contoh: autentikasi, keamanan).</li>
                <li><strong>Cookie Fungsional:</strong> Mengingat preferensi pengguna seperti bahasa atau tema tampilan.</li>
                <li><strong>Cookie Analitik:</strong> Mengumpulkan data penggunaan agar kami dapat meningkatkan performa dan fitur.</li>
                <li><strong>Cookie Pihak Ketiga:</strong> Cookie dari layanan eksternal seperti Google Analytics atau alat integrasi lainnya.</li>
            </ul>

            <h2>3. Mengapa Kami Menggunakan Cookie?</h2>
            <p>
                Kami menggunakan cookie untuk:
            </p>
            <ul>
                <li>Mengelola sesi login Anda</li>
                <li>Mengukur penggunaan dan kinerja platform</li>
                <li>Menyediakan pengalaman yang dipersonalisasi</li>
                <li>Meningkatkan keamanan dan mencegah penyalahgunaan</li>
            </ul>

            <h2>4. Mengelola Cookie</h2>
            <p>
                Anda dapat mengatur browser Anda untuk menolak atau menghapus cookie. Namun, beberapa bagian dari platform mungkin tidak berfungsi dengan baik jika cookie dinonaktifkan. Untuk informasi lebih lanjut, silakan lihat dokumentasi browser Anda:
            </p>
            <ul>
                <li>Google Chrome</li>
                <li>Mozilla Firefox</li>
                <li>Safari</li>
                <li>Microsoft Edge</li>
            </ul>

            <h2>5. Cookie Pihak Ketiga</h2>
            <p>
                Kami dapat menggunakan layanan pihak ketiga seperti Google Analytics untuk menganalisis perilaku pengguna. Mereka juga dapat menyimpan cookie sesuai kebijakan mereka. Kami menyarankan Anda untuk membaca <a href="https://policies.google.com/technologies/cookies" target="_blank" class="text-primary-600 hover:underline dark:text-primary-500">Kebijakan Cookie Google</a>.
            </p>

            <h2>6. Perubahan Kebijakan Cookie</h2>
            <p>
                Kami dapat memperbarui kebijakan ini dari waktu ke waktu. Perubahan akan diumumkan melalui halaman ini atau melalui notifikasi platform. Tanggal revisi akan diperbarui di bagian atas halaman.
            </p>

            <h2>7. Hubungi Kami</h2>
            <p>
                Jika Anda memiliki pertanyaan tentang penggunaan cookie, hubungi kami:
            </p>
            <ul>
                <li>Email: <a href="mailto:privacy@stockify.com" class="text-primary-600 hover:underline dark:text-primary-500">privacy@stockify.com</a></li>
                <li>Phone: +62 812-2630-2018</li>
            </ul>

            <div class="mt-8 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                <p class="text-sm text-blue-800 dark:text-blue-200">
                    <strong>Catatan:</strong> Dengan menggunakan platform kami, Anda menyetujui penggunaan cookie sesuai kebijakan ini. Anda dapat mengatur ulang preferensi cookie kapan saja melalui pengaturan browser Anda.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection