@extends('layouts.leader')
@section('description','Naskah')
@section('title','Naskah')
@section('content')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Naskah') }}
</h2>  
@endsection  
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div class="p-6 bg-white border-b border-gray-200">
                @if (cek_naskah(auth()->user()->ketua->tim->id))
                
                @if (seleksi_naskah($naskah->id))
                    @if ($naskah->status == 1)
                    <div class="mt-8 mr-4 ml-4 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-1">Selamat, tim kamu lolos penilaian naskah, silahkan unggah poster</strong> 
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-green-900" aria-hidden="true" >×</span>
                        </button>
                    </div>
                    @elseif ($naskah->status == 0)
                    <div class="mt-8 mr-4 ml-4 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-1">Maaf, tim kamu belum berhasil lolos penilaian naskah</strong> 
                    </div>
                    @else
                    @endif
                @endif
                
                @endif

                @if (!naskah(auth()->user()->ketua->tim->id))
                <form action="{{ route('naskah.store') }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Abstrak
                                </label>
                        
                                <div class="relative">
                                    <textarea required data-parsley-trigger="keyup" name="abstrak" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6"></textarea>
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
                                        required
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
                                        required
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center pt-2">
                        <input type="submit"  value="Simpan" class="focus:outline-none px-4 bg-yellow-500 p-3 ml-3 rounded-lg text-white hover:bg-yellow-400">
                    </div>
    
                </form>
                @else
                <h3>Kamu hanya diperbolehkan unggah ulang 1 kali</h3>
                @if (count_naskah(auth()->user()->ketua->tim->id) == 0)
                    @if (seleksi_naskah($naskah->id))
                        @if (($naskah->status == 1) || ($naskah->status == 0))
                        @else
                        <div class="m-5"><a type="button" href="{{route('naskah.edit', $naskah->id)}}"
                            class="focus:outline-none px-4 bg-yellow-500 p-3 ml-3 rounded-lg text-white hover:bg-yellow-400">Unggah Ulang</a></div>
                        @endif
                    @endif
                @else
                    <h3>Kamu sudah melakukan perubahan terakhir pada {{$naskah->updated_at}}</h3>
                    
                @endif
                <div><p>{{$naskah->abstrak}}</p></div>
                <div><embed style="width: 100%; height: 500px" class="embed-responsive-item" src="{{asset('uploads/'.$naskah->naskah)}}"></div>
                <div><embed style="width: 100%; height: 500px" class="embed-responsive-item" src="{{asset('uploads/'.$naskah->logbook)}}"></div>
                @endif
                
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
