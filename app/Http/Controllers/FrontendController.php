<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Village;
use App\Models\SubBidang;
use App\Models\Bidang;
use App\Models\Sekolah;
use App\Models\User;
use App\Models\Ketua;
use App\Models\Info;
use App\Models\Tim;
use App\Models\Linimasa;
use App\Models\Countdown;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;


class FrontendController extends Controller
{

   public function index()
   {
      $time = Countdown::find(1);
      return view('welcome', compact('time'));
   }
   public function ketua()
   {
      $time = Countdown::find(1);
      if (now()->isBefore($time->pendaftaran)) {
         return view('auth.ketua_register');
      } else {
         return redirect()->route('landing')->with('tutup','tutup');
      }
   }

   public function kode_ref($kode)
   {
      $ketua = Ketua::with('user:id,name','tim.sekolah')->where('kode',$kode)->first();
      if ($ketua == null) {
         $respon = 0;
      } else {
         $respon = $ketua;
      }
      
      return response()->json($respon);
   }

   public function anggota()
   {
      $time = Countdown::find(1);
      if (now()->isBefore($time->pendaftaran)) {
         return view('auth.anggota_register');
      } else {
         return redirect()->route('landing')->with('tutup','tutup');
      }
   }

    public function get_bidang($id) 
    {
        $bidang = Bidang::where("kategori_id",$id)->pluck("nama_bidang","id");
        return json_encode($bidang);
    }

    public function province(Request $request)
    {
      $search = $request->search;
      if($search == '')
      {
         $province = Province::orderby('name','asc')->select('id','name')->limit(5)->get();
      } else {
         $province = Province::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
      }
  
      $response = array();
      foreach($province as $item){
         $response[] = array(
            "id"=>$item->id,
            "text"=>$item->name
         );
      }
  
      echo json_encode($response);
      exit;
    }

    public function kelurahann(Request $request)
    {
      $search = $request->search;
      if($search == '')
      {
         $kelurahan = Village::with('district.regency.province')->orderby('name','asc')->limit(5)->get();
      } else {
         $kelurahan = Village::with('district.regency.province')->orderby('name','asc')->where('name', 'like', '%' .$search . '%')->get();
      }
  
      $response = array();
      foreach($kelurahan as $item){
         $response[] = array(
            "id"=>$item->id,
            "text"=>$item->name.', '.$item->district->name.', '.$item->district->regency->name.', '.$item->district->regency->province->name,
         );
      }
  
      echo json_encode($response);
      exit;
   }

    public function kelurahan(Request $request){

      $search = $request->search;

      if($search == ''){
         $kelurahan = Village::with('district.regency')->orderby('name','asc')->limit(5)->get();
      }else{
         $kelurahan = Village::with('district.regency')->orderby('name','asc')->where('name', 'like', '%' .$search . '%')->get();
      }

      $response = array();
      foreach($kelurahan as $item){
         $response[] = array(
              "id"=>$item->id,
              "text"=>$item->name.', '.$item->district->name.', '.$item->district->regency->name,
         );
      }

      echo json_encode($response);
      exit;
  }

  public function daftar_ketua(Request $request)
  {
   $request->validate([
      'nisn' => 'required|unique:ketuas',
      'name' => 'required|string|max:255',
      'bidang_id' => 'required',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|confirmed|min:8',
  ],
  [
   'nisn.required'=> 'NISN tidak boleh kosong',
   'nisn.unique'=> 'NISN sudah terdaftar',
   'name.required'=> 'Nama tidak boleh kosong',
   'bidang_id.required'=> 'Bidang tidak boleh kosong',
   'password.required'=> 'Password tidak boleh kosong',
   'email.unique'=> 'Email sudah terdaftar',
  ]);

  if (nisn($request->nisn)) {
      return 'nisn sudah ada';
  } else {
      DB::beginTransaction();

      try{

         $sekolah = Sekolah::create([
            'npsn' => $request->npsn,
            'nama_sekolah' => $request->sekolah,
         ]);

         $tim = $sekolah->tim()->create([
            'bidang_id' => $request->bidang_id,
         ]);

         $tim->pembimbing()->create([]);

         $user = User::create([
              'name' => ucwords($request->name),
              'email' => $request->email,
              'password' => Hash::make($request->password),
              'role' => 3,
          ]);
          
          $words = explode(" ", $request->name);
          $acronym = "";
  
          foreach ($words as $w) {
              $acronym .= $w[0];
          }
  
          $number = str_shuffle(rand(1,123456789));
  
          $ketua = $user->ketua()->create([
              'nisn' => $request->nisn,
              'nik' => $request->nik,
              'kode' => $acronym.$number,
              'tim_id' => $tim->id,

              'kip' => $request->kip,
              'agama' => $request->agama,
              'tempat_lahir' => $request->tempat_lahir,
              'tanggal_lahir' => $request->tanggal_lahir,
              'kelas' => $request->kelas,
          ]);

          $ketua->ayahibu_ketua()->create([
             'nama_ibu' => $request->nama_ibu,
             'pekerjaan_ibu' => $request->pekerjaan_ibu,
             'pendidikan_terakhir_ibu' => $request->pendidikan_terakhir_ibu,
             'nama_ayah' => $request->nama_ayah,
             'pekerjaan_ayah' => $request->pekerjaan_ayah,
             'pendidikan_terakhir_ayah' => $request->pendidikan_terakhir_ayah,

          ]);

          DB::commit();

          return redirect()->route('login')
                      ->with('berhasil','Something Went Wrong!');

      } catch(\Exception $e) {
          DB::rollback();
          return 'gagal';
      }
  }
  }

