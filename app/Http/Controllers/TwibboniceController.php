<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Twibbonice;
use Storage;

class TwibboniceController extends Controller
{
    public function edit($id)
    {
        $twibbon = Twibbonice::find($id);
        return view('admin.twibbon.edit', compact('twibbon'));
    }

    public function update(Request $request, $id)
    {
        $twibbon = Twibbonice::find($id);

        $this->validate($request, [
            'template' => 'required',
            'caption' => 'required',
        ]);

        Storage::delete($twibbon->template);

        $twibbon->update([
            'caption' => $request->caption,
            'template' => $request->file('template')->store('template_twibbon'),
        ]);

        return redirect()->route('twibbonice-template.edit', $id)->with('berhasil','yess');
    }
}
