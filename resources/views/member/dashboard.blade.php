@extends('layouts.member')
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
                <div class="mt-8 mr-4 ml-4 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                    <strong class="mr-1">Pengunggahan Berkas, Proposal, Naskah, Poster hanya ada di dasbor ketua</strong> 
                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex items-center justify-center">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
        <!-- 1 card -->
        <a href="{{route('akun.member')}}">
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
        <a href="{{route('biodata.member')}}">
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
        @if (biodata_anggota(auth()->user()->id) == 1)
        <a href="{{route('ortu.member')}}">
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
        <a href="{{route('kejuaraan-member.index')}}">
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
        <a href="{{route('twibbonice-member.index')}}">
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