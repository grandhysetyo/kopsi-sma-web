<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Kategori::query())
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("kategori.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.kategori", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.kategori.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kategori' => 'required',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori, 
            'slug' => Str::slug($request->nama_kategori),
        ]);
        
        return redirect()->route('kategori.index');
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_kategori' => 'required',
        ]);

        $kategori = Kategori::find($id);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori, 
            'slug' => Str::slug($request->nama_kategori),
        ]);

        return redirect()->route('kategori.index');
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        if (!$kategori) {
            return redirect()->back();
        }
       
        $kategori->delete();
        return redirect()->route('kategori.index');
    }

}
