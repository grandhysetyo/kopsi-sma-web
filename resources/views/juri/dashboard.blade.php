@extends('layouts.juri')
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
            </div>
        </div>
    </div>
</div>
<div class="flex items-center justify-center">    
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">  
        <!-- Data Proposal -->
        <div class="col-span-4">
            <h1> Proposal </h1>
        </div> 
        <a href="{{route('proposal.juri')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-blue-600 left-4 -top-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Data Proposal</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        <a href="{{route('proposal.juri')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-blue-600 left-4 -top-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Review Proposal</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>

        <!-- Data Naskah -->
        <div class="col-span-4">
            <h1> Naskah </h1>
        </div> 
        <a href="{{route('proposal.juri')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-green-600 left-4 -top-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Data Naskah</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        <a href="{{route('naskah.juri')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-green-600 left-4 -top-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Review Naskah</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        <a href="{{route('naskah.juri')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-green-600 left-4 -top-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Ranking Naskah</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        <!-- Data Poster -->
        <div class="col-span-4">
            <h1> Poster </h1>
        </div> 
        <a href="{{route('proposal.juri')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-pink-600 left-4 -top-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Data Poster</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        <a href="{{route('naskah.juri')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-pink-600 left-4 -top-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Review Poster</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        <!-- Data Presentasi -->
        <div class="col-span-4">
            <h1> Presentasi </h1>
        </div>
        <a href="{{route('naskah.juri')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-yellow-600 left-4 -top-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z" clip-rule="evenodd" />
                </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Data Presentasi</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
        <a href="{{route('naskah.juri')}}">
            <div class="relative bg-white hover:text-white hover:bg-gray-600 py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
                <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-yellow-600 left-4 -top-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="mt-8">
                    <p class="text-xl font-semibold my-2">Review Presentasi</p>
                    <div class="border-t-2"></div>
                </div>
            </div>
        </a>
@endsection