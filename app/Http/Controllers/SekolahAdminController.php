<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah;

class SekolahAdminController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Sekolah::query())
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("sekolah.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.sekolah", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
           
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.sekolah.index');
    }

    public function create()
    {
        return view('admin.sekolah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required',
            'npsn' => 'required',
            'telp_sekolah' => 'required',
            'status' => 'required',
            'kelurahan_id' => 'required',
            'jalan' => 'required',
            'email' => 'required',
            'no_rmh' => 'required',
            'rt_rw' => 'required',
            'kodepos' => 'required',
        ]);

        Sekolah::create([
            'nama_sekolah' => $request->nama_sekolah,
            'npsn' => $request->npsn,
            'telp_sekolah' => $request->telp_sekolah,
            'status' => $request->status,
            'email' => $request->email,
            'kelurahan_id' => $request->kelurahan_id,
            'jalan' => $request->jalan,
            'no_rmh' => $request->no_rmh,
            'rt_rw' => $request->rt_rw,
            'kodepos' => $request->kodepos,
        ]);

        return redirect()->route('sekolah.index');
    }

    public function edit($id)
    {
        $sekolah = Sekolah::find($id);
        return view('admin.sekolah.edit', compact('sekolah'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_sekolah' => 'required',
            'npsn' => 'required',
            'telp_sekolah' => 'required',
            'status' => 'required',
            'kelurahan_id' => 'required',
            'jalan' => 'required',
            'email' => 'required',
            'no_rmh' => 'required',
            'rt_rw' => 'required',
            'kodepos' => 'required',
        ]);

        Sekolah::find($id)->update([
            'nama_sekolah' => $request->nama_sekolah,
            'npsn' => $request->npsn,
            'telp_sekolah' => $request->telp_sekolah,
            'status' => $request->status,
            'email' => $request->email,
            'kelurahan_id' => $request->kelurahan_id,
            'jalan' => $request->jalan,
            'no_rmh' => $request->no_rmh,
            'rt_rw' => $request->rt_rw,
            'kodepos' => $request->kodepos,
        ]);

        return redirect()->route('sekolah.index');
    }

    public function destroy($id)
    {
        $sekolah = Sekolah::find($id);
        if (!$sekolah) {
            return redirect()->back();
        }
       
        $sekolah->delete();
        return redirect()->route('sekolah.index');
    }
}
