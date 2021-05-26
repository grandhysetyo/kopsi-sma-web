<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Linimasa;
use Illuminate\Support\Str;

class LinimasaController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Linimasa::query())
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("linimasa.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.linimasa", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
           
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.linimasa.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        Linimasa::create([
            'title' => $request->title,
        ]);

        return redirect()->route('linimasa.index');
    }

    public function edit($id)
    {
        $linimasa = Linimasa::find($id);
        return view('admin.linimasa.edit', compact('linimasa'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        Linimasa::find($id)->update([
            'title' => $request->title,
        ]);

        return redirect()->route('linimasa.index');
    }

    public function destroy($id)
    {
        $linimasa = Linimasa::find($id);
        if (!$linimasa) {
            return redirect()->back();
        }
        $linimasa->delete();
        return redirect()->route('linimasa.index');
    }


}
