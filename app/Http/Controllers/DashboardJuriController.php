<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Naskah;
use App\Models\SeleksiNaskah;
use App\Models\NilaiNaskah;
use App\Models\Presentasi;
use App\Models\JuriNilaiPoster;
use App\Models\Tim;
use App\Models\JuriNilaiPresentasi;
use App\Models\NilaiPoster;
use App\Models\NilaiPresentasi;
use App\Models\SeleksiProposal;
use App\Models\Poster;
use DB;

class DashboardJuriController extends Controller
{
    public function dashboard()
    {
        return view('juri.dashboard');
    }

    public function proposal()
    {   
        if(request()->ajax())
        {
            $proposal = Proposal::with('tim.bidang.bidang','tim.provinsi','tim.sekolah')->where('lolos',1)->doesnthave('seleksi_proposal')->whereHas('tim', function($q){
                $q->whereHas('bidang', function($q){
                    $q->whereHas('bidang', function($q){
                        $q->whereHas('juri', function($q){
                            $q->where('juri_id', auth()->user()->juri->id);
                         });
                     });
                 });
            });

            return datatables()->of($proposal->select('proposals.*'))
            ->editColumn('edit', function ($data) {
                $aksi = '<a href="'.route("proposal.re", $data->id).'" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Review</a>';
                return $aksi;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('juri.proposal.index');
    }

    public function nilai_proposal($id)
    {
        $proposal = Proposal::with('tim')->find($id);
        return view('juri.proposal.review', compact('proposal'));
    }

    public function simpan_review(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required',
            'status' => 'required',
        ]);

        $proposal = Proposal::find($id);
        $proposal->seleksi_proposal()->create([
            'juri_id' => auth()->user()->juri->id,
            'komentar' => $request->komentar,
            'status' => $request->status,
        ]);

        return redirect()->route('proposal.juri');
    }

    public function review_proposal()
    {   
        if(request()->ajax())
        {
            $proposal = SeleksiProposal::where('juri_id', auth()->user()->juri->id)->with('proposal.tim.bidang.bidang','proposal.tim.provinsi','proposal.tim.sekolah')->whereHas('proposal', function($q){
                $q->whereHas('tim', function($q){
                    $q->whereHas('bidang', function($q){
                        $q->whereHas('bidang', function($q){
                            $q->whereHas('juri', function($q){
                                $q->where('juri_id', auth()->user()->juri->id);
                             });
                         });
                     });
                 });
            });

            return datatables()->of($proposal->select('seleksi_proposals.*'))
            ->editColumn('edit', function ($data) {
                $aksi = '<a href="'.route("seleksi_proposal.edit", $data->id).'" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Ubah Review</a>';
                return $aksi;
            })
            ->editColumn('lolos', function ($data) {
                if ($data->status == 1) {
                    $st = '<a type="button" class="bg-green-500 text-white p-1 rounded mr-2 font-bold">Lanjut</a>';
                } else if ($data->status == 0) {
                    $st = '<a type="button" class="bg-red-500 text-white p-1 rounded mr-2 font-bold">Tidak Lanjut</a>';
                }

                return $st;
            })
            ->rawColumns(['edit','lolos'])
            ->make(true);
        }

        return view('juri.review_proposal.index');
    }

    public function edit_review($id)
    {
        $proposal = SeleksiProposal::with('proposal.tim')->find($id);
        return view('juri.review_proposal.edit', compact('proposal'));
    }

    public function update_review(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required',
            'status' => 'required',
        ]);

        $proposal = SeleksiProposal::find($id);
        $proposal->update([
            'komentar' => $request->komentar,
            'status' => $request->status,
        ]);

