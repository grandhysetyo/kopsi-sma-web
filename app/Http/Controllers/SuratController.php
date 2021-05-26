<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berkas;
use Illuminate\Support\Str;

class SuratController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Berkas::query())
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("surat.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.surat", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.surat.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_surat' => 'required',
        ]);

        Berkas::create([
            'nama_surat' => $request->nama_surat, 
        ]);
        
        return redirect()->route('surat.index');
    }

    public function edit($id)
    {
        $surat = Berkas::find($id);
        return view('admin.surat.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_surat' => 'required',
        ]);

        $surat = Berkas::find($id);

        $surat->update([
            'nama_surat' => $request->nama_surat, 
        ]);

        return redirect()->route('surat.index');
    }

    public function destroy($id)
    {
        $surat = Berkas::find($id);
        if (!$surat) {
            return redirect()->back();
        }
       
        $surat->delete();
        return redirect()->route('surat.index');
    }

}
