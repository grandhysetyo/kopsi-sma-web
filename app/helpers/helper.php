<?php
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Ketua;
use App\Models\Pembimbing;
use App\Models\Anggota;
use App\Models\UnggahanBerkas;
use App\Models\UnggahanBidang;
use App\Models\Twibbonice;
use App\Models\Proposal;
use App\Models\Naskah;
use App\Models\SeleksiProposal;
use App\Models\SeleksiNaskah;
use App\Models\OrangTuaKetua;
use App\Models\Tim;
use App\Models\Poster;
use App\Models\Presentasi;
use App\Models\UnggahanTim;
use App\Models\Tanggal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

function date_range($start,$end)
{
    $startDate = Carbon::parse($start);
    $endDate = Carbon::parse($end);

    $period = CarbonPeriod::create($startDate, $endDate);

    $p = array();

    foreach ($period as $date) {
        $p[] = $date->format('d M Y');
    }

    $first = reset($p);
    $last = end($p);
    if (Carbon::parse($first)->format('Y') == Carbon::parse($last)->format('Y')) {
        if (Carbon::parse($first)->format('M') == Carbon::parse($last)->format('M')) {
            $awal = Carbon::parse($first)->format('d');
        } else {
            $awal = Carbon::parse($first)->format('d M');
        }
    } else {
        $awal = $first;
    }
    

    $tes = array($awal, $last);
    
    return implode(" - ", $tes);
}


function nisn($nisn)
{
    return Ketua::where('nisn',$nisn)->exists();
}

function nisn_anggota($nisn)
{
    return Anggota::where('nisn',$nisn)->exists();
}

function kuota($tim)
{
    return Anggota::where('tim_id',$tim)->count();
}

function pembimbing($id)
{
    $pembimbing = Pembimbing::find($id);
    if (empty($pembimbing->surat_kepsek)) {
        return 0;
    } else {
        return 1;
    }
}

function berkas($berkas,$tim)
{
    return UnggahanBerkas::where('berkas_id',$berkas)->where('tim_id',$tim)->exists();
}

function count_proposal($tim)
{
    $proposal = Proposal::where('tim_id',$tim)->exists();
    if ($proposal)
    {
        $pro = Proposal::where('tim_id',$tim)->first();
        $count = $pro->count;
    }
    return $count;
}

function count_naskah($tim)
{
    $naskah = Naskah::where('tim_id',$tim)->exists();
    if ($naskah)
    {
        $nas = Naskah::where('tim_id',$tim)->first();
        $count = $nas->count;
    }
    return $count;
}

function count_poster($tim)
{
    $poster = Poster::where('tim_id',$tim)->exists();
    if ($poster)
    {
        $nas = Poster::where('tim_id',$tim)->first();
        $count = $nas->count;
    }
    return $count;
}


function proposal($tim)
{
    return $proposal = Proposal::where('tim_id',$tim)->exists();
}

function presentasi($tim)
{
    return $presentasi = Presentasi::where('tim_id',$tim)->exists();
}

function naskah($tim)
{
    return $naskah = Naskah::where('tim_id',$tim)->exists();
}

function poster($tim)
{
    return $poster = Poster::where('tim_id',$tim)->exists();
}

function seleksi_proposal($proposal)
{
    return $proposal = SeleksiProposal::where('proposal_id',$proposal)->exists();
}

function seleksi_naskah($naskah)
{
    return $naskah = SeleksiNaskah::where('naskah_id',$naskah)->exists();
}

function cek_naskah($tim)
{
    return Naskah::where('tim_id',$tim)->exists();
}

function seleksi_naskah_dasbor($tim)
{
    return $naskah = SeleksiNaskah::whereHas('naskah', function($q) use($tim) {
        $q->where('tim_id', $tim);
     })->exists();
}

function seleksi_proposals($tim)
{
    return $proposal = SeleksiProposal::whereHas('proposal', function($q) use($tim) {
        $q->where('tim_id', $tim);
     })->exists();
}

function seleksi_proposal_cek($tim)
{
    return $proposal = SeleksiProposal::whereHas('proposal', function($q) use($tim) {
        $q->where('tim_id', $tim);
     })->exists();
}

function seleksi_naskah_cek($tim)
{
    return $proposal = SeleksiNaskah::whereHas('naskah', function($q) use($tim) {
        $q->where('tim_id', $tim);
     })->exists();
}

function proposal_tim($tim)
{
    $proposal = SeleksiProposal::whereHas('proposal', function($q) use($tim) {
        $q->where('tim_id', $tim);
     })->first();

    return $proposal->status;
}

function naskah_tim($tim)
{
    $naskah = Naskah::where('tim_id',$tim)->first();

    return $naskah->status;
}

function filee($tim)
{
    return UnggahanBerkas::where('tim_id',$tim)->count();
}

function cek_type($id)
{
    return UnggahanBidang::where('id',$id)->first()->type;
}

function unggahan($berkas,$tim)
{
    return UnggahanTim::where('berkas_id',$berkas)->where('tim_id',$tim)->exists();
}

function twibbon($user)
{
    return Twibbonice::where('user_id',$user)->exists();
}

function biodata_ketua($user)
{
    $ketua = Ketua::where('user_id',$user)->first();
    return $ketua->status;
}

function biodata_anggota($user)
{
    $anggota = Anggota::where('user_id',$user)->first();
    return $anggota->status;
}

function tim_ketua($user)
{
    $tim = Tim::where('sekolah_id',$user)->first();
    return $tim->simpan;
}

function ortu_ketua($user)
{
    $ortu = OrangTuaKetua::where('ketua_id',$user)->first();
    return $ortu->status;
}

function urutan_proposal()
{
    $proposal = Proposal::exists();
    if ($proposal) {
        $angkas = Proposal::latest()->first();
        $angkass = $angkas->urutan+=1;
        $angka = sprintf('%03d',$angkass);
    } else {
        $angkas = 001;
        $angka = sprintf('%03d',$angkas);
    }
    
    return $angka;
}

function tanggal($linimasa)
{
    $tanggal = Tanggal::where('linimasa_id',$linimasa)->orderby('start','ASC')->get();
    $hasil = [];

        foreach ($tanggal as $data) {
            if (empty($data->end)) {
                $tanggal = Carbon::parse($data->start)->format('d M Y');
            } else {
                $tanggal = date_range($data->start,$data->end);
            }
            $hasil[] = ([
                'id' => $data->id,
                'title' => $data->title,
                'tanggal' => $tanggal,
            ]);
        }
    return $hasil;
}