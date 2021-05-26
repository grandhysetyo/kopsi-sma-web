<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidang;
use App\Models\UnggahanBidang;
use Illuminate\Support\Str;

class UnggahController extends Controller
{
    public function index()
    {
        $bidang = Bidang::all();
        if(request()->ajax())
        {
            return datatables()->of(UnggahanBidang::with('bidang.kategori')->select('unggahan_bidangs.*'))
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("unggah.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.unggah", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.unggah.index', compact('bidang'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_berkas' => 'required',
            'type' => 'required',
            'bidang_id' => 'required',
        ]);

        UnggahanBidang::create([
            'nama_berkas' => $request->nama_berkas, 
            'type' => $request->type, 
            'bidang_id' => $request->bidang_id, 
        ]);
        
        return redirect()->route('unggah.index');
    }

    public function edit($id)
    {
        $unggah = UnggahanBidang::find($id);
        return view('admin.unggah.edit', compact('unggah'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_berkas' => 'required',
            'type' => 'required',
            'bidang_id' => 'required',
        ]);

        $unggah = UnggahanBidang::find($id);

        $unggah->update([
            'nama_berkas' => $request->nama_berkas, 
            'type' => $request->type, 
            'bidang_id' => $request->bidang_id,
        ]);

        return redirect()->route('unggah.index');
    }

    public function destroy($id)
    {
        $unggah = UnggahanBidang::find($id);
        if (!$unggah) {
            return redirect()->back();
        }
       
        $unggah->delete();
        return redirect()->route('unggah.index');
    }

}
