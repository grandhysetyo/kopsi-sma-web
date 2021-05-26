<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Tim;
use App\Models\Countdown;
use Storage;
use PDF;

class ProposalController extends Controller
{
    public function index()
    {
        $time = Countdown::find(1);
        if (now()->isBefore($time->batas_unggah_proposal)) {
            $proposal = Proposal::with('seleksi_proposal')->where('tim_id',auth()->user()->ketua->tim->id)->first();
            return view('leader.proposal.index', compact('proposal'));
        } else {
            return redirect()->route('leader')->with('tutup_proposal','tutup');
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'proposal' => 'required|file|mimes:pdf|max:5048',
		]);

        $tim = Tim::with('bidang')->find(auth()->user()->ketua->tim->id);

        $tim->proposal()->create([
            'proposal' => $request->file('proposal')->store('proposal'),
            'kode_registrasi' => $tim->bidang->kode.date('y').urutan_proposal(),
            'urutan' => urutan_proposal(),
        ]);

        return redirect()->route('proposal.index')->with('berhasil','ye');
    }

    public function edit($id)
    {
        $time = Countdown::find(1);
        if (now()->isBefore($time->batas_unggah_proposal)) {
            if (count_proposal(auth()->user()->ketua->tim->id) == 0) {
                $proposal = Proposal::find($id);
                return view('leader.proposal.edit', compact('proposal'));
            } else {
                return redirect()->route('proposal.index')->with('max','max');
            }
        } else {
            return redirect()->route('leader')->with('tutup_proposal','tutup');
        }  
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'proposal' => 'required|file|mimes:pdf|max:5048',
        ]);

        $proposal = Proposal::find($id);
        Storage::delete($proposal->proposal);
        $proposal->update([
            'proposal' => $request->file('proposal')->store('proposal'),
            'count' => 1,
        ]);

        return redirect()->route('proposal.index')->with('sukses','ye');
    }

    public function pdf($id)
    {
        $proposal = Proposal::with('tim.sekolah.kelurahan.district.regency.province','tim.bidang.bidang','tim.ketua.user','tim.anggota.user','tim.pembimbing')->find($id);
        $nama = 'Kartu Pendaftaran KoPSI ' . $proposal->tim->nama_tim . '.pdf';
        $pdf = PDF::loadView('leader.proposal.bukti', compact('proposal'))->setPaper('a4', 'potrait');
        return $pdf->download($nama);
    }
}
