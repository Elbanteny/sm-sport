@extends('layouts.app')

@section('title', 'Form Pemesanan Lapangan - SM Sport Center')

@section('content')
<section class="relative min-h-screen flex items-center justify-center pt-24 pb-20 overflow-hidden">
    <!-- Background Gradients & Mesh -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(163,230,53,0.12),rgba(255,255,255,0))] pointer-events-none"></div>
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-lime-400/5 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute top-1/2 -right-40 w-96 h-96 bg-emerald-500/5 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <!-- Header Text -->
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-zinc-900 border border-zinc-800 text-xs font-bold text-lime-400 mb-4 uppercase tracking-wider">
                Proses Instan & Real-time
            </span>
            <h1 class="font-syne text-4xl sm:text-5xl font-black text-white leading-tight mb-4">
                FORMULIR <span class="text-transparent bg-clip-text bg-linear-to-r from-lime-400 to-emerald-400">RESERVASI</span>
            </h1>
            <p class="text-zinc-400 text-base">
                Isi detail pemesanan di bawah ini. Pastikan tanggal dan jam yang Anda pilih sudah sesuai dengan rencana tim Anda.
            </p>
        </div>

        <!-- Notification Alert -->
        @if(session('success'))
            <div class="max-w-4xl mx-auto mb-8 p-4 bg-emerald-500/10 border border-emerald-500/30 rounded-2xl text-emerald-400 text-sm flex items-center gap-3">
                <span>🎉</span>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if($errors->any())
            <div class="max-w-4xl mx-auto mb-8 p-4 bg-rose-500/10 border border-rose-500/30 rounded-2xl text-rose-400 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left Side: Order Form -->
            <div class="lg:col-span-7">
                <form action="{{ route('pemesanan.store') }}" method="POST" class="p-6 sm:p-10 bg-zinc-900/40 border border-zinc-800/80 rounded-3xl backdrop-blur-md shadow-2xl">
                    @csrf
                    
                    <h3 class="font-syne text-xl font-bold text-white mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-5 bg-linear-to-b from-lime-400 to-emerald-500 rounded-full"></span>
                        Informasi Pemesan
                    </h3>

                    <!-- Reusable Input: Nama Lengkap (Pre-filled if Logged In) -->
                    <x-form.input 
                        name="nama_pemesan" 
                        label="Nama Lengkap" 
                        placeholder="Masukkan nama sesuai kartu identitas" 
                        :value="old('nama_pemesan', $user ? $user->name : '')"
                        required 
                    />

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                        <!-- Reusable Input: WhatsApp (Pre-filled if Logged In) -->
                        <x-form.input 
                            name="whatsapp" 
                            type="tel"
                            label="Nomor WhatsApp" 
                            placeholder="Contoh: 08123456xxx" 
                            :value="old('whatsapp', $user ? $user->phone : '')"
                            required 
                        />
                        <!-- Reusable Input: Email (Pre-filled if Logged In) -->
                        <x-form.input 
                            name="email" 
                            type="email"
                            label="Alamat Email" 
                            placeholder="nama@email.com" 
                            :value="old('email', $user ? $user->email : '')"
                            required 
                        />
                    </div>

                    <h3 class="font-syne text-xl font-bold text-white mt-4 mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-5 bg-linear-to-b from-lime-400 to-emerald-500 rounded-full"></span>
                        Detail Jadwal & Lapangan
                    </h3>

                    <!-- Dynamic Select: Pilih Lapangan dari Database -->
                    <div class="mb-4">
                        <label for="lapangan_id" class="block text-sm font-semibold text-zinc-300 mb-2">Pilih Lapangan</label>
                        <select name="lapangan_id" id="lapangan_id" class="w-full px-5 py-3.5 bg-zinc-950 border border-zinc-800 rounded-2xl text-zinc-300 focus:outline-none focus:border-lime-400 transition-colors" required>
                            <option value="" data-price="0">Silahkan Pilih Lapangan</option>
                            @foreach($lapangans as $lapangan)
                                <option value="{{ $lapangan->id }}" 
                                        data-price="{{ $lapangan->tarif_per_jam }}"
                                        data-title="{{ $lapangan->nama_lapangan }}"
                                        {{ old('lapangan_id', $selectedLapanganId) == $lapangan->id ? 'selected' : '' }}>
                                    {{ $lapangan->nama_lapangan }} (Rp {{ number_format($lapangan->tarif_per_jam, 0, ',', '.') }}/jam)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                        <!-- Tanggal Main -->
                        <x-form.input 
                            name="tanggal" 
                            type="date"
                            label="Tanggal Pertandingan" 
                            :value="old('tanggal', \Carbon\Carbon::now('Asia/Jakarta')->toDateString())"
                            required
                        />

                        <!-- Jam Mulai -->
                       <div class="mb-4">
                            <label for="jam_mulai" class="block text-sm font-semibold text-zinc-300 mb-2">Jam Mulai</label>
                            <select name="jam_mulai" id="jam_mulai" class="w-full px-5 py-3.5 bg-zinc-950 border border-zinc-800 rounded-2xl text-zinc-300 focus:outline-none focus:border-lime-400 transition-colors" required>
                                @php
                                    $daftarJam = [
                                        '07:00' => '07:00 WIB', '08:00' => '08:00 WIB', '09:00' => '09:00 WIB',
                                        '10:00' => '10:00 WIB', '11:00' => '11:00 WIB', '12:00' => '12:00 WIB',
                                        '13:00' => '13:00 WIB', '14:00' => '14:00 WIB', '15:00' => '15:00 WIB',
                                        '16:00' => '16:00 WIB', '17:00' => '17:00 WIB', '18:00' => '18:00 WIB',
                                        '19:00' => '19:00 WIB', '20:00' => '20:00 WIB', '21:00' => '21:00 WIB',
                                        '22:00' => '22:00 WIB', '23:00' => '23:00 WIB'
                                    ];
                                    $waktuSekarang = \Carbon\Carbon::now('Asia/Jakarta');
                                    $jamSekarang = $waktuSekarang->format('H:i');
                                    $isHariIni = old('tanggal', $waktuSekarang->toDateString()) === $waktuSekarang->toDateString();
                                @endphp

                                @foreach($daftarJam as $value => $label)
                                    @php
                                        // Jika tanggal yang dipilih hari ini dan jam pilihan sudah lewat, matikan opsi ini
                                        $isDisabled = $isHariIni && ($value <= $jamSekarang);
                                    @endphp
                                    <option value="{{ $value }}" {{ old('jam_mulai') == $value ? 'selected' : '' }} {{ $isDisabled ? 'disabled class=text-zinc-600' : '' }}>
                                        {{ $label }} {{$isDisabled ? '(Sudah Lewat)' : ''}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <x-form.select 
                        name="durasi" 
                        id="durasi"
                        label="Durasi Bermain" 
                        :options="[
                            '1' => '1 Jam',
                            '2' => '2 Jam (Direkomendasikan)',
                            '3' => '3 Jam'
                        ]" 
                        :selected="old('durasi', '2')"
                        required 
                    />

                    <x-form.textarea 
                        name="catatan" 
                        label="Catatan Tambahan (Opsional)" 
                        placeholder="Contoh: Sewa rompi tambahan, bola cadangan, dll." 
                        :value="old('catatan')"
                    />

                    <x-form.checkbox 
                        name="syarat_ketentuan" 
                        label="Saya menyetujui bahwa jadwal yang telah dibooking tidak dapat dibatalkan secara sepihak." 
                        required
                    />

                    <x-form.button class="mt-4 glow-lime glow-lime-hover">
                        Lanjutkan ke Pembayaran
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </x-form.button>
                </form>
            </div>

            <!-- Right Side: Sticky Summary / Ringkasan Pemesanan -->
            <div class="lg:col-span-5 lg:sticky lg:top-28">
                <div class="p-6 bg-zinc-900/60 border border-zinc-800 rounded-3xl backdrop-blur-md shadow-xl">
                    <h3 class="font-syne text-lg font-bold text-white mb-4">Ringkasan Reservasi</h3>
                    
                    <div class="space-y-3.5 border-b border-zinc-800/80 pb-5 mb-5 text-sm text-zinc-400">
                        <div class="flex justify-between">
                            <span>Nama Lapangan</span>
                            <span id="summary-field-name" class="text-zinc-200 font-semibold text-right max-w-[60%] truncate">Belum memilih</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Status Lapangan</span>
                            <span class="text-emerald-400 font-semibold flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Tersedia
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span>Harga Dasar</span>
                            <span id="summary-base-price" class="text-zinc-200">Rp 0 / Jam</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Durasi Dipilih</span>
                            <span id="summary-duration" class="text-zinc-200">0 Jam</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Service Fee</span>
                            <span class="text-zinc-200">Rp 0 (FREE)</span>
                        </div>
                    </div>

                    <!-- Total Price Display -->
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="text-xs text-zinc-500 uppercase font-bold tracking-wider">Estimasi Total</p>
                            <p class="text-[10px] text-zinc-400 mt-0.5">*Belum termasuk opsi tambahan</p>
                        </div>
                        <p id="summary-total-price" class="font-syne text-2xl font-black text-lime-400">Rp 0</p>
                    </div>

                    <!-- Information Box (Glassmorphic Warning) -->
                    <div class="p-4 bg-lime-400/5 border border-lime-400/10 rounded-2xl flex gap-3 text-xs leading-relaxed text-zinc-400">
                        <svg class="w-5 h-5 text-lime-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p>
                            Sistem kami mengamankan slot waktu Anda selama 15 menit setelah tombol submit ditekan untuk menyelesaikan proses transfer atau verifikasi payment gateway. Jika tidak, slot akan dibuka kembali untuk pengguna lain.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Client-side Calculation Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectLapangan = document.getElementById('lapangan_id');
        const selectDurasi = document.getElementsByName('durasi')[0];

        const summaryFieldName = document.getElementById('summary-field-name');
        const summaryBasePrice = document.getElementById('summary-base-price');
        const summaryDuration = document.getElementById('summary-duration');
        const summaryTotalPrice = document.getElementById('summary-total-price');

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(number);
        }

        function updateSummary() {
            const selectedOption = selectLapangan.options[selectLapangan.selectedIndex];
            const basePrice = parseInt(selectedOption.getAttribute('data-price')) || 0;
            const fieldTitle = selectedOption.getAttribute('data-title') || 'Belum memilih';
            const duration = parseInt(selectDurasi.value) || 0;

            const total = basePrice * duration;

            summaryFieldName.textContent = fieldTitle;
            summaryBasePrice.textContent = basePrice > 0 ? `${formatRupiah(basePrice)} / Jam` : 'Rp 0 / Jam';
            summaryDuration.textContent = `${duration} Jam`;
            summaryTotalPrice.textContent = formatRupiah(total);
        }

        selectLapangan.addEventListener('change', updateSummary);
        selectDurasi.addEventListener('change', updateSummary);

        updateSummary();
    });
</script>
@endsection