@extends('layouts.dashboard')
@section('content')
        @php
    use Carbon\Carbon;

    // Fungsi untuk membangkitkan array minggu dari bulan tertentu
    function generateWeeks($bulan, $tahun = null)
    {
        $tahun = $tahun ?? Carbon::now()->year;

        $weeks = [];
        $startOfMonth = Carbon::create($tahun, $bulan, 1)->startOfMonth();
        $endOfMonth = Carbon::create($tahun, $bulan, 1)->endOfMonth();
        $current = $startOfMonth->copy()->startOfWeek(Carbon::MONDAY); // mulai dari Senin

        while ($current <= $endOfMonth) {
            $weekStart = $current->copy();
            $weekEnd = $current->copy()->endOfWeek(Carbon::SUNDAY); // sampai Minggu

            $weeks[] = [
                'label' => 'Minggu ' . $weekStart->format('d M') . ' - ' . $weekEnd->format('d M'),
                'start' => $weekStart->format('Y-m-d'),
                'end' => $weekEnd->format('Y-m-d'),
            ];

            $current->addWeek(); // lanjut ke minggu berikutnya
        }

        return $weeks;
    }

    // Generate minggu berdasarkan bulan untuk 3 laporan
    $stokWeeks = generateWeeks($stokBulan ?? now()->month);
    $transWeeks = generateWeeks($transBulan ?? now()->month);
    $logWeeks = generateWeeks($logBulan ?? now()->month);
        @endphp

        <!-- Laporan Stok Barang -->
        <div
            class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Laporan Stok Barang</h1>

            <form action="{{ route('laporan.index') }}" method="GET" class="flex items-center gap-2">
                {{-- Keep filter lain tetap aktif --}}
                @if(request('trans_week')) <input type="hidden" name="trans_week" value="{{ request('trans_week') }}"> @endif
                @if(request('trans_bulan')) <input type="hidden" name="trans_bulan" value="{{ request('trans_bulan') }}"> @endif
                @if(request('log_week')) <input type="hidden" name="log_week" value="{{ request('log_week') }}"> @endif
                @if(request('log_bulan')) <input type="hidden" name="log_bulan" value="{{ request('log_bulan') }}"> @endif

                {{-- Filter Bulan --}}
                <label class="text-sm font-medium text-gray-700 dark:text-white">Periode:</label>
                <select name="stok_bulan" id="stok_bulan"
                    class="text-sm px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white"
                    onchange="this.form.submit()">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('stok_bulan') == $i ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>

                {{-- Filter Minggu --}}
                <select name="stok_week" id="stok_week"
                    class="text-sm px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white"
                    onchange="this.form.submit()">
                    <option value="">-- Semua --</option>
                    @foreach($stokWeeks as $week)
                        <option value="{{ $week['start'] }}|{{ $week['end'] }}" {{ request('stok_week') == $week['start'] . '|' . $week['end'] ? 'selected' : '' }}>
                            {{ $week['label'] }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        {{-- Tabel stok --}}
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Nama
                                        Produk</th>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">
                                        Kategori</th>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Masuk
                                    </th>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">
                                        Keluar</th>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Sisa
                                    </th>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Stok
                                        Minimum</th>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @foreach($laporan as $product)
                                    @php
                                        $barangMasuk = $product->barang_masuk ?? 0;
                                        $barangKeluar = $product->barang_keluar ?? 0;
                                        $minimumStock = $product->minimum_stock ?? 0;
                                        $sisaStok = $barangMasuk - $barangKeluar;

                                        // Tentukan status stok berdasarkan logika
                                        if ($sisaStok <= 0) {
                                            $status = 'Habis';
                                            $statusColor = 'text-red-500';
                                        } elseif ($sisaStok <= $minimumStock + 10) {
                                            $status = 'Hampir Habis';
                                            $statusColor = 'text-yellow-500';
                                        } else {
                                            $status = 'Tersedia';
                                            $statusColor = 'text-green-500';
                                        }
                                    @endphp
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->name }}</td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->kategori ?? '-' }}
                                        </td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $barangMasuk }}</td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $barangKeluar }}</td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $sisaStok }}</td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $minimumStock }}</td>
                                        <td class="p-4 text-sm font-semibold {{ $statusColor }}">{{ $status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Transaksi -->
        <div
            class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Laporan Transaksi Barang</h1>
            <form action="{{ route('laporan.index') }}" method="GET" class="flex items-center gap-2">
                @if(request('stok_week')) <input type="hidden" name="stok_week" value="{{ request('stok_week') }}"> @endif
                @if(request('stok_bulan')) <input type="hidden" name="stok_bulan" value="{{ request('stok_bulan') }}"> @endif
                @if(request('log_week')) <input type="hidden" name="log_week" value="{{ request('log_week') }}"> @endif
                @if(request('log_bulan')) <input type="hidden" name="log_bulan" value="{{ request('log_bulan') }}"> @endif

                <label class="text-sm font-medium text-gray-700 dark:text-white">Periode:</label>
                <select name="trans_bulan" id="trans_bulan"
                    class="text-sm px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white"
                    onchange="this.form.submit()">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('trans_bulan') == $i ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>

                <select name="trans_week" id="trans_week"
                    class="text-sm px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white"
                    onchange="this.form.submit()">
                    <option value="">-- Semua --</option>
                    @foreach($transWeeks as $week)
                        <option value="{{ $week['start'] }}|{{ $week['end'] }}" {{ request('trans_week') == $week['start'] . '|' . $week['end'] ? 'selected' : '' }}>
                            {{ $week['label'] }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        {{-- Tabel transaksi --}}
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Nama Produk</th>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Tipe</th>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Tanggal</th>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @foreach($riwayatTransaksi as $product)
                                    <tr>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->name }}</td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->tipe }}</td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->tanggal }}</td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->jumlah }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <!-- Riwayat Aktivitas -->
        <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Riwayat Aktivitas</h1>
            <form action="{{ route('laporan.index') }}" method="GET" class="flex items-center gap-2">
                @if(request('stok_week')) <input type="hidden" name="stok_week" value="{{ request('stok_week') }}"> @endif
                @if(request('stok_bulan')) <input type="hidden" name="stok_bulan" value="{{ request('stok_bulan') }}"> @endif
                @if(request('trans_week')) <input type="hidden" name="trans_week" value="{{ request('trans_week') }}"> @endif
                @if(request('trans_bulan')) <input type="hidden" name="trans_bulan" value="{{ request('trans_bulan') }}"> @endif

                <label class="text-sm font-medium text-gray-700 dark:text-white">Periode:</label>
                <select name="log_bulan" id="log_bulan"
                    class="text-sm px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white"
                    onchange="this.form.submit()">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('log_bulan') == $i ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>

                <select name="log_week" id="log_week"
                    class="text-sm px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white"
                    onchange="this.form.submit()">
                    <option value="">-- Semua --</option>
                    @foreach($logWeeks as $week)
                        <option value="{{ $week['start'] }}|{{ $week['end'] }}" {{ request('log_week') == $week['start'] . '|' . $week['end'] ? 'selected' : '' }}>
                            {{ $week['label'] }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        {{-- Tabel aktivitas --}}
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">User</th>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Aksi</th>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Waktu</th>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Detail</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @foreach($riwayatUser as $aktivitas)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $aktivitas->user->name ?? '-' }}</td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ ucfirst($aktivitas->action) }}</td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $aktivitas->created_at }}</td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $aktivitas->notes ?? "Tipe: $aktivitas->target_type, ID: $aktivitas->target_id" }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Script untuk reset filter minggu saat bulan berubah --}}
        <script>
            document.querySelectorAll('select[id$="_bulan"]').forEach(select => {
                select.addEventListener('change', function () {
                    const form = this.closest('form');
                    const weekSelect = form.querySelector('select[id$="_week"]');
                    if (weekSelect) {
                        weekSelect.selectedIndex = 0; // reset minggu ke "-- Semua --"
                    }
                });
            });
        </script>

@endsection
