@extends('layouts.leader')
@section('content')
@section('title','Naskah')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Unggah Ulang Naskah') }}
</h2>  
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            @if(session('sukses'))
                <div class="mt-8 mr-4 ml-4 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                    <strong class="mr-1">Data Berhasil Diperbarui</strong> 
                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-green-900" aria-hidden="true" >×</span>
                    </button>
                </div>
            @endif
            @if(session('selesaikan'))
                <div class="mt-8 mr-4 ml-4 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                    <strong class="mr-1">Pastikan sudah diisi semua</strong> 
                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
                    </button>
                </div>
            @endif
            <div class="mt-8 mr-4 ml-4 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">Perhatian</strong> Kamu hanya bisa memperbarui abstrak, naskah dan logbook 1 kali. Jika terdapat pembaruan pada naskah dan logbook, silahkan unggah ulang kedua berkas
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
                </button>
            </div>
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                <form id="validate_form" action="{{route('naskah.update', $naskah->id)}}" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Abstrak
                                </label>
                        
                                <div class="relative">
                                    <textarea required data-parsley-trigger="keyup" name="abstrak" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">{{$naskah->abstrak}}</textarea>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Naskah
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="naskah"
                                        name="naskah"
                                        type="file"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Logbook
                                </label>
                                <div class="relative">
                        
                                    <input
                                        id="logbook"
                                        name="logbook"
                                        type="file"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="flex justify-center pt-2">
                        <button type="submit"
                            class="focus:outline-none px-4 bg-yellow-500 p-3 ml-3 rounded-lg text-white hover:bg-yellow-400">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
    
     $('#validate_form').parsley();
    
    });
</script>
@endsection