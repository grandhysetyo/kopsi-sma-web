<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Countdown;
use App\Models\Twibbon;
use App\Models\Twibbonice;
use Storage;

class TwibbonController extends Controller
{
    public function index()
    {
        $time = Countdown::find(1);
        if (now()->isBefore($time->pendaftaran)) {
            $twibbon = Twibbonice::with('user')->where('user_id',auth()->user()->id)->get();
            return view('leader.twibbon.index', compact('twibbon'));
        } else {
            return redirect()->route('landing')->with('tutup','tutup');
        }
    }

    public function create()
    {
        $time = Countdown::find(1);
        if (now()->isBefore($time->pendaftaran)) {
            if (twibbon(auth()->user()->id)) {
                return redirect()->route('twibbonice.index');
            } else {
                return view('leader.twibbon.create');
            }
        } else {
            return redirect()->route('landing')->with('tutup','tutup');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required',
        ]);
 
        $image = $request->foto;

        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name= time().'.png';
        $path = public_path('uploads/twibbon/'.$image_name);

        file_put_contents($path, $image);

        auth()->user()->twibbon()->create([
            'foto' => 'twibbon/'.$image_name,
            'kunci' => rand(),
        ]);

        return response()->json(['status'=>3]);
    }

    public function destroy($id)
    {
        $twibbon = Twibbonice::find($id);
        if (!$twibbon) {
            return redirect()->back();
        }

        Storage::delete($twibbon->foto);
        $twibbon->delete();
        return redirect()->route('twibbonice.index');
    }
}
