<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poster;
use App\Models\Tim;
use App\Models\Countdown;
use Storage;
use PDF;

class PosterController extends Controller
{
    public function index()
    {
        $time = Countdown::find(1);
        if (now()->isBefore($time->batas_unggah_poster)) {
            $poster = Poster::where('tim_id',auth()->user()->ketua->tim->id)->first();
            return view('leader.poster.index', compact('poster'));
        } else {
            return redirect()->route('leader')->with('tutup_poster','tutup');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'poster' => 'required|file|mimes:pdf|max:5048',
		]);

        $tim = Tim::find(auth()->user()->ketua->tim->id);

        $tim->poster()->create([
            'poster' => $request->file('poster')->store('poster'),
        ]);

        return redirect()->route('poster.index')->with('berhasil','ye');
    }

    public function edit($id)
    {
        $time = Countdown::find(1);
        if (now()->isBefore($time->batas_unggah_poster)) {
            if (count_poster(auth()->user()->ketua->tim->id) == 0) {
                $poster = Poster::find($id);
                return view('leader.poster.edit', compact('poster'));
            } else {
                return redirect()->route('poster.index')->with('max','max');
            }
        } else {
            return redirect()->route('leader')->with('tutup_poster','tutup');
        }  
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'poster' => 'file|mimes:pdf|max:5048',
		]);

        $poster = Poster::find($id);
        Storage::delete($poster->poster);
        $poster->update([
            'count' => 1,
            'poster' => $request->file('poster')->store('poster'),
          ]);

        return redirect()->route('poster.index')->with('sukses','ye');
    }
}
