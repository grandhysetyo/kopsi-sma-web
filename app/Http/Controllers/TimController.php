<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tim;
use App\Models\Sekolah;
use App\Models\Bidang;
use Illuminate\Support\Str;

class TimController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Tim::with('sekolah','bidang.kategori')->select('tims.*'))
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("tim.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.tim", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.tim.index');
    }

    public function create()
    {
        $sekolah = Sekolah::doesnthave('tim')->get();
        $bidang = Bidang::with('kategori')->get();
        return view('admin.tim.create', compact('sekolah','bidang'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_tim' => 'required',
            'province_id' => 'required',
            'sekolah_id' => 'required',
            'bidang_id' => 'required',
        ]);

        Tim::create([
            'nama_tim' => $request->nama_tim, 
            'province_id' => $request->province_id, 
            'sekolah_id' => $request->sekolah_id, 
            'bidang_id' => $request->bidang_id,
        ]);
        
        return redirect()->route('tim.index');
    }

    public function edit($id)
    {
        $tim = Tim::find($id);
        return view('admin.tim.edit', compact('tim'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_tim' => 'required',
            'province_id' => 'required',
            'sekolah_id' => 'required',
            'bidang_id' => 'required',
        ]);

        $tim = Tim::find($id);

        $tim->update([
            'nama_tim' => $request->nama_tim, 
            'province_id' => $request->province_id, 
            'sekolah_id' => $request->sekolah_id, 
            'bidang_id' => $request->bidang_id,
        ]);

        return redirect()->route('tim.index');
    }

    public function destroy($id)
    {
        $tim = Tim::find($id);
        if (!$tim) {
            return redirect()->back();
        }
       
        $tim->delete();
        return redirect()->route('tim.index');
    }

}
