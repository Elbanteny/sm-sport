<div 
    x-show="isEditOpen" 
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
    style="display: none;"
>
    <!-- Backdrop Hitam Transparan dengan Transisi Alpine -->
    <div 
        x-show="isEditOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute inset-0 bg-black/80 backdrop-blur-md" 
        @click="closeEdit()"
    ></div>

    <!-- Konten Modal Melayang dengan Transisi Smooth -->
    <div 
        x-show="isEditOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 transform"
        x-transition:enter-end="opacity-100 scale-100 transform"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 transform"
        x-transition:leave-end="opacity-0 scale-95 transform"
        class="relative bg-zinc-900 border border-zinc-800 rounded-3xl w-full max-w-xl max-h-[90vh] overflow-y-auto shadow-2xl z-10"
    >
        <!-- Header Modal -->
        <div class="flex items-center justify-between px-8 py-6 border-b border-zinc-800 sticky top-0 bg-zinc-900 z-10">
            <div>
                <h3 class="font-syne text-lg font-bold text-white uppercase tracking-wider flex items-center gap-2">
                    <span class="w-1.5 h-4 bg-lime-400 rounded-full"></span>
                    Edit Lapangan
                </h3>
                <p class="text-[10px] text-zinc-500 mt-1">Perbarui informasi detail untuk lapangan ini secara instan.</p>
            </div>
            <button @click="closeEdit()" class="text-zinc-400 hover:text-white p-2 rounded-xl bg-zinc-950 border border-zinc-800 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form Edit-->
        <form :action="'/admin/lapangan/' + lapanganData.id" method="POST" class="p-8 space-y-1">
            @csrf
            @method('PUT')

            <!-- Input Nama Lapangan -->
            <x-form.input 
                name="nama_lapangan" 
                label="Nama Lapangan" 
                placeholder="Contoh: Lapangan Futsal Vinyl A" 
                required 
                x-model="lapanganData.nama_lapangan"
            />

            <!-- Baris Input Jenis Lapangan & Kategori -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Select Jenis Lapangan -->
                <x-form.select 
                    name="jenis_lapangan" 
                    label="Jenis Lapangan" 
                    :options="['futsal' => 'Futsal', 'badminton' => 'Badminton', 'basket' => 'Basket']" 
                    required 
                    x-model="lapanganData.jenis_lapangan"
                    @change="updateKategori()"
                />

                <!-- Input Kategori (Disabled & Auto-filled) -->
                <div class="relative">
                    <x-form.input 
                        name="kategori_display" 
                        label="Kategori / Kelas" 
                        placeholder="Kategori otomatis..." 
                        disabled
                        x-model="lapanganData.kategori"
                        class="opacity-60 cursor-not-allowed bg-zinc-950"
                    />
                    <!-- Input hidden agar value kategori tetap terkirim ke backend saat form disubmit -->
                    <input type="hidden" name="kategori" x-model="lapanganData.kategori">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Tipe Lapangan -->
                <x-form.select 
                    name="tipe" 
                    label="Tipe Area" 
                    :options="['indoor' => 'Indoor', 'outdoor' => 'Outdoor']" 
                    required 
                    x-model="lapanganData.tipe"
                />

                <!-- Input Tarif -->
                <x-form.input 
                    name="tarif_per_jam" 
                    label="Tarif Per Jam (Rp)" 
                    type="number" 
                    placeholder="Contoh: 150000" 
                    required 
                    x-model="lapanganData.tarif_per_jam"
                />
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-form.input 
                    name="image_url" 
                    label="URL Gambar Lapangan" 
                    placeholder="Contoh: https://link-gambar.com/lapangan.jpg" 
                    required 
                    x-model="lapanganData.image_url"
                />

                <x-form.input 
                    name="badge" 
                    label="Badge Promosi (Opsional)" 
                    placeholder="Contoh: Populer, Diskon 10%" 
                    x-model="lapanganData.badge"
                />
            </div>

            <!-- Bagian Fasilitas Lapangan (Menggunakan opsi Enum baru Anda) -->
            <div class="mb-5">
                <label class="block text-sm font-semibold text-zinc-300 mb-2">Fasilitas Lapangan</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 p-4 bg-zinc-950 border border-zinc-800 rounded-2xl">
                    <!-- 1. Shower Room -->
                    <label class="flex items-center gap-2 text-xs text-zinc-300 cursor-pointer">
                        <input type="checkbox" value="shower room" x-model="lapanganData.facilities" class="h-4 w-4 rounded bg-zinc-900 border-zinc-800 text-lime-400 focus:ring-0 focus:ring-offset-0 focus:outline-none accent-lime-400">
                        <span>Shower Room</span>
                    </label>

                    <!-- 2. Tempat Duduk Penonton -->
                    <label class="flex items-center gap-2 text-xs text-zinc-300 cursor-pointer">
                        <input type="checkbox" value="tempat duduk penonton" x-model="lapanganData.facilities" class="h-4 w-4 rounded bg-zinc-900 border-zinc-800 text-lime-400 focus:ring-0 focus:ring-offset-0 focus:outline-none accent-lime-400">
                        <span>Tempat Duduk Penonton</span>
                    </label>

                    <!-- 3. Free Parking -->
                    <label class="flex items-center gap-2 text-xs text-zinc-300 cursor-pointer">
                        <input type="checkbox" value="free parking" x-model="lapanganData.facilities" class="h-4 w-4 rounded bg-zinc-900 border-zinc-800 text-lime-400 focus:ring-0 focus:ring-offset-0 focus:outline-none accent-lime-400">
                        <span>Free Parking</span>
                    </label>

                    <!-- 4. Kantin -->
                    <label class="flex items-center gap-2 text-xs text-zinc-300 cursor-pointer">
                        <input type="checkbox" value="kantin" x-model="lapanganData.facilities" class="h-4 w-4 rounded bg-zinc-900 border-zinc-800 text-lime-400 focus:ring-0 focus:ring-offset-0 focus:outline-none accent-lime-400">
                        <span>Kantin</span>
                    </label>

                    <!-- 5. Tribun Penonton -->
                    <label class="flex items-center gap-2 text-xs text-zinc-300 cursor-pointer">
                        <input type="checkbox" value="tribun penonton" x-model="lapanganData.facilities" class="h-4 w-4 rounded bg-zinc-900 border-zinc-800 text-lime-400 focus:ring-0 focus:ring-offset-0 focus:outline-none accent-lime-400">
                        <span>Tribun Penonton</span>
                    </label>

                    <!-- 6. Lampu Sorot Malam -->
                    <label class="flex items-center gap-2 text-xs text-zinc-300 cursor-pointer">
                        <input type="checkbox" value="lampu sorot malam" x-model="lapanganData.facilities" class="h-4 w-4 rounded bg-zinc-900 border-zinc-800 text-lime-400 focus:ring-0 focus:ring-offset-0 focus:outline-none accent-lime-400">
                        <span>Lampu Sorot Malam</span>
                    </label>

                    <!-- 7. Ruang Ganti -->
                    <label class="flex items-center gap-2 text-xs text-zinc-300 cursor-pointer">
                        <input type="checkbox" value="ruang ganti" x-model="lapanganData.facilities" class="h-4 w-4 rounded bg-zinc-900 border-zinc-800 text-lime-400 focus:ring-0 focus:ring-offset-0 focus:outline-none accent-lime-400">
                        <span>Ruang Ganti</span>
                    </label>

                    <!-- 8. Scoreboard Digital -->
                    <label class="flex items-center gap-2 text-xs text-zinc-300 cursor-pointer">
                        <input type="checkbox" value="scoreboard digital" x-model="lapanganData.facilities" class="h-4 w-4 rounded bg-zinc-900 border-zinc-800 text-lime-400 focus:ring-0 focus:ring-offset-0 focus:outline-none accent-lime-400">
                        <span>Scoreboard Digital</span>
                    </label>

                    <!-- Loop Template untuk mengirimkan array asli ke Laravel Request -->
                    <template x-for="facility in lapanganData.facilities" :key="facility">
                        <input type="hidden" name="facilities[]" :value="facility">
                    </template>
                </div>
            </div>

            <!-- Textarea Deskripsi Lapangan -->
            <x-form.textarea 
                name="deskripsi" 
                label="Deskripsi Lapangan" 
                placeholder="Tuliskan spesifikasi, kelebihan, atau fasilitas pelengkap lapangan..." 
                rows="3" 
                x-model="lapanganData.deskripsi"
                required
            />

            <!-- Tombol Aksi -->
            <div class="pt-4 flex gap-3">
                <button type="button" @click="closeEdit()" class="w-1/2 px-5 py-3.5 bg-zinc-950 border border-zinc-800 text-zinc-300 font-bold rounded-2xl transition hover:bg-zinc-900 active:scale-[0.98]">
                    Batal
                </button>
                <div class="w-1/2">
                    <x-form.button type="submit">
                        Simpan Perubahan
                    </x-form.button>
                </div>
            </div>
        </form>
    </div>
</div>