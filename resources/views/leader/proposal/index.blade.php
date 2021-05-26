@extends('layouts.leader')
@section('description','Proposal')
@section('title','Proposal')
@section('content')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Proposal') }}
</h2>  
@endsection  
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div class="p-6 bg-white border-b border-gray-200">
                @if (seleksi_proposals(auth()->user()->ketua->tim->id))
                        @if (seleksi_proposal($proposal->id))
                        @if ($proposal->seleksi_proposal->status == 1)
                        <div class="mt-8 mr-4 ml-4 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-1">Selamat, tim kamu lolos seleksi proposal, lihat review juri dibawah dan silahkan unggah naskah</strong> 
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-green-900" aria-hidden="true" >×</span>
                            </button>
                        </div>
                        @else
                        <div class="mt-8 mr-4 ml-4 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-1">Maaf, tim kamu belum berhasil lolos seleksi proposal, lihat review juri dibawah</strong> 
                        </div>
                        @endif
                    @endif
                @endif
                

                @if (!proposal(auth()->user()->ketua->tim->id))
                <form action="{{ route('proposal.store') }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Proposal
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="proposal"
                                        name="proposal"
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

                @if (count_proposal(auth()->user()->ketua->tim->id) == 0)
                    @if (seleksi_proposals(auth()->user()->ketua->tim->id))
                    @if (seleksi_proposal($proposal->id))
                            @else
                            <div class="m-5">
                                <a type="button" href="{{route('proposal.edit', $proposal->id)}}"
                                class="focus:outline-none px-4 bg-yellow-500 p-3 ml-3 rounded-lg text-white hover:bg-yellow-400">Unggah Ulang</a>
                            </div>    
                        @endif
                    @endif
                @else
                    <h3>Kamu sudah melakukan perubahan terakhir pada {{$proposal->updated_at}}</h3>
                    
                @endif
                    <h1>Kode Registrasi Project : {{$proposal->kode_registrasi}}</h1>
                    <div class="m-5"><a type="button" href="{{route('proposal.unduh.bukti', $proposal->id)}}"
                        class="focus:outline-none px-4 bg-yellow-500 p-3 ml-3 rounded-lg text-white hover:bg-yellow-400">Unduh Bukti Pengunggahan</a></div>
                <div><embed style="width: 100%; height: 500px" class="embed-responsive-item" src="{{asset('uploads/'.$proposal->proposal)}}"></div>
                @endif
                @if (seleksi_proposals(auth()->user()->ketua->tim->id))
                    @if (seleksi_proposal($proposal->id))
                        <h3>Review Juri KOPSI :</h3>
                        <p>{{$proposal->seleksi_proposal->komentar}}</p>
                    @endif
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
