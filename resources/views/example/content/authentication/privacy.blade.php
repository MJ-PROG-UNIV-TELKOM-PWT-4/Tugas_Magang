@extends('example.layouts.default.main')

@section('content')
<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto">
    <div class="w-full max-w-4xl p-6 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
        <div class="flex items-center justify-between mb-6 border-b pb-4 dark:border-gray-700">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Kebijakan Privasi
            </h1>
            <a href="{{ url()->previous() }}" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">
                &larr; Kembali
            </a>
        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400 mb-8">
            Berlaku sejak: 3 Juli 2025
        </p>

        <div class="prose prose-sm sm:prose-base max-w-none dark:prose-invert text-gray-700 dark:text-gray-300">
            
            <h2>1. Pendahuluan</h2>
            <p>
                Privasi Anda penting bagi kami. Kebijakan ini menjelaskan bagaimana <strong>PT Stockify</strong> mengumpulkan, menggunakan, menyimpan, dan melindungi informasi pribadi Anda saat menggunakan platform Stockify.
            </p>

            <h2>2. Informasi yang Kami Kumpulkan</h2>
            <ul>
                <li>Informasi identitas seperti nama, email, dan nomor telepon</li>
                <li>Informasi login dan aktivitas akun</li>
                <li>Informasi penggunaan seperti log aktivitas, IP address, dan jenis perangkat</li>
                <li>Data transaksi dan aktivitas bisnis yang Anda input ke dalam sistem</li>
            </ul>

            <h2>3. Cara Kami Menggunakan Informasi</h2>
            <p>
                Informasi Anda digunakan untuk:
            </p>
            <ul>
                <li>Menyediakan dan meningkatkan layanan kami</li>
                <li>Memberikan dukungan dan bantuan teknis</li>
                <li>Menghubungi Anda untuk keperluan layanan atau promosi</li>
                <li>Menjaga keamanan dan integritas platform</li>
            </ul>

            <h2>4. Pembagian Informasi</h2>
            <p>
                Kami <strong>tidak akan menjual</strong> data pribadi Anda. Kami hanya akan membagikan data jika:
            </p>
            <ul>
                <li>Diwajibkan oleh hukum atau proses hukum</li>
                <li>Dengan pihak ketiga yang membantu layanan kami, seperti penyedia cloud atau pembayaran, dan mereka terikat untuk menjaga kerahasiaan data</li>
                <li>Dengan persetujuan Anda</li>
            </ul>

            <h2>5. Keamanan Data</h2>
            <p>
                Kami menggunakan enkripsi, firewall, dan praktik terbaik lainnya untuk melindungi data Anda. Namun, tidak ada sistem yang 100% aman, jadi kami tidak dapat menjamin keamanan absolut.
            </p>

            <h2>6. Hak Pengguna</h2>
            <p>
                Anda memiliki hak untuk:
            </p>
            <ul>
                <li>Melihat data pribadi Anda</li>
                <li>Meminta koreksi jika ada kesalahan</li>
                <li>Meminta penghapusan data tertentu</li>
                <li>Menolak penggunaan data untuk tujuan pemasaran</li>
            </ul>

            <h2>7. Penyimpanan Data</h2>
            <p>
                Kami menyimpan data selama akun Anda aktif atau selama diperlukan untuk menjalankan layanan. Setelah itu, data dapat dihapus secara permanen.
            </p>

            <h2>8. Cookie dan Teknologi Pelacakan</h2>
            <p>
                Kami menggunakan cookie dan teknologi serupa untuk:
            </p>
            <ul>
                <li>Menganalisis penggunaan platform</li>
                <li>Meningkatkan pengalaman pengguna</li>
                <li>Menyimpan preferensi dan login Anda</li>
            </ul>

            <h2>9. Layanan Pihak Ketiga</h2>
            <p>
                Platform kami dapat menautkan ke layanan pihak ketiga. Kami tidak bertanggung jawab atas kebijakan privasi mereka. Harap baca kebijakan masing-masing pihak ketiga tersebut sebelum menggunakan layanan mereka.
            </p>

            <h2>10. Perubahan Kebijakan</h2>
            <p>
                Kami dapat memperbarui kebijakan ini kapan saja. Perubahan akan diumumkan melalui email atau notifikasi di platform. Penggunaan berkelanjutan berarti Anda menyetujui kebijakan terbaru.
            </p>

            <h2>11. Hubungi Kami</h2>
            <p>
                Jika Anda memiliki pertanyaan tentang kebijakan privasi ini, silakan hubungi kami:
            </p>
            <ul>
                <li>Email: <a href="mailto:privacy@stockify.com" class="text-primary-600 hover:underline dark:text-primary-500">privacy@stockify.com</a></li>
                <li>Phone: +62 812-2630-2018</li>
            </ul>

            <div class="mt-8 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                <p class="text-sm text-blue-800 dark:text-blue-200">
                    <strong>Catatan:</strong> Kami berkomitmen menjaga privasi dan keamanan data Anda. Bacalah kebijakan ini dengan saksama agar Anda memahami hak dan kewajiban Anda sebagai pengguna.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection