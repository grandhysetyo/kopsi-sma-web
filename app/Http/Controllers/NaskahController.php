<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Naskah;
use App\Models\Tim;
use App\Models\Countdown;
use Storage;
use PDF;

class NaskahController extends Controller
{
    public function index()
    {
        $time = Countdown::find(1);
        if (now()->isBefore($time->batas_unggah_naskah)) {
            if (cek_naskah(auth()->user()->ketua->tim->id))
            {
                $naskah = Naskah::where('tim_id',auth()->user()->ketua->tim->id)->first();
                return view('leader.naskah.index', compact('naskah'));
            }

            else {
                return view('leader.naskah.index');
            }
            
        } else {
            return redirect()->route('leader')->with('tutup_naskah','tutup');
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'naskah' => 'required|file|mimes:pdf|max:5048',
            'logbook' => 'required|file|mimes:pdf|max:5048',
            'abstrak' => 'required',
		]);

        $tim = Tim::find(auth()->user()->ketua->tim->id);

        $tim->naskah()->create([
            'naskah' => $request->file('naskah')->store('naskah'),
            'logbook' => $request->file('logbook')->store('logbook'),
            'abstrak' => $request->abstrak,
        ]);

        return redirect()->route('naskah.index')->with('berhasil','ye');
    }

    public function edit($id)
    {
        $time = Countdown::find(1);
        if (now()->isBefore($time->batas_unggah_naskah)) {
            if (count_naskah(auth()->user()->ketua->tim->id) == 0) {
                $naskah = Naskah::find($id);
                return view('leader.naskah.edit', compact('naskah'));
            } else {
                return redirect()->route('naskah.index')->with('max','max');
            }
        } else {
            return redirect()->route('leader')->with('tutup_naskah','tutup');
        }  
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'naskah' => 'file|mimes:pdf|max:5048',
            'logbook' => 'file|mimes:pdf|max:5048',
            'abstrak' => 'required',
		]);

        $naskah = Naskah::find($id);

        if (empty($request->file('naskah'))) {
            if (empty($request->file('logbook'))) {
              $naskah->update([
                'abstrak' => $request->abstrak,
                'count' => 1,
              ]);
            } else {
              Storage::delete($naskah->logbook);
              $naskah->update([
                'abstrak' => $request->abstrak,
                'count' => 1,
                'logbook' => $request->file('logbook')->store('logbook'),
              ]);
          }
        } else {
            if (empty($request->file('logbook'))) {
              Storage::delete($naskah->naskah);
              $naskah->update([
                'abstrak' => $request->abstrak,
                'count' => 1,
                'naskah' => $request->file('naskah')->store('naskah'),
              ]);
          } else {
              Storage::delete($naskah->logbokk);
              Storage::delete($naskah->naskah);
              $naskah->update([
                'abstrak' => $request->abstrak,
                'count' => 1,
                'logbook' => $request->file('logbook')->store('logbook'),
                'naskah' => $request->file('naskah')->store('naskah'),
              ]);
          }
          }

        return redirect()->route('naskah.index')->with('sukses','ye');
    }
}
