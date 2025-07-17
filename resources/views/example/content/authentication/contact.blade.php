@extends('example.layouts.default.main')

@section('content')
<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto">
    <div class="w-full max-w-4xl p-6 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
        <div class="flex items-center justify-between mb-6 border-b pb-4 dark:border-gray-700">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Hubungi Kami
            </h1>
            <a href="{{ url()->previous() }}" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">
                &larr; Kembali
            </a>
        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400 mb-8">
            Jika Anda memiliki pertanyaan, masukan, atau membutuhkan bantuan, Anda dapat menghubungi kami melalui informasi di bawah ini.
        </p>

        <div class="prose prose-sm sm:prose-base max-w-none dark:prose-invert text-gray-700 dark:text-gray-300">
            
            <h2>📧 Email</h2>
            <ul>
                <li><strong>Support:</strong> <a href="mailto:support@stockify.com" class="text-primary-600 hover:underline dark:text-primary-500">support@stockify.com</a></li>
                <li><strong>Privasi:</strong> <a href="mailto:privacy@stockify.com" class="text-primary-600 hover:underline dark:text-primary-500">privacy@stockify.com</a></li>
                <li><strong>Lisensi:</strong> <a href="mailto:license@stockify.com" class="text-primary-600 hover:underline dark:text-primary-500">license@stockify.com</a></li>
            </ul>

            <h2>📞 Telepon</h2>
            <ul>
                <li>+62 812-2630-2018 (Senin – Jumat, 09.00 – 17.00 WIB)</li>
            </ul>

            <h2>📍 Alamat Kantor</h2>
            <p>
                PT Stockify<br>
                Gg. Bimo Gg. Ontoseno No.77,Jaranan, Karangjambe, Kec.Banguntapan, Kabupaten Bantul<br>
                Daerah Istimewa Yogyakarta 55198<br>
                Indonesia
            </p>

            <div class="mt-8 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                <p class="text-sm text-blue-800 dark:text-blue-200">
                    Kami akan merespons semua pertanyaan Anda secepat mungkin. Terima kasih telah menggunakan layanan Stockify.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
