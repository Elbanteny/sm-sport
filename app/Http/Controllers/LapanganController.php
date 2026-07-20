<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    public function home()
    {
        $popularField = Lapangan::orderBy('rating', 'desc')
            ->orderBy('reviews', 'desc')
            ->first();

        $topFields = Lapangan::orderBy('rating', 'desc')
            ->take(4)
            ->get();

        return view('user.home', compact('popularField', 'topFields'));
    }

    public function index(Request $request)
    {

    $query = Lapangan::with(['reservasis' => function($q) {
        $q->whereDate('tanggal', Carbon::today())
          ->whereIn('status', ['pending', 'disetujui']);
    }]);

    if ($request->has('search') && $request->search != '') {
        $query->where('nama_lapangan', 'like', '%' . $request->search . '%');
    }

    if ($request->has('category') && $request->category != '') {
        $query->where('kategori', $request->category);
    }

    if ($request->has('type') && $request->type != '') {
        $query->where('tipe', $request->type);
    }

    $lapangans = $query->get();


    $lapangans->map(function ($lapangan) {
        $lapangan->sedang_disewa = $lapangan->reservasis->isNotEmpty();
        return $lapangan;
    });

    return view('user.lapangan', compact('lapangans'));
    }

    public function indexAdmin()
    {
        $lapangans = Lapangan::all();

        return view('admin.lapangan', compact('lapangans'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'nama_lapangan' => 'required|string|max:255',
        'jenis_lapangan' => 'required|in:futsal,badminton,basket', 
        'kategori' => 'required|string|max:255',
        'tipe' => 'required|string|max:255',
        'tarif_per_jam' => 'required|numeric|min:0',
        'image_url' => 'required|url',
        'badge' => 'nullable|string|max:255',
        'deskripsi' => 'required|string',
        'facilities' => 'required|array|min:1', 
    ]);

    $lapangan = Lapangan::findOrFail($id);
    $lapangan->update($request->all()); 

    return redirect()->route('admin.lapangan')->with('success', 'Data lapangan berhasil diperbarui!');
    }

    public function store(Request $request)
    {
    $request->validate([
        'nama_lapangan' => 'required|string|max:255',
        'jenis_lapangan' => 'required|in:futsal,badminton,basket', 
        'kategori' => 'required|string|max:255',
        'tipe' => 'required|string|max:255',
        'tarif_per_jam' => 'required|numeric|min:0',
        'image_url' => 'required|url',
        'badge' => 'nullable|string|max:255',
        'deskripsi' => 'required|string',
        'facilities' => 'required|array|min:1', 
    ]);

    Lapangan::create(array_merge($request->all(), [
        'rating' => 0.0,
        'reviews' => 0
    ]));

    return redirect()->route('admin.lapangan')->with('success', 'Lapangan baru berhasil ditambahkan!');
    }   

    public function destroy($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        $lapangan->delete();

        return redirect()->route('admin.lapangan')->with('success', 'Data lapangan berhasil dihapus!');
    }
}