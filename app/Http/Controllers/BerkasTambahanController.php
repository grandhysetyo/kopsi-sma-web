<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\BerkasPengumuman;
use App\Models\Info;
use Storage;

class BerkasTambahanController extends Controller
{
    public function index($id)
    {
        $info = Info::find($id);
        if(request()->ajax())
        {
            return datatables()->of(BerkasPengumuman::query())
            ->editColumn('edit', function ($data) use ($info) {
                $mystring = '<a href="'.route("lampiran.edit", [$info->id,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("lampiran.delete", [$info->id,$data->id]).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->editColumn('file', function ($data) use ($info) {
                if ($data->type == 0)
                {
                    $berkas = '<a href="'.asset('uploads/'.$data->berkas).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Buka Berkas</a>';
                }

                else if ($data->type == 1)
                {
                    $berkas = '<a href="'.$data->url.'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Buka Tautan</a>';
                }

                return $berkas;
            })
            ->rawColumns(['edit','file'])
            ->make(true);
        }
        return view('admin.info.berkas.index', compact('info'));
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required',
            'type' => 'required',
        ]);

        $info = Info::find($id);

        if ($request->type == 0) {
            $info->berkas()->create([
                'judul' => $request->judul,
                'type' => $request->type,
                'berkas' => $request->file('berkas')->store('berkas_pengumuman'), 
            ]);
        } else if ($request->type == 1) {
            $info->berkas()->create([
                'judul' => $request->judul,
                'type' => $request->type,
                'url' => $request->url,
            ]);
        }

        return redirect()->route('lampiran.index', $id);
    }

    public function edit($id,$berkas)
    {
        $info = Info::find($id);
        $file = BerkasPengumuman::find($berkas);
        return view('admin.info.berkas.edit', compact('file','info'));        
    }

    public function update(Request $request, $id, $berkas)
    {
        $this->validate($request, [
            'judul' => 'required',
            'type' => 'required',
            
        ]);
        $info = Info::find($id);
        $file = BerkasPengumuman::find($berkas);

        if ($file->type == $request->type) {
            if ($request->type == 0) {
                Storage::delete($file->berkas);
                $file->update([
                    'judul' => $request->judul,
                    'type' => $request->type,
                    'berkas' => $request->file('berkas')->store('berkas_pengumuman'), 
                ]);
            } else if ($request->type == 1) {
                $file->update([
                    'judul' => $request->judul,
                    'type' => $request->type,
                    'url' => $request->url,
                ]);
            }
        } else {
            if (empty($file->berkas)) {
                if ($request->type == 0) {
                    Storage::delete($file->berkas);
                    $file->update([
                        'judul' => $request->judul,
                        'type' => $request->type,
                        'berkas' => $request->file('berkas')->store('berkas_pengumuman'), 
                    ]);
                } else if ($request->type == 1) {
                    $file->update([
                        'judul' => $request->judul,
                        'type' => $request->type,
                        'url' => $request->url,
                    ]);
                }
            } else {
                Storage::delete($file->berkas);
                if ($request->type == 0) {
                    $file->update([
                        'judul' => $request->judul,
                        'type' => $request->type,
                        'berkas' => $request->file('berkas')->store('berkas_pengumuman'), 
                    ]);
                } else if ($request->type == 1) {
                    $file->update([
                        'judul' => $request->judul,
                        'type' => $request->type,
                        'url' => $request->url,
                    ]);
                }
            }
        }

        return redirect()->route('lampiran.index', $id);
      }
 
    public function destroy($id, $berkas)
    {
        $file = BerkasPengumuman::find($berkas);
        if (!$file) {
            return redirect()->back();
        }
        
        if (!empty($file->berkas))
        {
            Storage::delete($file->berkas);
        }
        
        $file->delete();
        return redirect()->route('lampiran.index', $id);
    }      
}
