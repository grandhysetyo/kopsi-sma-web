<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tim;
use App\Models\Proposal;

class SeleksiController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Proposal::with(['tim' => function($q) {
                $q->has('unggahan');
            },'tim'])->orderby('lolos','ASC')->select('proposals.*'))

            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("seleksi-admin.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Detail</a>';
                return $mystring;
            })

            ->editColumn('statuss', function ($data) {
                if ($data->lolos == 0) {
                    $mystring = '<span class="text-yellow-500">Belum Ditentukan</span>';
                } else if ($data->lolos == 1) {
                    $mystring = '<span class="text-green-500">Lolos</span>';
                } else {
                    $mystring = '<span class="text-red-500">Tidak Lolos</span>';
                }
                
                
                return $mystring;
            })
           
            ->rawColumns(['edit','statuss'])
            ->make(true);
        }
        return view('admin.seleksi.index');
    }

    public function edit($id)
    {
        $proposal = Proposal::with('tim.unggahan.berkasss')->find($id);
        return view('admin.seleksi.edit', compact('proposal'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'lolos' => 'required',
        ]);

        Proposal::find($id)->update([
            'lolos' => $request->lolos,
        ]);

        return redirect()->route('seleksi-admin.index');
    }
}
