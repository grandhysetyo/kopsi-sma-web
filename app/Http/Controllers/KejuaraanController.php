<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrestasiKetua;
use App\Models\Ketua;
use Storage;
use Carbon\Carbon;

class KejuaraanController extends Controller
{
    public function index()
    {

        if(request()->ajax())
        {
            return datatables()->of(PrestasiKetua::where('ketua_id',auth()->user()->ketua->id)->select('prestasi_ketuas.*'))
            ->editColumn('edit', function ($data) {
                $aksi = '<a href="'.route("hapus.kejuaraan", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $aksi;
            })
            ->editColumn('tanggal', function ($data) {
                $aksi = Carbon::parse($data->waktu)->format('d M Y');
                return $aksi;
            })
            ->rawColumns(['edit','tanggal'])
            ->make(true);
        }

        return view('leader.kejuaraan.index');
    }

    public function create()
    {
        return view('leader.kejuaraan.create');
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

        $ketua = Ketua::find(auth()->user()->ketua->id);
        $ketua->prestasi()->create([
            'judul' => $request->judul,
            'tempat' => $request->tempat,
            'waktu' => $request->waktu,
            'penyelenggara' => $request->penyelenggara,
            'prestasi' => $request->prestasi,
        ]);

        return redirect()->route('kejuaraan.index')->with('sukses','ye');
    }

    public function destroy($id)
    {
        $prestasi = PrestasiKetua::find($id);
        if (!$prestasi) {
            return redirect()->back();
        }

        $prestasi->delete();
        return redirect()->route('kejuaraan.index');
    }
}
