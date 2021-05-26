<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ketua;
use App\Models\Tim;
use App\Models\Kategori;
use App\Models\Anggota;
use App\Models\Pembimbing;
use App\Models\OrangTuaKetua;
use App\Models\Sekolah;
use App\Models\UnggahanBerkasPeserta;
use App\Models\Berkas;
use App\Models\UnggahanTim;
use App\Models\Countdown;
use Illuminate\Support\Facades\Hash;
use Auth;
use Storage;

class DashboardLeaderController extends Controller
{
    public function dashboard()
    {
        $time = Countdown::find(1);
        return view('leader.dashboard', compact('time'));
    }

    public function akun()
    {
        $time = Countdown::find(1);
        if (now()->isBefore($time->pendaftaran)) {
            $user = User::where('id',auth()->user()->id)->first();
            return view('leader.akun.edit', compact('user'));
        } else {
            return redirect()->route('landing')->with('tutup','tutup');
        }
    }

    public function simpan_akun(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $user = User::where('id',auth()->user()->id)->first();

        if (empty($request->password)) {
            $user->update([
                'name' => ucwords($request->name),
                'email' => $request->email,
            ]);
            return redirect()->route('akun.leader')->with('sukses','Hore');
        } else {
            $user->update([
                'name' => ucwords($request->name),
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
        
            return redirect()->route('login')->with('password','sukses');
        }
    }

    public function biodata()
    {
        $time = Countdown::find(1);
        if (now()->isBefore($time->pendaftaran)) {
            $ketua = Ketua::where('id',auth()->user()->ketua->id)->first();
            return view('leader.biodata.edit', compact('ketua'));
        } else {
            return redirect()->route('landing')->with('tutup','tutup');
        }
    }

    public function simpan_biodata(Request $request)
    {
        $request->validate([
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'status' => 'required',
            'nohp' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'kelurahan_id' => 'required',
            'jalan' => 'required',
            'ukuran_baju' => 'required',
            'no_rmh' => 'required',
            'rt_rw' => 'required',
            'kodepos' => 'required',
            'nik' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:1024',
        ]);

        $ketua = Ketua::where('id',auth()->user()->ketua->id)->first();

        if (empty($request->file('foto'))) {
            $ketua->update([
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'kip' => $request->kip,
                'alamat_siln' => $request->alamat_siln,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'nohp' => $request->nohp,
                'kelas' => $request->kelas,
                'status' => $request->status,
                'ukuran_baju' => $request->ukuran_baju,
                'jurusan' => $request->jurusan,
                'kelurahan_id' => $request->kelurahan_id,
                'jalan' => $request->jalan,
                'no_rmh' => $request->no_rmh,
                'rt_rw' => $request->rt_rw,
                'kodepos' => $request->kodepos,
                'nik' => $request->nik,
            ]);
        } else {
            Storage::delete($ketua->foto);
            $ketua->update([
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'nohp' => $request->nohp,
                'kelas' => $request->kelas,
                'kip' => $request->kip,
                'alamat_siln' => $request->alamat_siln,
                'status' => $request->status,
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
        }

        return redirect()->route('biodata.leader')->with('sukses','Hore');
    }

    public function tim()
    {
        $time = Countdown::find(1);
        if (now()->isBefore($time->pendaftaran)) {
            $tim = Tim::with('bidang.bidang')->where('id',auth()->user()->ketua->tim->id)->first();
            return view('leader.tim.edit', compact('tim'));
        } else {
            return redirect()->route('landing')->with('tutup','tutup');
        }
    }

    public function simpan_tim(Request $request)
    {
        $request->validate([
            'nama_tim' => 'required',
            'nama_karya' => 'required',
            'deskripsi_karya' => 'required',
            'province_id' => 'required',
            'simpan' => 'required',
            'bidang_id' => 'required',
        ]);

        $tim = Tim::where('id',auth()->user()->ketua->tim->id)->first();

        // if ($tim->bidang_id != $request->bidang_id)
        // {
        //     UnggahanTim::where('tim_id',$tim->id)->delete();
        // }

        $tim->update([
            'nama_tim' => $request->nama_tim,
            'province_id' => $request->province_id,
            'bidang_id' => $request->bidang_id,
            'simpan' => $request->simpan,
            'nama_karya' => $request->nama_karya,
            'deskripsi_karya' => $request->deskripsi_karya,
        ]);
        return redirect()->route('tim.leader')->with('sukses','Hore');
    }

    public function anggota()
    {
        $time = Countdown::find(1);
        if (now()->isBefore($time->pendaftaran)) {
            if(request()->ajax())
            {
                return datatables()->of(Anggota::with('user')->where('tim_id',auth()->user()->ketua->tim->id)->select('anggotas.*'))
                ->make(true);
            }

            return view('leader.anggota.index');
        } else {
            return redirect()->route('landing')->with('tutup','tutup');
        }
    }

    public function pembimbing()
    {
        $time = Countdown::find(1);
        if (now()->isBefore($time->pendaftaran)) {
            $pembimbing = Pembimbing::find(auth()->user()->ketua->tim->pembimbing->id);
            return view('leader.pembimbing.edit', compact('pembimbing'));
        } else {
            return redirect()->route('landing')->with('tutup','tutup');
        }
    }

    public function simpan_pembimbing(Request $request)
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
            'kodepos' => 'required',
            'surat_kepsek' => 'file|mimes:pdf|max:2048',
        ]);

        $pembimbing = Pembimbing::find(auth()->user()->ketua->tim->pembimbing->id);

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
                'rt_rw' => $request->rt_rw,
                'kelurahan_id' => $request->kelurahan_id,
                'kodepos' => $request->kodepos,
                'surat_kepsek' => $request->file('surat_kepsek')->store('pembimbing'),
            ]);
        }
        
        
        return redirect()->route('pembimbing.leader')->with('sukses','Hore');
    }

    public function ortu()
    {
        $time = Countdown::find(1);
        if (now()->isBefore($time->pendaftaran)) {
            $ortu = OrangTuaKetua::with('ketua.user')->find(auth()->user()->ketua->ayahibu_ketua->id);
            return view('leader.ortu.edit', compact('ortu'));
        } else {
            return redirect()->route('landing')->with('tutup','tutup');
        }
    }

    public function simpan_ortu(Request $request)
    {
        $request->validate([
            'nama_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'pendidikan_terakhir_ibu' => 'required',
            'nohp_ibu' => 'required',
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'pendidikan_terakhir_ayah' => 'required',
            'nohp_ayah' => 'required',
            'status' => 'required',
            'jalan' => 'required',
            'no_rmh' => 'required',
            'rt_rw' => 'required',
            'kodepos' => 'required',
            'kelurahan_id' => 'required',
        ]);

        $ortu = OrangTuaKetua::find(auth()->user()->ketua->ayahibu_ketua->id);

        $ortu->update([
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'pendidikan_terakhir_ibu' => $request->pendidikan_terakhir_ibu,
            'nohp_ibu' => $request->nohp_ibu,
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'pendidikan_terakhir_ayah' => $request->pendidikan_terakhir_ayah,
            'nohp_ayah' => $request->nohp_ayah,
            'status' => $request->status,
            'jalan' => $request->jalan,
            'no_rmh' => $request->no_rmh,
            'rt_rw' => $request->rt_rw,
            'kelurahan_id' => $request->kelurahan_id,
            'kodepos' => $request->kodepos,
        ]);

        return redirect()->route('ortu.leader')->with('sukses','yee');
    }

    public function sekolah()
    {
        $time = Countdown::find(1);
        if (now()->isBefore($time->pendaftaran)) {
            $sekolah = Sekolah::with('kelurahan')->find(auth()->user()->ketua->tim->sekolah->id);
            return view('leader.sekolah.edit', compact('sekolah'));
        } else {
            return redirect()->route('landing')->with('tutup','tutup');
        }
    }

    public function simpan_sekolah(Request $request)
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

        $sekolah = Sekolah::find(auth()->user()->ketua->tim->sekolah->id);

        $sekolah->update([
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
        return redirect()->route('sekolah.leader')->with('sukses','Hore');
    }
}
