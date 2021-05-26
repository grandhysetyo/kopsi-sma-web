<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ketua;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Storage;

class KetuaController extends Controller
{
    public function index()
    {
        $user = User::where('role',2)->get();
        if(request()->ajax())
        {
            return datatables()->of(Juri::with('user')->select('juris.*'))
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("juri.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.juri", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.juri.index', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'occupation' => 'required',
            'instansi' => 'required',
            'foto' => 'required|file|max:1024',
        ]);

        Juri::create([
            'user_id' => $request->user_id,
            'occupation' => $request->occupation,
            'instansi' => $request->instansi,
            'foto' => $request->file('foto')->store('juri'), 
        ]);
        
        return redirect()->route('juri.index');
    }

    public function edit($id)
    {
        $juri = Juri::find($id);
        $user = User::where('role',2)->get();
        return view('admin.juri.edit', compact('juri','user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'occupation' => 'required',
            'instansi' => 'required',
            'foto' => 'file|max:1024',
        ]);

        $juri = Juri::find($id);

        if (empty($request->file('foto'))) {
            $juri->update([
                'user_id' => $request->user_id,
                'occupation' => $request->occupation,
                'instansi' => $request->instansi,
            ]);
        } else {
            Storage::delete($juri->foto);
            $juri->update([
                'user_id' => $request->user_id,
                'occupation' => $request->occupation,
                'instansi' => $request->instansi,
                'foto' => $request->file('foto')->store('juri'),
            ]);
        }

        return redirect()->route('juri.index');
    }

    public function destroy($id)
    {
        $juri = Juri::find($id);
        if (!$juri) {
            return redirect()->back();
        }
        Storage::delete($juri->foto);
        $juri->delete();
        return redirect()->route('juri.index');
    }

}
