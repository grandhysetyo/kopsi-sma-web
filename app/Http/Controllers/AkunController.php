<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AkunController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(User::query())
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("akun.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.akun", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->editColumn('rolee', function ($data) {
                if ($data->role == 1) {
                    $mystring = 'Admin';
                } else if ($data->role == 2) {
                    $mystring = 'Juri';
                } else if ($data->role == 3) {
                    $mystring = 'Ketua';
                } else if ($data->role == 4) {
                    $mystring = 'Anggota';
                }
                
                return $mystring;
            })
            ->rawColumns(['edit','rolee'])
            ->make(true);
        }
        return view('admin.user.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            'name'    =>  'required',
            'email'     =>  'required',
            'password'    =>  'required',
            'role'    =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        $form_data = array(
            'name'        =>  $request->name,
            'email'         =>  $request->email,
            'role'         =>  $request->role,
            'password' => Hash::make($request->password),
        );

        $user = User::where('email',$request->email)->exists();
        if ($user) {
            return redirect()->route('akun.index')->with('eror', 'Email Sudah ada');
        } else {
            $user = User::create($form_data);
        }
        
        return redirect()->route('akun.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (empty($request->password)) {
            $peserta = User::find($id);
            $peserta->update([
                'name'        =>  $request->name,
                'email'         =>  $request->email,
                'role'         =>  $request->role,
            ]);
        } else {
            $peserta = User::find($id);
            $peserta->update([
                'name'        =>  $request->name,
                'email'         =>  $request->email,
                'role'         =>  $request->role,
                'password' => Hash::make($request->password),
            ]);
        }
        return redirect()->route('akun.index');
    }

    public function destroy($id)
    {
        $peserta = User::find($id);
        if (!$peserta) {
            return redirect()->back();
        }
        $peserta->delete();
        return redirect()->route('akun.index');
    }

}
