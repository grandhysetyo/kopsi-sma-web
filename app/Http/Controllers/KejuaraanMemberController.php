<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrestasiAnggota;
use App\Models\Anggota;
use Storage;
use Carbon\Carbon;

class KejuaraanMemberController extends Controller
{
    public function index()
    {

        if(request()->ajax())
        {
            return datatables()->of(PrestasiAnggota::where('anggota_id',auth()->user()->anggota->id)->select('prestasi_anggotas.*'))
            ->editColumn('edit', function ($data) {
                $aksi = '<a href="'.route("hapus.kejuaraan-member", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $aksi;
            })
            ->editColumn('tanggal', function ($data) {
                $aksi = Carbon::parse($data->waktu)->format('d M Y');
                return $aksi;
            })
            ->rawColumns(['edit','tanggal'])
            ->make(true);
        }

        return view('member.kejuaraan.index');
    }

    public function create()
    {
        return view('member.kejuaraan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tempat' => 'required',
            'waktu' => 'required',
            'penyelenggara' => 'required',
            'prestasi' => 'required',
        ]);

        $anggota = Anggota::find(auth()->user()->anggota->id);
        $anggota->prestasi()->create([
            'judul' => $request->judul,
            'tempat' => $request->tempat,
            'waktu' => $request->waktu,
            'penyelenggara' => $request->penyelenggara,
            'prestasi' => $request->prestasi,
        ]);

        return redirect()->route('kejuaraan-member.index')->with('sukses','ye');
    }

    public function destroy($id)
    {
        $prestasi = PrestasiAnggota::find($id);
        if (!$prestasi) {
            return redirect()->back();
        }

        $prestasi->delete();
        return redirect()->route('kejuaraan-member.index');
    }
}
