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
    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kode_produk' => 'required|regex:/[A-Z]+/',
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategori,id',
            'stock' => 'required|integer',
            'gambar_produk' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Temukan produk berdasarkan ID
        $produk = Produk::find($id);

        if (!$produk) {
            return redirect()->route('produk.index')->with('error', 'Produk tidak ditemukan.');
        }

        // Update atribut produk
        $produk->kode_produk = $request->kode_produk;
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->kategori_id = $request->kategori_id;
        $produk->stock = $request->stock;

        // Cek apakah ada file gambar yang diunggah
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

        // Simpan perubahan
        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Data produk berhasil diperbarui.');
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
