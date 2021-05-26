<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presentasi;
use App\Models\Tim;
use App\Models\Countdown;
use App\Models\LinkMeeting;
use Storage;
use PDF;

class PresentasiController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(LinkMeeting::with('bidang')->select('link_meetings.*'))
            ->editColumn('edit', function ($data) {
                $aksi = '<a href="'.$data->url.'" class="bg-blue-500 text-white p-2 rounded mr-2 font-bold">Buka</a>';
                return $aksi;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('leader.presentasi.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'konfirmasi' => 'required',
		]);

        $tim = Tim::find(auth()->user()->ketua->tim->id);

        $tim->presentasi()->create([
            'konfirmasi' => $request->konfirmasi,
        ]);

        return redirect()->route('presentasi.index')->with('berhasil','ye');
    }
}
