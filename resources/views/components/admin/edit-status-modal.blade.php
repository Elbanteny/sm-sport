<div
    x-show="isStatusOpen"
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
    style="display: none"
>
    <!-- Backdrop Hitam Transparan -->
    <div
        x-show="isStatusOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute inset-0 bg-black/80 backdrop-blur-md"
        @click="closeStatusModal()"
    ></div>

    <!-- Konten Modal Melayang -->
    <div
        x-show="isStatusOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 transform"
        x-transition:enter-end="opacity-100 scale-100 transform"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 transform"
        x-transition:leave-end="opacity-0 scale-95 transform"
        class="relative bg-zinc-900 border border-zinc-800 rounded-3xl w-full max-w-md overflow-hidden shadow-2xl z-10"
    >
        <!-- Header Modal -->
        <div
            class="flex items-center justify-between px-6 py-5 border-b border-zinc-800 bg-zinc-900"
        >
            <div>
                <h3
                    class="font-syne text-sm font-bold text-white uppercase tracking-wider flex items-center gap-2"
                >
                    <span class="w-1.5 h-4 bg-lime-400 rounded-full"></span>
                    Perbarui Status Sewa
                </h3>
            </div>
            <button
                @click="closeStatusModal()"
                class="text-zinc-400 hover:text-white p-1.5 rounded-xl bg-zinc-950 border border-zinc-800 transition"
            >
                <svg
                    class="w-3.5 h-3.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2.5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
        </div>

        <!-- Form Edit Status -->
        <form
            :action="'/admin/sewa/' + statusData.id + '/status'"
            method="POST"
            class="p-6 space-y-4"
        >
            @csrf @method('PUT')

            <!-- Info Ringkas -->
            <div
                class="p-4 bg-zinc-950 border border-zinc-800 rounded-2xl text-xs space-y-2"
            >
                <div class="flex justify-between">
                    <span class="text-zinc-500">Nama Lapangan:</span>
                    <span
                        class="text-white font-bold"
                        x-text="statusData.nama_lapangan"
                    ></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-zinc-500">Pemesan:</span>
                    <span
                        class="text-white font-semibold"
                        x-text="statusData.pemesan"
                    ></span>
                </div>
            </div>

            <!-- Input Select Dropdown Custom -->
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-zinc-400"
                    >Status Penyewaan</label
                >
                <select
                    name="status"
                    x-model="statusData.status"
                    class="w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl text-xs text-zinc-200 focus:outline-none focus:border-lime-400 focus:ring-1 focus:ring-lime-400 transition"
                >
                    <option value="pending">
                        🟡 Pending (Menunggu Pembayaran / Konfirmasi)
                    </option>
                    <option value="disetujui">
                        🟢 Disetujui (Jadwal Terkunci & Aktif)
                    </option>
                    <option value="selesai">
                        ⚪ Selesai (Sesi Bermain Telah Selesai)
                    </option>
                    <option value="dibatalkan">
                        🔴 Dibatalkan (Booking Hangus / Refund)
                    </option>
                </select>
            </div>

            <!-- Tombol Aksi -->
            <div class="pt-2 flex gap-3">
                <button
                    type="button"
                    @click="closeStatusModal()"
                    class="w-1/2 px-4 py-3 bg-zinc-950 border border-zinc-800 text-zinc-300 font-bold rounded-xl text-xs transition hover:bg-zinc-900"
                >
                    Batal
                </button>
                <button
                    type="submit"
                    class="w-1/2 px-4 py-3 bg-lime-400 text-zinc-950 font-extrabold text-xs rounded-xl uppercase tracking-wider hover:bg-lime-300 transition"
                >
                    Simpan Status
                </button>
            </div>
        </form>
    </div>
</div>
