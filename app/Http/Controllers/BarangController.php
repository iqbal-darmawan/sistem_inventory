<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', compact("barang"));
    }

    public function store(Request $request)
    {
        $foto = $request->file('image');
        $foto = $foto->store('images/barang');
        $barang = new Barang;
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->jumlah_barang = $request->jumlah_barang;
        $barang->merk_type = $request->merk_type;
        $barang->image = $foto;
        $barang->tahun = $request->tahun;
        $barang->save();

        Alert::success('Tersimpan', 'Barang Berhasil Disimpan');
        return redirect()->route('barang.index');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view("barang.edit", compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $foto = $request->file('image');
        $barang = Barang::findOrFail($id);
        if ($foto) {
            Storage::delete($barang->image);
            $foto = $foto->store('images/barang');
        } else {
            $foto = $barang->image;
        }
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->tahun = $request->tahun;
        $barang->jumlah_barang = $request->jumlah_barang;
        $barang->image = $foto;
        $barang->merk_type = $request->merk_type;
        $barang->save();
        Alert::success('Terupdate', 'Barang Berhasil Diupdate');
        return redirect()->route('barang.index');
    }

    public function delete($id)
    {
        $barang = Barang::findOrFail($id);
        Storage::delete($barang->image);
        $barang->delete();
        Alert::success('Terhapus', 'Barang Berhasil Dihapus');
        return redirect()->route('barang.index');
    }
}
