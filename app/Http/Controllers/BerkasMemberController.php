<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berkas;
use App\Models\UnggahanBerkasPeserta;
use App\Models\Tim;
use Storage;

class BerkasMemberController extends Controller
{
    public function index()
    {
        if (pembimbing(auth()->user()->anggota->tim->pembimbing->id) == 0) {
            return redirect()->route('pembimbing.member')->with('selesaikan','ye');
        } else {
            $berkas = Berkas::where('status',1)->get();
            if(request()->ajax())
            {
                return datatables()->of(UnggahanBerkasPeserta::with('berkasss')->where('tim_id',auth()->user()->anggota->tim->id)->select('unggahan_berkas_pesertas.*'))
                ->editColumn('edit', function ($data) {
                    $aksi = '<div class="dropdown">';
                    $aksi .= '<button class="dropdown-toggle btn btn-primary" aria-expanded="false">Aksi</button>';
                    $aksi .= '<div class="dropdown-menu w-40">';
                    $aksi .= '<div class="dropdown-menu__content box dark:bg-dark-1">';
                    $aksi .= '<div class="px-4 py-2 border-b border-gray-200 dark:border-dark-5 font-medium">Aksi</div>';
                    $aksi .= '<div class="p-2">';
                    $aksi .= '<a href="'.route('berkas-member.edit', $data->id).'" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> Edit </a>';
                    $aksi .= '<a href="'.route('hapus.berkas.member', $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> Hapus </a>';
                    $aksi .= '</div></div></div></div>';
                    return $aksi;
                })
                ->editColumn('berkass', function ($data) {
                    $aksi = '<a href="'.asset('uploads/'.$data->berkas).'" class="btn btn-primary">Buka</a>';
                    return $aksi;
                })
                ->rawColumns(['edit','berkass'])
                ->make(true);
            }

            return view('member.berkas.index', compact('berkas'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'berkas_id' => 'required',
            'berkas' => 'required|file|mimes:pdf|max:2048',
        ]);

        $tim = Tim::find(auth()->user()->anggota->tim->id);
        if (berkas($request->berkas_id,auth()->user()->anggota->tim->id)) {
            return redirect()->route('berkas-member.index')->with('gagal','Sudah Ada');
        } else {
            $tim->unggahan()->create([
                'berkas_id' => $request->berkas_id,
                'berkas' => $request->file('berkas')->store('berkas_tim'),
            ]);
        }

        return redirect()->route('berkas-member.index')->with('sukses','ye');
    }

    public function edit($id)
    {
        $berkas = UnggahanBerkasPeserta::with('berkasss')->find($id);
        return view('member.berkas.edit', compact('berkas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'berkas' => 'required|file|mimes:pdf|max:2048',
        ]);

        $berkas = UnggahanBerkasPeserta::find($id);
        Storage::delete($berkas->berkas);
        $berkas->update([
            'berkas' => $request->file('berkas')->store('berkas_tim'),
        ]);

        return redirect()->route('berkas-member.index')->with('sukses','ye');
    }

    public function destroy($id)
    {
        $berkas = UnggahanBerkasPeserta::find($id);
        if (!$berkas) {
            return redirect()->back();
        }

        Storage::delete($berkas->berkas);
        $berkas->delete();
        return redirect()->route('berkas-member.index');
    }
}
