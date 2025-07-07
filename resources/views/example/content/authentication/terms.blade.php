@extends('example.layouts.default.main')

@section('content')
<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto">
    <div class="w-full max-w-4xl p-6 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
        <div class="flex items-center justify-between mb-6 border-b pb-4 dark:border-gray-700">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Syarat dan Ketentuan
            </h1>
            <a href="{{ url()->previous() }}" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">
                &larr; Kembali
            </a>
        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400 mb-8">
            Berlaku sejak: 3 Juli 2025
        </p>

        <div class="prose prose-sm sm:prose-base max-w-none dark:prose-invert text-gray-700 dark:text-gray-300">
            
            <h2>1. Tentang Ketentuan Ini</h2>
            <p>
                Dengan menggunakan platform Stockify, Anda setuju untuk mengikuti syarat dan ketentuan ini. Jika Anda tidak setuju, mohon jangan gunakan layanan kami. Ketentuan ini berlaku untuk semua pengguna platform Stockify yang dioperasikan oleh <strong>PT Stockify</strong>.
            </p>

            <h2>2. Siapa yang Boleh Menggunakan Stockify</h2>
            <p>
                Anda harus berusia minimal 18 tahun untuk menggunakan Stockify. Dengan mendaftar, Anda menyatakan bahwa semua informasi yang diberikan adalah benar dan akurat.
            </p>

            <h2>3. Akun Anda</h2>
            <p>
                Saat membuat akun, Anda bertanggung jawab untuk:
            </p>
            <ul>
                <li>Memberikan informasi yang benar dan lengkap</li>
                <li>Menjaga keamanan password Anda</li>
                <li>Memberitahu kami jika akun Anda diretas</li>
                <li>Tidak berbagi akun dengan orang lain</li>
            </ul>
            <p>
                Kami berhak menutup akun yang melanggar aturan atau memberikan informasi palsu.
            </p>

            <h2>4. Apa yang Kami Tawarkan</h2>
            <p>
                Stockify adalah platform manajemen inventori yang membantu Anda mengelola stok, supplier, dan laporan bisnis. Kami dapat menambah, mengubah, atau menghentikan fitur kapan saja tanpa pemberitahuan sebelumnya.
            </p>

            <h2>5. Pembayaran</h2>
            <p>
                Beberapa fitur Stockify memerlukan pembayaran. Biaya harus dibayar di muka dan tidak dapat dikembalikan kecuali dalam kondisi tertentu yang kami tentukan. Kami berhak mengubah harga dengan pemberitahuan 30 hari sebelumnya.
            </p>

            <h2>6. Aturan Penggunaan</h2>
            <p>
                Anda <strong>tidak boleh</strong>:
            </p>
            <ul>
                <li>Menggunakan Stockify untuk hal-hal yang melanggar hukum</li>
                <li>Mencoba meretas atau merusak sistem kami</li>
                <li>Menyalin atau mencuri konten/data dari platform</li>
                <li>Mengirim spam atau virus kepada pengguna lain</li>
                <li>Menyalahgunakan data pengguna lain</li>
                <li>Menggunakan robot atau otomasi tanpa izin</li>
            </ul>

            <h2>7. Konten Anda</h2>
            <p>
                Data dan konten yang Anda unggah tetap menjadi milik Anda. Namun, Anda memberikan izin kepada kami untuk menggunakan konten tersebut untuk menjalankan layanan Stockify. Anda bertanggung jawab memastikan konten yang diunggah tidak melanggar hak orang lain.
            </p>

            <h2>8. Hak Kekayaan Intelektual</h2>
            <p>
                Semua fitur, desain, dan teknologi Stockify adalah milik kami. Anda hanya diizinkan menggunakan platform ini sesuai dengan ketentuan yang berlaku. Dilarang menyalin, memodifikasi, atau mendistribusikan teknologi kami.
            </p>

            <h2>9. Privasi</h2>
            <p>
                Kami menghormati privasi Anda. Cara kami mengumpulkan dan menggunakan data Anda dijelaskan dalam <a href="#" class="text-primary-600 hover:underline dark:text-primary-500">Kebijakan Privasi</a> kami.
            </p>

            <h2>10. Batasan Tanggung Jawab</h2>
            <p>
                Stockify disediakan "apa adanya" tanpa jaminan apapun. Kami tidak bertanggung jawab atas:
            </p>
            <ul>
                <li>Kehilangan data atau keuntungan</li>
                <li>Gangguan layanan</li>
                <li>Kerusakan yang timbul dari penggunaan platform</li>
                <li>Tindakan pengguna lain</li>
            </ul>
            <p>
                Tanggung jawab kami maksimal sebesar biaya yang Anda bayar untuk layanan dalam 12 bulan terakhir.
            </p>

            <h2>11. Penghentian Layanan</h2>
            <p>
                Kami dapat menutup akun Anda kapan saja jika Anda melanggar ketentuan ini. Anda juga dapat menghentikan akun sendiri dengan menghubungi tim support kami. Setelah akun ditutup, Anda tidak dapat lagi mengakses data di platform.
            </p>

            <h2>12. Perubahan Ketentuan</h2>
            <p>
                Kami dapat mengubah ketentuan ini kapan saja. Perubahan akan diberitahukan melalui email atau notifikasi di platform. Jika Anda terus menggunakan Stockify setelah perubahan berlaku, berarti Anda setuju dengan ketentuan baru.
            </p>

            <h2>13. Penyelesaian Masalah</h2>
            <p>
                Jika terjadi masalah atau sengketa, kami akan berusaha menyelesaikannya dengan baik-baik. Jika tidak bisa diselesaikan, maka akan diselesaikan melalui pengadilan di Jakarta Selatan sesuai hukum Indonesia.
            </p>

            <h2>14. Lain-lain</h2>
            <p>
                Ketentuan ini adalah kesepakatan lengkap antara Anda dan kami. Jika ada bagian yang tidak berlaku, bagian lainnya tetap berlaku. Kami tidak bertanggung jawab jika terjadi hal-hal di luar kendali kami seperti bencana alam atau gangguan internet.
            </p>

            <h2>15. Hubungi Kami</h2>
            <p>
                Jika ada pertanyaan tentang ketentuan ini, silakan hubungi kami:
            </p>
            <ul>
                <li>Email: <a href="mailto:support@stockify.com" class="text-primary-600 hover:underline dark:text-primary-500">support@stockify.com</a></li>
                <li>Phone: +62 812-2630-2018</li>
            </ul>

            <div class="mt-8 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                <p class="text-sm text-blue-800 dark:text-blue-200">
                    <strong>Ringkasan:</strong> Gunakan Stockify dengan bijak, jaga keamanan akun Anda, dan patuhi aturan yang berlaku. Kami berkomitmen memberikan layanan terbaik sambil melindungi hak dan privasi semua pengguna.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection