<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berkas;
use App\Models\UnggahanBerkas;
use App\Models\Tim;
use Storage;

class BerkasController extends Controller
{
    public function index()
    {
        if (pembimbing(auth()->user()->ketua->tim->pembimbing->id) == 0) {
            return redirect()->route('pembimbing.leader')->with('selesaikan','ye');
        } else {
            $berkas = Berkas::where('status',1)->get();
            if(request()->ajax())
            {
                return datatables()->of(UnggahanBerkas::with('berkasss')->where('tim_id',auth()->user()->ketua->tim->id)->select('unggahan_berkas.*'))
                ->editColumn('edit', function ($data) {
                    $aksi = '<a href="'.route("berkas.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.berkas", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                    return $aksi;
                })
                ->editColumn('berkass', function ($data) {
                    $aksi = '<a href="'.asset('uploads/'.$data->berkas).'" class="bg-green-500 text-white p-2 rounded mr-2 font-bold">Buka</a>';
                    return $aksi;
                })
                ->rawColumns(['edit','berkass'])
                ->make(true);
            }

            return view('leader.berkas.index', compact('berkas'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'berkas_id' => 'required',
            'berkas' => 'required|file|mimes:pdf|max:2048',
        ],[
            'berkas_id.required'=> 'Jenis berkas tidak boleh kosong',
            'berkas.required'=> 'Berkas tidak boleh kosong',
            'berkas.file'=> 'Harus berbentuk berkas',
            'berkas.mimes'=> 'Berkas harus PDF',
            'berkas.max'=> 'Berkas harus kurang dari 2MB',
           ]);

        $tim = Tim::find(auth()->user()->ketua->tim->id);
        if (berkas($request->berkas_id,auth()->user()->ketua->tim->id)) {
            return redirect()->route('berkas.index')->with('gagal','Sudah Ada');
        } else {
            $tim->unggahan()->create([
                'berkas_id' => $request->berkas_id,
                'berkas' => $request->file('berkas')->store('berkas_tim'),
            ]);
        }

        return redirect()->route('berkas.index')->with('sukses','ye');
    }

    public function edit($id)
    {
        $berkas = UnggahanBerkas::with('berkasss')->find($id);
        return view('leader.berkas.edit', compact('berkas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'berkas' => 'required|file|mimes:pdf|max:2048',
        ],[
            'berkas.required'=> 'Berkas tidak boleh kosong',
            'berkas.file'=> 'Harus berbentuk berkas',
            'berkas.mimes'=> 'Berkas harus PDF',
            'berkas.max'=> 'Berkas harus kurang dari 2MB',
           ]);

        $berkas = UnggahanBerkas::find($id);
        Storage::delete($berkas->berkas);
        $berkas->update([
            'berkas' => $request->file('berkas')->store('berkas_tim'),
        ]);

        return redirect()->route('berkas.index')->with('sukses','ye');
    }

    public function destroy($id)
    {
        $berkas = UnggahanBerkas::find($id);
        if (!$berkas) {
            return redirect()->back();
        }

        Storage::delete($berkas->berkas);
        $berkas->delete();
        return redirect()->route('berkas.index');
    }
}
