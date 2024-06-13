<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = Barang::query();

        if ($request->search) {
            $query->where('nama_barang', 'LIKE', '%' . $request->search . '%');
        }

        $barangs = $query->latest()->paginate(10);

        return view('dashboard.barang.index', [
            'title' => 'Sarana dan Prasarana',
            'barangs' => $barangs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.barang.tambah', [
            'title' => 'Create Sarana Prasarana',
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validasiData = $request->validate([
            'category_id' => ['required', 'integer'],
            'nama_barang' => ['required', 'min:5', 'max:255'],
            'stok' => ['required'],
            'image' => 'image|file|max:1024',
        ]);

        if ($request->file('image')) {
            $validasiData['image'] = $request->file('image')->store('public/post-image');
        }

        Barang::create($validasiData);
        return redirect('/sarana-prasarana')->with('success', 'infrastructure data has been successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param Barang $barang
     * @param int $id
     * @return View
     */
    public function show(Barang $barang, $id): View
    {
        $barang = Barang::findOrFail($id);
        return view('dashboard.barang.show', [
            'title' => 'Detail ' . $barang->nama_barang,
            'barang' => $barang
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Barang $barang
     * @param int $id
     * @return View
     */
    public function edit(Barang $barang, $id): View
    {
        $barang = Barang::findOrFail($id);
        return view('dashboard.barang.edit', [
            'title' => 'Edit Sarana Prasarana',
            'barang' => $barang,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $barang = Barang::findOrFail($id);

        $rules = [
            'category_id' => ['required'],
            'nama_barang' => ['required', 'min:5', 'max:255'],
            'stok' => ['required'],
            'image' => 'image|file|max:1024',
        ];

        $validasiData = $request->validate($rules);

        if ($request->file('image')) {
            if ($barang->image) {
                Storage::delete($barang->image);
            }
            $validasiData['image'] = $request->file('image')->store('public/post-image');
        }




        if ($request->hasFile('gambar_produk')) {
            // Hapus gambar lama jika ada
            if ($produk->gambar_produk && Storage::exists('public/produk/' . $produk->gambar_produk)) {
                Storage::delete('public/produk/' . $produk->gambar_produk);
            }

            // Simpan gambar baru
            $file = $request->file('gambar_produk');
            $gambar_produk = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/produk', $gambar_produk);
            $produk->gambar_produk = $gambar_produk;
        }

        $barang->update($validasiData);
        return redirect('/sarana-prasarana')->with('success', 'infrastructure has been successfully changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $barang = Barang::findOrFail($id);

        if ($barang->image) {
            Storage::delete($barang->image);
        }

        $barang->delete();
        return redirect('/sarana-prasarana')->with('success', 'data deleted successfully');
    }
}
