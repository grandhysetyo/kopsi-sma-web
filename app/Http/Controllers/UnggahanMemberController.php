<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnggahanBidang;
use App\Models\UnggahanTim;
use App\Models\Tim;
use Storage;

class UnggahanMemberController extends Controller
{
    public function index()
    {
        if (filee(auth()->user()->anggota->tim_id) >= 2) {
            
            if(request()->ajax())
            {
                return datatables()->of(UnggahanTim::with('unggahan_bidang')->where('tim_id',auth()->user()->anggota->tim->id)->select('unggahan_tims.*'))
                ->editColumn('edit', function ($data) {
                    $aksi = '<a href="'.route('hapus.unggahan.member', $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="btn btn-danger" aria-expanded="false">Hapus</a>';
                    return $aksi;
                })
                ->editColumn('unggahan_file_tim', function ($data) {
                    if ($data->unggahan_bidang->type == 'file') {
                        $aksi = '<a href="'.asset('uploads/'.$data->input).'" class="btn btn-primary">Buka</a>';
                    } else if ($data->unggahan_bidang->type == 'url') {
                        $aksi = '<a href="'.$data->input.'" class="btn btn-primary">Buka</a>';
                    } else {
                        $aksi = '<a href="'.$data->input.'" class="btn btn-primary">Buka</a>';
                    }
                    
                    return $aksi;
                })
                ->rawColumns(['edit','unggahan_file_tim'])
                ->make(true);
            }

            return view('member.unggahan.index');
        } else {
            return redirect()->route('berkas-member.index')->with('selesaikan','ye');
        }
    }

    public function create()
    {
        $unggahan = UnggahanBidang::where('bidang_id',auth()->user()->anggota->tim->bidang_id)->get();
        return view('member.unggahan.create', compact('unggahan'));
    }

    public function cek($id)
    {
        $unggahan = UnggahanBidang::where('id',$id)->first();
        return response()->json($unggahan);
    }

    public function store(Request $request)
    {
        if (cek_type($request->berkas_id) == 'file') {
            $request->validate([
                'berkas_id' => 'required',
                'input' => 'required|file|mimes:pdf',
            ]);

            $tim = Tim::find(auth()->user()->anggota->tim->id);
            if (unggahan($request->berkas_id,auth()->user()->anggota->tim->id)) {
                return redirect()->route('unggahan-member.index')->with('gagal','Sudah Ada');
            } else {
                $tim->unggahan_tim()->create([
                    'berkas_id' => $request->berkas_id,
                    'input' => $request->file('input')->store('unggahan_tim'),
                ]);
            }
        } else {
            $request->validate([
                'berkas_id' => 'required',
                'input' => 'required',
            ]);

            $tim = Tim::find(auth()->user()->anggota->tim->id);
            if (unggahan($request->berkas_id,auth()->user()->anggota->tim->id)) {
                return redirect()->route('unggahan-member.index')->with('gagal','Sudah Ada');
            } else {
                $tim->unggahan_tim()->create([
                    'berkas_id' => $request->berkas_id,
                    'input' => $request->input,
                ]);
            }
        }
        
        return redirect()->route('unggahan-member.index')->with('sukses','ye');
    }

    public function destroy($id)
    {
        $unggahan = UnggahanTim::with('unggahan_bidang')->find($id);
        if (cek_type($unggahan->unggahan_bidang->id) == 'file') {
           
            if (!$unggahan) {
                return redirect()->back();
            }
    
            Storage::delete($unggahan->input);
            $unggahan->delete();
        }

        else {
            
            if (!$unggahan) {
                return redirect()->back();
            }
            $unggahan->delete();
        }

        return redirect()->route('unggahan-member.index')->with('sukses','yeee');
    }
}
