<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Countdown;

class CountdownController extends Controller
{
    public function edit($id)
    {
        $countdown = Countdown::find($id);
        return view('admin.countdown.edit', compact('countdown'));
    }

    public function update(Request $request, $id)
    {
        $countdown = Countdown::find($id);

        $this->validate($request, [
            'pendaftaran' => 'required',
            'pengumuman_finalis' => 'required',
        ]);

        $countdown->update([
            'pendaftaran' => $request->pendaftaran,
            'pengumuman_finalis' => $request->pengumuman_finalis,
        ]);

        return redirect()->route('countdown.edit', $id)->with('berhasil','yess');
    }
}
