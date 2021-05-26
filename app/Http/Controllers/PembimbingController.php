<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembimbing;
use Storage;

class PembimbingController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Pembimbing::with('tim.sekolah')->select('pembimbings.*'))
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("pembimbing.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.pembimbing", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->editColumn('surat', function ($data) {
                if (empty($data->surat_kepsek)) {
                    $mystring = '<a href="#" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Belum Unggah</a>';
                } else {
                    $mystring = '<a href="/uploads/'.$data->surat_kepsek.'" class="bg-green-500 text-white p-2 rounded mr-2 font-bold">Buka</a>';
                }
                
                
                return $mystring;
            })
           
            ->rawColumns(['edit','surat'])
            ->make(true);
        }
        return view('admin.pembimbing.index');
    }

    public function create()
    {
        return view('admin.pembimbing.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nik' => 'required',
            'mapel' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'jalan' => 'required',
            'no_rmh' => 'required',
            'rt_rw' => 'required',
            'kelurahan_id' => 'required',
            'tim_id' => 'required',
            'kodepos' => 'required',
            'surat_kepsek' => 'required|file|mimes:pdf|max:2048',
        ]);

        Pembimbing::create([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nik' => $request->nik,
            'no_telp' => $request->no_telp,
            'nuptk' => $request->nuptk,
            'email' => $request->email,
            'nip' => $request->nip,
            'mapel' => $request->mapel,
            'jalan' => $request->jalan,
            'no_rmh' => $request->no_rmh,
            'rt_rw' => $request->rt_rw,
            'kelurahan_id' => $request->kelurahan_id,
            'tim_id' => $request->tim_id,
            'kodepos' => $request->kodepos,
            'surat_kepsek' => $request->file('surat_kepsek')->store('pembimbing'),
        ]);
        
        
        return redirect()->route('pembimbing.index');
    }

    public function edit($id)
    {
        $pembimbing = Pembimbing::with('tim.sekolah')->find($id);
        return view('admin.pembimbing.edit', compact('pembimbing'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nik' => 'required',
            'mapel' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'jalan' => 'required',
            'no_rmh' => 'required',
            'rt_rw' => 'required',
            'tim_id' => 'required',
            'kelurahan_id' => 'required',
            'kodepos' => 'required',
            'surat_kepsek' => 'file|mimes:pdf|max:2048',
        ]);

        $pembimbing = Pembimbing::find($id);

        if (empty($request->surat_kepsek)) {
            $pembimbing->update([
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'email' => $request->email,
                'mapel' => $request->mapel,
                'tanggal_lahir' => $request->tanggal_lahir,
                'nik' => $request->nik,
                'no_telp' => $request->no_telp,
                'nuptk' => $request->nuptk,
                'nip' => $request->nip,
                'jalan' => $request->jalan,
                'tim_id' => $request->tim_id,
                'no_rmh' => $request->no_rmh,
                'rt_rw' => $request->rt_rw,
                'kelurahan_id' => $request->kelurahan_id,
                'kodepos' => $request->kodepos,
            ]);
        } else {
            Storage::delete($pembimbing->surat_kepsek);
            $pembimbing->update([
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'nik' => $request->nik,
                'no_telp' => $request->no_telp,
                'nuptk' => $request->nuptk,
                'email' => $request->email,
                'nip' => $request->nip,
                'mapel' => $request->mapel,
                'jalan' => $request->jalan,
                'no_rmh' => $request->no_rmh,
                'tim_id' => $request->tim_id,
                'rt_rw' => $request->rt_rw,
                'kelurahan_id' => $request->kelurahan_id,
                'kodepos' => $request->kodepos,
                'surat_kepsek' => $request->file('surat_kepsek')->store('pembimbing'),
            ]);
        }
        
        
        return redirect()->route('pembimbing.index');
    }

    public function destroy($id)
    {
        $pembimbing = Pembimbing::find($id);
        if (!$pembimbing) {
            return redirect()->back();
        }

        Storage::delete($pembimbing->surat_kepsek);
        $pembimbing->delete();
        return redirect()->route('pembimbing.index');
    }
}
