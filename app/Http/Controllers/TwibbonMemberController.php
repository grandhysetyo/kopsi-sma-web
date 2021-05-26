<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Countdown;
use App\Models\Twibbonice;
use Storage;

class TwibbonMemberController extends Controller
{
    public function index()
    {
        $twibbon = Twibbonice::with('user')->where('user_id',auth()->user()->id)->get();
        return view('member.twibbon.index', compact('twibbon'));
    }

    public function create()
    {
        if (twibbon(auth()->user()->id)) {
            return redirect()->route('twibbonice-member.index');
        } else {
            return view('member.twibbon.create');
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

        return response()->json(['status'=>4]);
    }

    public function destroy($id)
    {
        $twibbon = Twibbonice::find($id);
        if (!$twibbon) {
            return redirect()->back();
        }

        Storage::delete($twibbon->foto);
        $twibbon->delete();
        return redirect()->route('twibbonice-member.index');
    }
}
