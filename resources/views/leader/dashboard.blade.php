@extends('layouts.leader')
@section('content')
@section('header')
@section('title','Dasbor')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Dashboard') }}
</h2>  
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                Selamat Datang {{Auth::user()->name}}
                @if(session('tutup_proposal'))
                <div class="mt-8 mr-4 ml-4 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                    <strong class="mr-1">Maaf, waktu pengunggahan proposal sudah habis atau belum dibuka</strong> 
                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
                    </button>
                </div>
                @endif
                @if(session('tutup_naskah'))
                <div class="mt-8 mr-4 ml-4 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                    <strong class="mr-1">Maaf, waktu pengunggahan naskah sudah habis atau belum dibuka</strong> 
                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
                    </button>
                </div>
                @endif
                @if(session('tutup_poster'))
                <div class="mt-8 mr-4 ml-4 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                    <strong class="mr-1">Maaf, waktu pengunggahan poster sudah habis atau belum dibuka</strong> 
                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
                    </button>
                </div>
                @endif
                <div class="mt-8 mr-4 ml-4 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                    <strong class="mr-1">Perhatian, isi semua data yang diminta, pastikan semua data terisi dengan benar dan lengkap, ketidaklengkapan data bukan tanggung jawab panitia</strong> 
                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
                    </button>
                </div>
                @if (seleksi_proposals(auth()->user()->ketua->tim->id))
                        @if (seleksi_proposal_cek(auth()->user()->ketua->tim->id))
                        @if ((proposal_tim(auth()->user()->ketua->tim->id)) == 1)
                        <div class="mt-8 mr-4 ml-4 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-1">Selamat, tim kamu lolos seleksi proposal, lihat review juri dimenu proposal dan silahkan unggah naskah</strong> 
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-green-900" aria-hidden="true" >×</span>
                            </button>
                        </div>
                        @else
                        <div class="mt-8 mr-4 ml-4 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-1">Maaf, tim kamu belum berhasil lolos seleksi proposal, lihat review juri dimenu proposal</strong> 
                        </div>
                        @endif
                    @endif
                @endif
                @if (seleksi_naskah_dasbor(auth()->user()->ketua->tim->id))
                    @if ((naskah_tim(auth()->user()->ketua->tim->id)) == 1)
                    <div class="mt-8 mr-4 ml-4 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-1">Selamat, tim kamu lolos penilaian naskah, silahkan unggah poster</strong> 
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-green-900" aria-hidden="true" >×</span>
                        </button>
                    </div>
                    @elseif ((naskah_tim(auth()->user()->ketua->tim->id)) == 0)
                    <div class="mt-8 mr-4 ml-4 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-1">Maaf, tim kamu belum berhasil lolos penilaian naskah</strong> 
                    </div>
                    @else
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
<div class="flex items-center justify-center">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
        <!-- 1 card -->
        <a href="{{route('akun.leader')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-pink-500 left-4 -top-6">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Akun</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        <a href="{{route('biodata.leader')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-pink-500 left-4 -top-6">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Biodata</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        @if (biodata_ketua(auth()->user()->id) == 1)
        <a href="{{route('tim.leader')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-pink-500 left-4 -top-6">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Tim</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        @endif
        @if (tim_ketua(auth()->user()->ketua->tim->sekolah->id) == 1)
        <a href="{{route('ortu.leader')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-pink-500 left-4 -top-6">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Orang Tua</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        @endif
        @if (ortu_ketua(auth()->user()->ketua->id) == 1)
        <a href="{{route('pembimbing.leader')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-pink-500 left-4 -top-6">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Pembimbing</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        @endif
        @if (pembimbing(auth()->user()->ketua->tim->pembimbing->id) != 0)
            <a href="{{route('berkas.index')}}">
                <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                    <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-pink-500 left-4 -top-6">
                        <!-- svg  -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="mt-8">
                        <p class="text-xl font-semibold my-2">Berkas</p>
                        <div class="border-t-2"></div>
                    </div>
                </div>
            </a>
        @endif
        @if (filee(auth()->user()->ketua->tim->id) == 2)
            <a href="{{route('proposal.index')}}">
                <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                    <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-pink-500 left-4 -top-6">
                        <!-- svg  -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="mt-8">
                        <p class="text-xl font-semibold my-2">Proposal</p>
                        <div class="border-t-2"></div>
                    </div>
                </div>
            </a>
        @endif
        @if (seleksi_proposal_cek(auth()->user()->ketua->tim->id))
            @if (proposal_tim(auth()->user()->ketua->tim->id) == 1)
                <a href="{{route('naskah.index')}}">
                    <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                        <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-pink-500 left-4 -top-6">
                            <!-- svg  -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="mt-8">
                            <p class="text-xl font-semibold my-2">Naskah</p>
                            <div class="border-t-2"></div>
                        </div>
                    </div>
                </a>
            @endif
        @endif
        @if (seleksi_naskah_cek(auth()->user()->ketua->tim->id))
            @if (naskah_tim(auth()->user()->ketua->tim->id) == 1)
                <a href="{{route('poster.index')}}">
                    <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                        <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-pink-500 left-4 -top-6">
                            <!-- svg  -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="mt-8">
                            <p class="text-xl font-semibold my-2">Poster</p>
                            <div class="border-t-2"></div>
                        </div>
                    </div>
                </a>
                <a href="{{route('presentasi.index')}}">
                    <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                        <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-pink-500 left-4 -top-6">
                            <!-- svg  -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="mt-8">
                            <p class="text-xl font-semibold my-2">Presentasi</p>
                            <div class="border-t-2"></div>
                        </div>
                    </div>
                </a>
            @endif
        @endif
        <a href="{{route('sekolah.leader')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-pink-500 left-4 -top-6">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Sekolah</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        

        <a href="{{route('anggota.leader')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-pink-500 left-4 -top-6">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Anggota</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        <a href="{{route('kejuaraan.index')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-pink-500 left-4 -top-6">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Prestasi</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        <a href="{{route('twibbonice.index')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-pink-500 left-4 -top-6">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Twibbonice</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection