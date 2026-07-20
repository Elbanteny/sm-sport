<div
    x-show="isDetailOpen"
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
    style="display: none"
>
    <div
        x-show="isDetailOpen"
        x-transition
        class="absolute inset-0 bg-black/80 backdrop-blur-md"
        @click="closeDetailModal()"
    ></div>
    <div
        x-show="isDetailOpen"
        x-transition
        class="relative bg-zinc-900 border border-zinc-800 rounded-3xl w-full max-w-lg overflow-hidden shadow-2xl z-10 text-xs"
    >
        <!-- Header Modal -->
        <div
            class="flex items-center justify-between px-6 py-4 border-b border-zinc-800 bg-zinc-900"
        >
            <h3
                class="font-syne text-xs font-bold text-white uppercase tracking-wider flex items-center gap-2"
            >
                <span class="w-1.5 h-4 bg-lime-400 rounded-full"></span>
                Rincian Lengkap Pemesanan
            </h3>
            <button
                @click="closeDetailModal()"
                class="text-zinc-400 hover:text-white p-1 rounded-lg bg-zinc-950 border border-zinc-800 transition"
            >
                ✕
            </button>
        </div>
        <!-- Konten Data -->
        <div
            class="p-6 space-y-4 max-h-[75vh] overflow-y-auto custom-scrollbar"
        >
            <!-- Blok Aset Lapangan -->
            <div>
                <h4
                    class="text-[10px] font-bold text-zinc-500 uppercase tracking-widest mb-2"
                >
                    Spesifikasi Lapangan
                </h4>
                <div
                    class="p-4 bg-zinc-950 border border-zinc-800/60 rounded-2xl space-y-2"
                >
                    <div class="flex justify-between">
                        <span class="text-zinc-400">Nama Lapangan:</span
                        ><span
                            class="text-white font-bold"
                            x-text="detailData.nama_lapangan"
                        ></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-400">Kategori & Jenis:</span
                        ><span
                            class="text-zinc-300 capitalize"
                            x-text="detailData.jenis_lapangan + ' (' + detailData.kategori + ')'"
                        ></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-400">Tipe Area:</span
                        ><span
                            class="text-zinc-300 uppercase"
                            x-text="detailData.tipe"
                        ></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-400">Tarif Dasar:</span
                        ><span
                            class="text-zinc-300"
                            x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(detailData.tarif_per_jam) + ' / Jam'"
                        ></span>
                    </div>
                </div>
            </div>
            <!-- Blok Penyewa & Transaksi -->
            <div>
                <h4
                    class="text-[10px] font-bold text-zinc-500 uppercase tracking-widest mb-2"
                >
                    Data Pengguna & Waktu
                </h4>
                <div
                    class="p-4 bg-zinc-950 border border-zinc-800/60 rounded-2xl space-y-2"
                >
                    <div class="flex justify-between">
                        <span class="text-zinc-400">Nama Pemesan:</span
                        ><span
                            class="text-white font-semibold"
                            x-text="detailData.pemesan"
                        ></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-400">Kontak Email:</span
                        ><span
                            class="text-zinc-300"
                            x-text="detailData.email"
                        ></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-400">Tanggal Main:</span
                        ><span
                            class="text-white font-semibold"
                            x-text="detailData.tanggal"
                        ></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-400">Alokasi Waktu:</span
                        ><span
                            class="text-lime-400 font-mono"
                            x-text="detailData.jam_mulai + ' - ' + detailData.jam_selesai + ' WIB'"
                        ></span>
                    </div>
                    <div
                        class="flex justify-between border-t border-zinc-900 pt-2 mt-1"
                    >
                        <span class="text-zinc-400">Metode Bayar:</span>
                        <span
                            class="text-white font-bold font-syne text-[10px]"
                            x-text="detailData.metode_pembayaran"
                        ></span>
                    </div>
                </div>
            </div>
            <!-- Blok Biaya Akhir & Catatan -->
            <div
                class="p-4 bg-lime-400/5 border border-lime-400/10 rounded-2xl space-y-3"
            >
                <div class="flex justify-between items-center">
                    <span class="text-zinc-400 font-medium"
                        >Total Pembayaran (Termasuk Admin):</span
                    >
                    <span
                        class="text-base font-black text-lime-400 font-syne"
                        x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(detailData.total_harga)"
                    ></span>
                </div>
                <div class="border-t border-zinc-800/60 pt-2">
                    <span
                        class="text-[10px] font-bold text-zinc-500 uppercase tracking-widest block mb-1"
                        >Catatan Customer:</span
                    >
                    <p
                        class="text-zinc-300 italic bg-zinc-950/50 p-2.5 rounded-xl border border-zinc-800"
                        x-text="detailData.catatan"
                    ></p>
                </div>
            </div>
            <button
                @click="closeDetailModal()"
                class="w-full py-3 bg-zinc-950 border border-zinc-800 text-zinc-300 font-bold rounded-xl transition hover:bg-zinc-900"
            >
                Tutup Rincian
            </button>
        </div>
    </div>
</div>