        return redirect()->route('proposal.review');
    }

    public function naskah()
    {   
        if(request()->ajax())
        {
            $naskah = Naskah::with('tim.bidang.bidang','tim.provinsi','tim.sekolah','tim.proposal.seleksi_proposal.juri.user')->whereDoesntHave('seleksi_naskah', function($query) {
                $query->where('juri_id', auth()->user()->juri->id);
              })->whereHas('tim', function($q){
                $q->whereHas('bidang', function($q){
                    $q->whereHas('bidang', function($q){
                        $q->whereHas('juri', function($q){
                            $q->where('juri_id', auth()->user()->juri->id);
                         });
                     });
                 });
            });

            return datatables()->of($naskah->select('naskahs.*'))
            ->editColumn('edit', function ($data) {
                $aksi = '<a href="'.route("nilai.naskah", $data->id).'" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Nilai</a>';
                return $aksi;
            })
            ->editColumn('review', function ($data) {
                $modal = '<div x-data="{ show: false }">
              <div class="flex justify-center">
                  <button @click={show=true} type="button" class="leading-tight bg-green-600 text-gray-200 rounded px-6 py-3 text-sm focus:outline-none focus:border-white">Cek Review</Button>
              </div>
              <div x-show="show" tabindex="0" class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed">
                  <div  @click.away="show = false" class="z-50 relative p-3 mx-auto my-0 max-w-full" style="width: 600px;">
                      <div class="bg-white rounded shadow-lg border flex flex-col overflow-hidden">
                          <button @click={show=false} class="fill-current h-6 w-6 absolute right-0 top-0 m-6 font-3xl font-bold">&times;</button>
                          <div class="px-6 py-3 text-xl border-b font-bold">Review '.$data->tim->proposal->seleksi_proposal->juri->user->name.'</div>


                          <div class="wrapper px-2 w-full">
                          

         <form>
         <div class="my-5">
         <div class="flex flex-col w-full max-w-sm mx-auto bg-white">
             <div class="flex flex-col mb-4">
                 <label for="name"
                     class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                     Review
                 </label>
         
                 <div class="relative">

                 <textarea disabled rows="20" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">'.$data->tim->proposal->seleksi_proposal->komentar.'</textarea>
                 </div>
             </div>
             <input
                  name="id"
                     type="hidden"
                     value="'. $data->tim->proposal->seleksi_proposal->id .'"
                     placeholder="Email"
                     class="w-full py-2 px-1 placeholder-indigo-400 outline-none placeholder-opacity-50"
                     autocomplete="off"
                  />
             
             
         </div>
     </div>';
                return $modal;
            })
            ->rawColumns(['edit','review'])
            ->make(true);
        }

        return view('juri.naskah.index');
    }

    public function nilai_naskah($id)
    {
        $naskah = Naskah::with('tim.bidang.bidang.aspek')->find($id);
        return view('juri.naskah.nilai', compact('naskah'));
    }

    public function simpan_nilai(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required',
        ]);

        $naskah = Naskah::with('tim.bidang.bidang.aspek')->find($id);

        DB::beginTransaction();
      
            try{
                $naskah->update([
                    'status' => 2,
                ]);

               $seleksi = $naskah->seleksi_naskah()->create([
                   'juri_id' => auth()->user()->juri->id,
                   'komentar' => $request->komentar,
                   'status' => 0,
                ]);

                $index = 0;
                $total_nilai = array();

                foreach ($naskah->tim->bidang->bidang->aspek as $item) {
                    $seleksi->nilai_naskah()->create([
                        'aspek_id' => $request->id[$index],
                        'nilai' => $request->nilai[$index],
                        'nilai_akhir' => ($request->nilai[$index]*$item->persentase)/100,
                    ]);

                    $total_nilai[] = ($request->nilai[$index]*$item->persentase)/100;
                    $index+=1;
                }

                $seleksi->update([
                    'total_nilai' => array_sum($total_nilai),
                ]);
      
                DB::commit();
      
                return redirect()->route('naskah.juri')
                            ->with('berhasil','Something Went Wrong!');
      
            } catch(\Exception $e) {
                DB::rollback();
                return 'gagal';
            }
    }

    public function review_naskah()
    {   
        if(request()->ajax())
        {
            $naskah = SeleksiNaskah::select('seleksi_naskahs.*')->with('juri.user')->withCount([
                'nilai_naskah AS total_nilai' => function ($query) {
                            $query->select(DB::raw("SUM(nilai_akhir) as paidsum"));
                        }
                    ])->where('juri_id', auth()->user()->juri->id)->with('naskah.tim.bidang.bidang','naskah.tim.provinsi','naskah.tim.sekolah')->whereHas('naskah', function($q){
                $q->whereHas('tim', function($q){
                    $q->whereHas('bidang', function($q){
                        $q->whereHas('bidang', function($q){
                            $q->whereHas('juri', function($q){
                                $q->where('juri_id', auth()->user()->juri->id);
                             });
                         });
                     });
                 });
            });

            return datatables()->of($naskah)
            ->editColumn('lolos', function ($data) {
                if ($data->naskah->status == 1) {
                    $st = '<a type="button" class="bg-green-500 text-white p-1 rounded mr-2 font-bold">Lolos</a>';
                } else if ($data->naskah->status == 0) {
                    $st = '<a type="button" class="bg-red-500 text-white p-1 rounded mr-2 font-bold">Tidak Lolos</a>';
                } else if ($data->naskah->status == 2) {
                    $st = '<a type="button" class="bg-yellow-500 text-white p-1 rounded mr-2 font-bold">Belum Ditentukan</a>';
                }

                return $st;
            })
            ->editColumn('edit', function ($data) {
                $aksi = '<a href="'.route("edit.nilai.naskah", $data->id).'" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Edit</a>';
                return $aksi;
            })
            ->editColumn('review', function ($data) {
                $modal = '<div x-data="{ show: false }">
              <div class="flex justify-center">
                  <button @click={show=true} type="button" class="leading-tight bg-green-600 text-gray-200 rounded px-6 py-3 text-sm focus:outline-none focus:border-white">Cek Review</Button>
              </div>
              <div x-show="show" tabindex="0" class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed">
                  <div  @click.away="show = false" class="z-50 relative p-3 mx-auto my-0 max-w-full" style="width: 600px;">
                      <div class="bg-white rounded shadow-lg border flex flex-col overflow-hidden">
                          <button @click={show=false} class="fill-current h-6 w-6 absolute right-0 top-0 m-6 font-3xl font-bold">&times;</button>
                          <div class="px-6 py-3 text-xl border-b font-bold">Review '.$data->juri->user->name.'</div>


                          <div class="wrapper px-2 w-full">
                          

         <form class="px-3 py-5 my-10 m-auto">
         <div class="my-5">
         <div class="flex flex-col w-full max-w-sm mx-auto p-4 bg-white">
             <div class="flex flex-col mb-4">
                 <label for="name"
                     class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                     Review
                 </label>
         
                 <div class="relative">

                 <textarea disabled class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">'.$data->komentar.'</textarea>
                 </div>
             </div>
             <input
                  name="id"
                     type="hidden"
                     value="'. $data->id .'"
                     placeholder="Email"
                     class="w-full py-2 px-1 placeholder-indigo-400 outline-none placeholder-opacity-50"
                     autocomplete="off"
                  />
             
             
         </div>
     </div>';
                return $modal;
            })
            ->rawColumns(['lolos','edit','review'])
            
            // ->rawColumns(['edit'])
            ->make(true);
        }

        return view('juri.review_naskah.index');
    }

    public function edit_review_naskah($id)
    {
        $naskah = SeleksiNaskah::with('nilai_naskah.aspek','naskah')->find($id);
        return view('juri.review_naskah.edit', compact('naskah'));
        //return $naskah;
    }

    public function simpan_nilai_naskah(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required',
        ]);

        $naskah = SeleksiNaskah::with('naskah.tim.bidang.bidang.aspek')->find($id);

        DB::beginTransaction();
      
            try{

               $naskah->update([
                   'komentar' => $request->komentar,
                ]);

                $index = 0;
                $total_nilai = array();

                foreach ($naskah->naskah->tim->bidang->bidang->aspek as $item) {
                    $nilai = NilaiNaskah::find($request->id_nilai[$index]);
                    $nilai->update([
                        'nilai' => $request->nilai[$index],
                        'nilai_akhir' => ($request->nilai[$index]*$item->persentase)/100,
                    ]);

                    $total_nilai[] = ($request->nilai[$index]*$item->persentase)/100;
                    $index+=1;
                }

                $naskah->update([
                    'total_nilai' => array_sum($total_nilai),
                ]);
      
                DB::commit();
      
                return redirect()->route('naskah.review')
                            ->with('berhasil','Something Went Wrong!');
      
            } catch(\Exception $e) {
                DB::rollback();
                return 'gagal';
            }
    }

    public function poster()
    {   
        if(request()->ajax())
        {
            $poster = Poster::with('tim.bidang.bidang','tim.provinsi','tim.sekolah')->whereDoesntHave('juri_nilai_poster', function($query) {
                $query->where('juri_id', auth()->user()->juri->id);
              })->whereHas('tim', function($q){
                $q->whereHas('bidang', function($q){
                    $q->whereHas('bidang', function($q){
                        $q->whereHas('juri', function($q){
                            $q->where('juri_id', auth()->user()->juri->id);
                         });
                     });
                 });
            });

            return datatables()->of($poster->select('posters.*'))
            ->editColumn('edit', function ($data) {
                $aksi = '<a href="'.route("nilai.poster", $data->id).'" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Nilai</a>';
                return $aksi;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('juri.poster.index');
    }

    public function nilai_poster($id)
    {
        $poster = Poster::with('tim.bidang.bidang.aspek_poster')->find($id);
        return view('juri.poster.nilai', compact('poster'));
    }

    public function simpan_nilai_poster(Request $request, $id)
    {

        $poster = Poster::with('tim.bidang.bidang.aspek_poster')->find($id);

        DB::beginTransaction();
      
            try{

               $seleksi = $poster->juri_nilai_poster()->create([
                   'juri_id' => auth()->user()->juri->id,
                   'komentar' => $request->komentar,
                   'status' => 0,
                ]);

                $index = 0;
                $total_nilai = array();

                foreach ($poster->tim->bidang->bidang->aspek_poster as $item) {
                    $seleksi->nilai_poster()->create([
                        'aspek_id' => $request->id[$index],
                        'nilai' => $request->nilai[$index],
                        'nilai_akhir' => ($request->nilai[$index]*$item->persentase)/100,
                    ]);

                    $total_nilai[] = ($request->nilai[$index]*$item->persentase)/100;
                    $index+=1;
                }

                $seleksi->update([
                    'total_nilai' => array_sum($total_nilai),
                ]);
      
                DB::commit();
      
                return redirect()->route('poster.juri')
                            ->with('berhasil','Something Went Wrong!');
      
            } catch(\Exception $e) {
                DB::rollback();
                return 'gagal';
            }
    }

    public function review_poster()
    {   
        if(request()->ajax())
        {
            $poster = JuriNilaiPoster::select('juri_nilai_posters.*')->withCount([
                'nilai_poster AS total_nilai' => function ($query) {
                            $query->select(DB::raw("SUM(nilai_akhir) as paidsum"));
                        }
                    ])->where('juri_id', auth()->user()->juri->id)->with('poster.tim.bidang.bidang','poster.tim.provinsi','poster.tim.sekolah')->whereHas('poster', function($q){
                $q->whereHas('tim', function($q){
                    $q->whereHas('bidang', function($q){
                        $q->whereHas('bidang', function($q){
                            $q->whereHas('juri', function($q){
                                $q->where('juri_id', auth()->user()->juri->id);
                             });
                         });
                     });
                 });
            });

            return datatables()->of($poster)
            ->editColumn('edit', function ($data) {
                $aksi = '<a href="'.route("edit.nilai.poster", $data->id).'" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Edit</a>';
                return $aksi;
            })
            ->rawColumns(['edit'])
            
            // ->rawColumns(['edit'])
            ->make(true);
        }

        return view('juri.review_poster.index');
    }

    public function edit_review_poster($id)
    {
        $poster = JuriNilaiPoster::with('nilai_poster.aspek','poster')->find($id);
        return view('juri.review_poster.edit', compact('poster'));
        //return $naskah;
    }

    public function update_nilai_poster(Request $request, $id)
    {

        $poster = JuriNilaiPoster::with('poster.tim.bidang.bidang.aspek_poster')->find($id);

        DB::beginTransaction();
      
            try{

               $poster->update([
                   'komentar' => $request->komentar,
                ]);

                $index = 0;
                $total_nilai = array();

                foreach ($poster->poster->tim->bidang->bidang->aspek_poster as $item) {
                    $nilai = NilaiPoster::find($request->id_nilai[$index]);
                    $nilai->update([
                        'nilai' => $request->nilai[$index],
                        'nilai_akhir' => ($request->nilai[$index]*$item->persentase)/100,
                    ]);

                    $total_nilai[] = ($request->nilai[$index]*$item->persentase)/100;
                    $index+=1;
                }

                $poster->update([
                    'total_nilai' => array_sum($total_nilai),
                ]);
      
                DB::commit();
      
                return redirect()->route('poster.review')
                            ->with('berhasil','Something Went Wrong!');
      
            } catch(\Exception $e) {
                DB::rollback();
                return 'gagal';
            }
    }

    public function presentasi()
    {   
        if(request()->ajax())
        {
            $presentasi = Presentasi::with('tim.bidang.bidang','tim.provinsi','tim.sekolah')->whereDoesntHave('juri_nilai_presentasi', function($query) {
                $query->where('juri_id', auth()->user()->juri->id);
              })->whereHas('tim', function($q){
                $q->whereHas('bidang', function($q){
                    $q->whereHas('bidang', function($q){
                        $q->whereHas('juri', function($q){
                            $q->where('juri_id', auth()->user()->juri->id);
                         });
                     });
                 });
            });

            return datatables()->of($presentasi->select('presentasis.*'))
            ->editColumn('edit', function ($data) {
                $aksi = '<a href="'.route("nilai.presentasi", $data->id).'" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Nilai</a>';
                return $aksi;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('juri.presentasi.index');
    }

    public function nilai_presentasi($id)
    {
        $presentasi = Presentasi::with('tim.bidang.bidang.aspek_presentasi')->find($id);
        return view('juri.presentasi.nilai', compact('presentasi'));
    }

    public function simpan_nilai_presentasi(Request $request, $id)
    {

        $presentasi = Presentasi::with('tim.bidang.bidang.aspek_presentasi')->find($id);

        DB::beginTransaction();
      
            try{

               $seleksi = $presentasi->juri_nilai_presentasi()->create([
                   'juri_id' => auth()->user()->juri->id,
                   'status' => 0,
                ]);

                $index = 0;
                $total_nilai = array();

                foreach ($presentasi->tim->bidang->bidang->aspek_presentasi as $item) {
                    $seleksi->nilai_presentasi()->create([
                        'aspek_id' => $request->id[$index],
                        'nilai' => $request->nilai[$index],
                        'nilai_akhir' => ($request->nilai[$index]*$item->persentase)/100,
                    ]);

                    $total_nilai[] = ($request->nilai[$index]*$item->persentase)/100;
                    $index+=1;
                }

                $seleksi->update([
                    'total_nilai' => array_sum($total_nilai),
                ]);
      
                DB::commit();
      
                return redirect()->route('presentasi.juri')
                            ->with('berhasil','Something Went Wrong!');
      
            } catch(\Exception $e) {
                DB::rollback();
                return 'gagal';
            }
    }

    public function review_presentasi()
    {   
        if(request()->ajax())
        {
            $presentasi = JuriNilaiPresentasi::select('juri_nilai_presentasis.*')->withCount([
                'nilai_presentasi AS total_nilai' => function ($query) {
                            $query->select(DB::raw("SUM(nilai_akhir) as paidsum"));
                        }
                    ])->where('juri_id', auth()->user()->juri->id)->with('presentasi.tim.bidang.bidang','presentasi.tim.provinsi','presentasi.tim.sekolah')->whereHas('presentasi', function($q){
                $q->whereHas('tim', function($q){
                    $q->whereHas('bidang', function($q){
                        $q->whereHas('bidang', function($q){
                            $q->whereHas('juri', function($q){
                                $q->where('juri_id', auth()->user()->juri->id);
                             });
                         });
                     });
                 });
            });

            return datatables()->of($presentasi)
            ->editColumn('edit', function ($data) {
                $aksi = '<a href="'.route("edit.nilai.presentasi", $data->id).'" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Edit</a>';
                return $aksi;
            })
            ->rawColumns(['edit'])
            
            // ->rawColumns(['edit'])
            ->make(true);
        }

        return view('juri.review_presentasi.index');
    }

    public function edit_review_presentasi($id)
    {
        $presentasi = JuriNilaiPresentasi::with('nilai_presentasi.aspek_presentasi','presentasi')->find($id);
        return view('juri.review_presentasi.edit', compact('presentasi'));
        //return $naskah;
    }

    public function update_nilai_presentasi(Request $request, $id)
    {

        $presentasi = JuriNilaiPresentasi::with('presentasi.tim.bidang.bidang.aspek_presentasi')->find($id);

        DB::beginTransaction();
      
            try{

                $index = 0;
                $total_nilai = array();

                foreach ($presentasi->presentasi->tim->bidang->bidang->aspek_presentasi as $item) {
                    $nilai = NilaiPresentasi::find($request->id_nilai[$index]);
                    $nilai->update([
                        'nilai' => $request->nilai[$index],
                        'nilai_akhir' => ($request->nilai[$index]*$item->persentase)/100,
                    ]);

                    $total_nilai[] = ($request->nilai[$index]*$item->persentase)/100;
                    $index+=1;
                }

                $presentasi->update([
                    'total_nilai' => array_sum($total_nilai),
                ]);
      
                DB::commit();
      
                return redirect()->route('presentasi.review')
                            ->with('berhasil','Something Went Wrong!');
      
            } catch(\Exception $e) {
                DB::rollback();
                return 'gagal';
            }
    }

    public function ranking_naskah()
    {
    
        if(request()->ajax())
        {
            $seleksi = SeleksiNaskah::groupBy('naskah_id')->select('naskah_id', \DB::raw('AVG(total_nilai) AS nilai'))
            ->with('naskah.tim.bidang.bidang','naskah.tim.provinsi','naskah.tim.sekolah')
            ->orderBy('nilai','desc')
            ->whereHas('naskah', function($q){
                $q->whereHas('tim', function($q){
                    $q->whereHas('bidang', function($q){
                        $q->whereHas('bidang', function($q){
                            $q->whereHas('juri', function($q){
                                $q->where('juri_id', auth()->user()->juri->id);
                            });
                        });
                    });
                });
            });

            return datatables()->of($seleksi)
            ->addIndexColumn()
            ->make(true);
        }

        return view('juri.ranking_naskah.index');
    }

    public function ranking_naskahs()
    {

        // $tim = Tim::with(['naskah.seleksi_naskah' => function ($query) {
        //     $query->groupBy('naskah_id')->select('naskah_id', \DB::raw('(AVG(total_nilai)*50)/100 AS nilai_naskah'));
        // },'poster.juri_nilai_poster' => function ($query) {
        //     $query->groupBy('poster_id')->select('poster_id', \DB::raw('(AVG(total_nilai)*10)/100 AS nilai_poster'));
        // },'presentasi.juri_nilai_presentasi' => function ($query) {
        //     $query->groupBy('presentasi_id')->select('presentasi_id', \DB::raw('(AVG(total_nilai)*40)/100 AS nilai_presentasi'));
        // }])->whereHas('bidang', function($q){
        //     $q->whereHas('bidang', function($q){
        //         $q->whereHas('juri', function($q){
        //             $q->where('juri_id', auth()->user()->juri->id);
        //         });
        //     });
        //  })->get();

        $tim = DB::table('tims')
        ->join('naskahs', 'tims.id', '=', 'naskahs.tim_id')
        ->join('seleksi_naskahs', 'naskahs.id', '=', 'seleksi_naskahs.naskah_id')
        ->groupBy('seleksi_naskahs.naskah_id')->select(avg(('seleksi_naskahs.total_nilai')))
        ->get();

        return $tim;
    }
}
