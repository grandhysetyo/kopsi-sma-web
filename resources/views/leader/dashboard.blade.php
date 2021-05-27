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
                            <strong class="mr-1">Selamat, tim anda lolos seleksi proposal, lihat review juri dimenu proposal dan silakan unggah naskah</strong> 
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-green-900" aria-hidden="true" >×</span>
                            </button>
                        </div>
                        @else
                        <div class="mt-8 mr-4 ml-4 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-1">Maaf, tim anda belum berhasil lolos seleksi proposal, lihat review juri dimenu proposal</strong> 
                        </div>
                        @endif
                    @endif
                @endif
                @if (seleksi_naskah_dasbor(auth()->user()->ketua->tim->id))
                    @if ((naskah_tim(auth()->user()->ketua->tim->id)) == 1)
                    <div class="mt-8 mr-4 ml-4 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-1">Selamat, tim anda lolos penilaian naskah, silakan unggah poster</strong> 
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-green-900" aria-hidden="true" >×</span>
                        </button>
                    </div>
                    @elseif ((naskah_tim(auth()->user()->ketua->tim->id)) == 0)
                    <div class="mt-8 mr-4 ml-4 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-1">Maaf, tim anda belum berhasil lolos penilaian naskah</strong> 
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
        <!-- DATA SEKOLAH -->
        <div class="col-span-4">
            <h1> Data Sekolah </h1>
        </div>     
        <a href="{{route('sekolah.leader')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-blue-600 left-4 -top-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.496 2.132a1 1 0 00-.992 0l-7 4A1 1 0 003 8v7a1 1 0 100 2h14a1 1 0 100-2V8a1 1 0 00.496-1.868l-7-4zM6 9a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1zm3 1a1 1 0 012 0v3a1 1 0 11-2 0v-3zm5-1a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Sekolah</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        @if (biodata_ketua(auth()->user()->id) == 1)
        <a href="{{route('tim.leader')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-blue-600 left-4 -top-6">
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
        @if (ortu_ketua(auth()->user()->ketua->id) == 1)
        <a href="{{route('pembimbing.leader')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-blue-600 left-4 -top-6">
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
        <a href="{{route('anggota.leader')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-blue-600 left-4 -top-6">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Anggota</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        <!-- DATA DIRI -->
        <div class="col-span-4">
            <h1> Data Diri </h1>
        </div> 
        <a href="{{route('akun.leader')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-green-500 left-4 -top-6">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
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
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-green-500 left-4 -top-6">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm2.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45 4a2.5 2.5 0 10-4.9 0h4.9zM12 9a1 1 0 100 2h3a1 1 0 100-2h-3zm-1 4a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Biodata</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
       
        @if (tim_ketua(auth()->user()->ketua->tim->sekolah->id) == 1)
        <a href="{{route('ortu.leader')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-green-500 left-4 -top-6">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Orang Tua</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        @endif 
        <a href="{{route('kejuaraan.index')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-green-500 left-4 -top-6">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
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
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-green-500 left-4 -top-6">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Twibbonice</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        <!-- DATA UNGGAHAN -->
        <div class="col-span-4">
            <h1> Data Unggahan Lomba</h1>
        </div> 

        @if (pembimbing(auth()->user()->ketua->tim->pembimbing->id) != 0)
            <a href="{{route('berkas.index')}}">
                <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                    <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-pink-500 left-4 -top-6">
                        <!-- svg  -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
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
        <!-- DATA FINALIS -->
        <div class="col-span-4">
            <h1> Data Finalis </h1>
        </div>
                
        @if (seleksi_naskah_cek(auth()->user()->ketua->tim->id))
            @if (naskah_tim(auth()->user()->ketua->tim->id) == 1)
                <a href="{{route('poster.index')}}">
                    <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                        <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-yellow-400 left-4 -top-6">
                            <!-- svg  -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
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
                        <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-yellow-400 left-4 -top-6">
                            <!-- svg  -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
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
    </div>
</div>
<div class="flex items-center justify-center">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
        
    </div>
</div>
@endsection