<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ketua;
use App\Models\User;
use Storage;
use DB;

class KetuaAdminController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Ketua::with('tim.sekolah','user')->select('ketuas.*'))
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("ketua.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.ketua", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->editColumn('photo', function ($data) {
                if (empty($data->foto)) {
                    $mystring = 'Belum Unggah';
                } else {
                    $mystring = '<img class="w-5 md:w-16 lg:w-24" src="/uploads/'.$data->foto.'">';
                }
                
                
                return $mystring;
            })
           
            ->rawColumns(['edit','photo'])
            ->make(true);
        }
        return view('admin.ketua.index');
    }

    public function create()
    {
        return view('admin.ketua.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:ketuas',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nohp' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'kelurahan_id' => 'required',
            'tim_id' => 'required',
            'user_id' => 'required',
            'jalan' => 'required',
            'ukuran_baju' => 'required',
            'no_rmh' => 'required',
            'rt_rw' => 'required',
            'kodepos' => 'required',
            'nik' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:1024',
        ]);
      
        if (nisn($request->nisn)) {
            return 'nisn sudah ada';
        } else {
            DB::beginTransaction();
      
            try{

                $user = User::find($request->user_id);
                
                $words = explode(" ", $user->name);
                $acronym = "";
        
                foreach ($words as $w) {
                    $acronym .= $w[0];
                }
        
                $number = str_shuffle(rand(1,123456789));
        
                $ketua = Ketua::create([
                    'nisn' => $request->nisn,
                    'kode' => $acronym.$number,
                    'tim_id' => $request->tim_id,
                    'user_id' => $request->user_id,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'agama' => $request->agama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'nohp' => $request->nohp,
                    'kelas' => $request->kelas,
                    'kip' => $request->kip,
                    'alamat_siln' => $request->alamat_siln,
                    'kelurahan_id' => $request->kelurahan_id,
                    'jalan' => $request->jalan,
                    'no_rmh' => $request->no_rmh,
                    'ukuran_baju' => $request->ukuran_baju,
                    'jurusan' => $request->jurusan,
                    'rt_rw' => $request->rt_rw,
                    'kodepos' => $request->kodepos,
                    'nik' => $request->nik,
                    'foto' => $request->file('foto')->store('ketua'),
                ]);
      
                $ketua->ayahibu_ketua()->create([
                   'nama_ibu' => $request->nama_ibu,
                   'pekerjaan_ibu' => $request->pekerjaan_ibu,
                   'pendidikan_terakhir_ibu' => $request->pendidikan_terakhir_ibu,
                   'nama_ayah' => $request->nama_ayah,
                   'pekerjaan_ayah' => $request->pekerjaan_ayah,
                   'pendidikan_terakhir_ayah' => $request->pendidikan_terakhir_ayah,
      
                ]);
      
                DB::commit();
      
                return redirect()->route('ketua.index');
      
            } catch(\Exception $e) {
                DB::rollback();
                return 'gagal';
            }
        }
    }

    public function edit($id)
    {
        $ketua = Ketua::with('tim','user','kelurahan')->find($id);
        return view('admin.ketua.edit', compact('ketua'));
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
