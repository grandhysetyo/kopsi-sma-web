<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Bidang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Storage;
use Illuminate\Support\Str;

class BidangController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Bidang::query())
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("bidang.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.bidang", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.bidang.index');
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.bidang.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_bidang' => 'required',
            'deskripsi_singkat' => 'required',
            'deskripsi_panjang' => 'required',
            'kuota_peserta_tim' => 'required',
            'icon' => 'required|file|max:1024',
        ]);

        Bidang::create([
            'nama_bidang' => $request->nama_bidang,
            'slug' => Str::slug($request->nama_bidang),
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'deskripsi_panjang' => $request->deskripsi_panjang,
            'kuota_peserta_tim' => $request->kuota_peserta_tim,
            'icon' => $request->file('icon')->store('bidang'), 
        ]);
        
        return redirect()->route('bidang.index');
    }

    public function edit($id)
    {
        $bidang = Bidang::find($id);
        return view('admin.bidang.edit', compact('bidang'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_bidang' => 'required',
            'deskripsi_singkat' => 'required',
            'deskripsi_panjang' => 'required',
            'kuota_peserta_tim' => 'required',
            'icon' => 'file|max:1024',
        ]);

        $bidang = Bidang::find($id);

        if (empty($request->file('icon'))) {
            $bidang->update([
                'nama_bidang' => $request->nama_bidang,
                'slug' => Str::slug($request->nama_bidang),
                'deskripsi_singkat' => $request->deskripsi_singkat,
                'deskripsi_panjang' => $request->deskripsi_panjang,
                'kuota_peserta_tim' => $request->kuota_peserta_tim,
            ]);
        } else {
            Storage::delete($bidang->icon);
            $bidang->update([
                'nama_bidang' => $request->nama_bidang,
                'slug' => Str::slug($request->nama_bidang),
                'deskripsi_singkat' => $request->deskripsi_singkat,
                'deskripsi_panjang' => $request->deskripsi_panjang,
                'kuota_peserta_tim' => $request->kuota_peserta_tim,
                'icon' => $request->file('icon')->store('bidang'), 
            ]);
        }

        return redirect()->route('bidang.index');
    }

    public function destroy($id)
    {
        $bidang = Bidang::find($id);
        if (!$bidang) {
            return redirect()->back();
        }
        Storage::delete($bidang->icon);
        $bidang->delete();
        return redirect()->route('bidang.index');
    }

}
