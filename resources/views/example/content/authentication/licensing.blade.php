@extends('example.layouts.default.main')

@section('content')
<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto">
    <div class="w-full max-w-4xl p-6 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
        <div class="flex items-center justify-between mb-6 border-b pb-4 dark:border-gray-700">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Lisensi
            </h1>
            <a href="{{ url()->previous() }}" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">
                &larr; Kembali
            </a>
        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400 mb-8">
            Diperbarui: 3 Juli 2025
        </p>

        <div class="prose prose-sm sm:prose-base max-w-none dark:prose-invert text-gray-700 dark:text-gray-300">
            
            <h2>1. Kepemilikan dan Hak Cipta</h2>
            <p>
                Semua konten, fitur, desain, kode sumber, dan dokumentasi dalam platform <strong>Stockify</strong> merupakan milik eksklusif <strong>PT Stockify</strong>, kecuali disebutkan lain. Hak cipta dilindungi oleh undang-undang yang berlaku di Indonesia dan internasional.
            </p>

            <h2>2. Jenis Lisensi</h2>
            <p>
                Stockify memberikan Anda lisensi terbatas, non-eksklusif, tidak dapat dipindahtangankan, dan dapat dibatalkan untuk menggunakan platform ini hanya untuk tujuan bisnis Anda sendiri sesuai dengan ketentuan layanan.
            </p>

            <h2>3. Batasan Penggunaan</h2>
            <ul>
                <li>Dilarang menyalin, mendistribusikan, memodifikasi, atau menjual bagian mana pun dari platform Stockify tanpa izin tertulis.</li>
                <li>Tidak diperbolehkan membongkar, mendekompilasi, atau merekayasa balik kode atau sistem kami.</li>
                <li>Dilarang menggunakan nama, logo, atau brand Stockify tanpa izin resmi.</li>
            </ul>

            <h2>4. Pihak Ketiga dan Lisensi Opensource</h2>
            <p>
                Platform ini dapat menggunakan perangkat lunak open-source dan pihak ketiga yang masing-masing tunduk pada lisensinya sendiri. Kami menyertakan atribusi yang sesuai dan Anda diwajibkan mematuhi syarat dari masing-masing lisensi tersebut.
            </p>

            <h2>5. Lisensi Konten Pengguna</h2>
            <p>
                Anda tetap memiliki hak atas data dan konten yang Anda unggah. Namun, Anda memberikan hak non-eksklusif kepada kami untuk menggunakan, menyimpan, dan memproses konten tersebut hanya untuk keperluan menjalankan layanan Stockify.
            </p>

            <h2>6. Pelanggaran Lisensi</h2>
            <p>
                Kami berhak menghentikan atau menangguhkan akses Anda jika terbukti melanggar ketentuan lisensi ini. Kami juga dapat mengambil tindakan hukum jika diperlukan.
            </p>

            <h2>7. Perubahan Lisensi</h2>
            <p>
                Ketentuan lisensi ini dapat diperbarui sewaktu-waktu. Perubahan akan diberitahukan melalui email atau platform. Anda disarankan untuk memeriksa halaman ini secara berkala.
            </p>

            <h2>8. Hubungi Kami</h2>
            <p>
                Untuk pertanyaan terkait lisensi atau penggunaan aset Stockify, hubungi kami:
            </p>
            <ul>
                <li>Email: <a href="mailto:license@stockify.com" class="text-primary-600 hover:underline dark:text-primary-500">license@stockify.com</a></li>
                <li>Phone: +62 812-2630-2018</li>
            </ul>

            <div class="mt-8 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                <p class="text-sm text-blue-800 dark:text-blue-200">
                    <strong>Catatan:</strong> Penggunaan platform Stockify tunduk pada lisensi ini. Pastikan Anda memahami hak dan batasan dalam menggunakan layanan dan konten yang kami sediakan.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection