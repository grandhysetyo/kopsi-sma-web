<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Linimasa;
use App\Models\Tanggal;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TanggalController extends Controller
{
    public function index()
    {
        $linimasa = Linimasa::all();
        if(request()->ajax())
        {
            return datatables()->of(Tanggal::with('linimasa')->orderby('start','ASC')->select('tanggals.*'))
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("tanggal.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.tanggal", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->editColumn('tanggal', function ($data) {
                if (empty($data->end)) {
                    $tanggal = Carbon::parse($data->start)->format('d M Y');
                } else {
                    $tanggal = date_range($data->start,$data->end);
                }

                return $tanggal;
            })
           
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.tanggal.index', compact('linimasa'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'start' => 'required',
            'linimasa_id' => 'required',
        ]);

        Tanggal::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'linimasa_id' => $request->linimasa_id,
        ]);

        return redirect()->route('tanggal.index');
    }

    public function edit($id)
    {
        $tanggal = Tanggal::find($id);
        $linimasa = Linimasa::all();
        return view('admin.tanggal.edit', compact('tanggal','linimasa'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'start' => 'required',
            'linimasa_id' => 'required',
        ]);

        Tanggal::find($id)->update([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'linimasa_id' => $request->linimasa_id,
        ]);

        return redirect()->route('tanggal.index');
    }

    public function destroy($id)
    {
        $tanggal = Tanggal::find($id);
        if (!$tanggal) {
            return redirect()->back();
        }
        $tanggal->delete();
        return redirect()->route('tanggal.index');
    }


}