  public function daftar_anggota(Request $request)
  {
   $request->validate([
      'nisn' => 'required|unique:anggotas',
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|confirmed|min:8',
  ],
  [
   'nisn.required'=> 'NISN tidak boleh kosong',
   'nisn.unique'=> 'NISN sudah terdaftar',
   'name.required'=> 'Nama tidak boleh kosong',
   'password.required'=> 'Password tidak boleh kosong',
   'email.unique'=> 'Email sudah terdaftar',
  ]);

  $ketua = Ketua::with('tim')->where('kode',$request->kode)->first();
  

  if (!$ketua == null) {
      $bidang = Bidang::find($ketua->tim->bidang->bidang_id);
     if (kuota($ketua->tim_id) >= $bidang->kuota_peserta_tim) {
        return redirect()->route('anggota_daftar')->with('kuota','Penuh');
      } else {
         if (nisn_anggota($request->nisn)) {
            return redirect()->route('anggota_daftar')->with('nisn','Something Went Wrong!');
        } else {
            DB::beginTransaction();
      
            try{
               $user = User::create([
                  'name' => ucwords($request->name),
                  'email' => $request->email,
                  'password' => Hash::make($request->password),
                  'role' => 4,
              ]);
      
              $anggota = $user->anggota()->create([
                  'nisn' => $request->nisn,
                  'tim_id' => $ketua->tim->id,
                  'nik' => $request->nik,
                  'kip' => $request->kip,
                  'agama' => $request->agama,
                  'tempat_lahir' => $request->tempat_lahir,
                  'tanggal_lahir' => $request->tanggal_lahir,
                  'kelas' => $request->kelas,
              ]);

              $anggota->ayahibu_anggota()->create([
               'nama_ibu' => $request->nama_ibu,
               'pekerjaan_ibu' => $request->pekerjaan_ibu,
               'pendidikan_terakhir_ibu' => $request->pendidikan_terakhir_ibu,
               'nama_ayah' => $request->nama_ayah,
               'pekerjaan_ayah' => $request->pekerjaan_ayah,
               'pendidikan_terakhir_ayah' => $request->pendidikan_terakhir_ayah,
              ]);
      
                DB::commit();
      
                return redirect()->route('login')
                            ->with('berhasil','Something Went Wrong!');
      
            } catch(\Exception $e) {
                DB::rollback();
                return redirect()->route('daftar_anggota')
                            ->with('warning','Something Went Wrong!');
            }
        }
   }
     
  } else {
   return redirect()->route('daftar_anggota')
   ->with('notfound','Something Went Wrong!');
  }
  



  }

  public function bidang(Request $request)
    {
      $search = $request->search;
      if($search == '')
      {
         $bidang = SubBidang::with('bidang:id,nama_bidang,singkat')->orderby('kode','asc')->limit(15)->get();
      } else {
         $bidang = SubBidang::with('bidang:id,nama_bidang,singkat')->orderby('kode','asc')->where('nama_sub', 'like', '%' .$search . '%')->get();
      }
  
      $response = array();
      foreach($bidang as $item){
         $response[] = array(
            "id"=>$item->id,
            "text"=>$item->bidang->singkat.'-'.$item->nama_sub,
         );
      }
  
      echo json_encode($response);
      exit;
   }

