@props(['fields' => []])

<section id="lapangan" class="py-24 bg-zinc-900/50 border-t border-b border-zinc-900 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="font-syne text-xs font-extrabold text-lime-400 tracking-widest uppercase mb-3">PILIHAN ARENA KAMI</h2>
            <p class="font-syne text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight">
                LAPANGAN OLAHRAGA TERBAIK UNTUK PERFORMA TERBAIK
            </p>
            <p class="text-zinc-400 text-base sm:text-lg mt-4">
                Kami menyediakan berbagai jenis lapangan berstandar nasional dan internasional dengan perawatan rutin terbaik.
            </p>
        </div>

        <!-- Field Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($fields as $field)
                <x-field-card 
                    :title="$field->nama_lapangan"
                    :category="$field->kategori"
                    :type="$field->tipe"
                    :image="$field->image_url"
                    :price="number_format($field->tarif_per_jam, 0, ',', '.')"
                    :description="$field->deskripsi"
                    :bookingUrl="$field->sedang_disewa ? '#' : url('/pemesanan?lapangan=' . $field->id)"
                    :isRented="$field->sedang_disewa"
                    :simple="true"
                />
            @empty
                <div class="col-span-4 text-center py-10 text-zinc-500">
                    Belum ada data lapangan premium yang tersedia saat ini.
                </div>
            @endforelse
        </div>
    </div>
</section>