   public function sekolah(Request $request)
    {
      $search = $request->search;
      if($search == '')
      {
         $sekolah = Sekolah::orderby('id','asc')->limit(5)->get();
      } else {
         $sekolah = Sekolah::orderby('id','asc')
         ->where('nama_sekolah', 'like', '%' .$search . '%')
         ->orWhere('npsn', 'like', '%' .$search . '%')
         ->get();
      }
  
      $response = array();
      foreach($sekolah as $item){
         $response[] = array(
            "id"=>$item->id,
            "text"=>$item->id.'-'.$item->npsn.'-'.$item->nama_sekolah,
         );
      }
  
      echo json_encode($response);
      exit;
   }

   public function tim(Request $request)
    {
      $search = $request->search;
      if($search == '')
      {
         $tim = Tim::with('sekolah')->orderby('id','asc')->limit(5)->get();
      } else {
         $tim = Tim::with('sekolah')->orderby('id','asc')
         ->where('nama_tim', 'like', '%' .$search . '%')
         ->orWhereHas('sekolah', function($q) use ($search){
            $q->where('nama_sekolah', 'like', '%' .$search . '%');
         })->get();
      }
  
      $response = array();
      foreach($tim as $item){
         $response[] = array(
            "id"=>$item->id,
            "text"=>$item->id.'-'.$item->nama_tim.'-'.$item->sekolah->nama_sekolah,
         );
      }
  
      echo json_encode($response);
      exit;
   }

   public function user(Request $request)
    {
      $search = $request->search;
      if($search == '')
      {
         $user = User::where('role',3)->orderby('id','asc')->limit(5)->get();
      } else {
         $user = User::where('role',3)->orderby('id','asc')
         ->where('name', 'like', '%' .$search . '%')
         ->orWhere('email', 'like', '%' .$search . '%')
         ->get();
      }
  
      $response = array();
      foreach($user as $item){
         $response[] = array(
            "id"=>$item->id,
            "text"=>$item->name.'-'.$item->email,
         );
      }
  
      echo json_encode($response);
      exit;
   }

   public function info()
   {
      $info = Info::latest()->take(3)->get();
      $hasil = [];
      
      foreach ($info as $data) {
         $hasil[] = ([
            'id' => $data->id,
            'judul' => $data->judul,
            'slug' => $data->slug,
            'color' => $data->color,
            'tanggal' => Carbon::parse($data->created_at)->format('d M Y'),
            'content' => Str::limit(str_replace("&nbsp;", ' ', strip_tags($data->content)), 300, ' [....]'),
         ]);
      }

      return response()->json($hasil);
   }

   public function detail_info(Info $informasi)
   {
      $info = $informasi->load('berkas');

      $file = [];

      foreach ($info->berkas as $data) {
         if ($data->type == 0) {
            $berkas = asset('uploads/'.$data->berkas);
         } else {
            $berkas = $data->url;
         }
         
          $file[] = ([
              'id' => $data->id,
              'judul' => $data->judul,
              'file' => $berkas,
              'info_id' => $data->info_id,
          ]);
      }

      $vars = (object)array(
         'id' => $info->id,
         'judul' => $info->judul,
         'slug' => $info->slug,
         'color' => $info->color,
         'tanggal' => Carbon::parse($info->created_at)->format('d M Y'),
         'content' => $info->content,
         'file' => $file,
     );

      return response()->json($vars);
   }

   public function all_info()
   {
      $info = Info::latest()->get();
      $hasil = [];
      
      foreach ($info as $data) {
         $hasil[] = ([
            'id' => $data->id,
            'judul' => $data->judul,
            'slug' => $data->slug,
            'color' => $data->color,
            'tanggal' => Carbon::parse($data->created_at)->format('d M Y'),
            'content' => Str::limit(str_replace("&nbsp;", ' ', strip_tags($data->content)), 300, ' [....]'),
         ]);
      }

      return response()->json($hasil);
   }
   
   public function linimasa()
   {
      $linimasa = Linimasa::all();
      $hasil = [];
      
      foreach ($linimasa as $data) {
         $hasil[] = ([
            'id' => $data->id,
            'title' => $data->title,
            'tanggal' => tanggal($data->id),
         ]);
      }

      return response()->json($hasil);
   }

}
