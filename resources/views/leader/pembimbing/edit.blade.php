@extends('layouts.leader')
@section('content')
@section('title','Pembimbing')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Pembimbing') }}
</h2>  
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                <form id="validate_form" action="{{route('pembimbing.leader.save')}}" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Nama
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="nama"
                                        required data-parsley-trigger="keyup"
                                        name="nama"
                                        type="text"
                                        value="{{$pembimbing->nama}}"
                                        placeholder="Nama"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    E-Mail
                                </label>
                        
                                <div class="relative">
                        
                                    <input id="email"
                                        name="email"
                                        type="email"
                                        required data-parsley-type="email" data-parsley-trigger="keyup"
                                        value="{{$pembimbing->email}}"
                                        placeholder="Email"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="jenis_kelamin"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Jenis Kelamin
                                </label>
                        
                                <div class="relative">
                                    <select name="jenis_kelamin" required class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                        <option @if ($pembimbing->jenis_kelamin == 'L') selected @endif value="L">Laki - Laki</option>
                                        <option @if ($pembimbing->jenis_kelamin == 'P') selected @endif value="P">Perempuan</option>
                                    </select>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Tempat Lahir
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="tempat_lahir"
                                        required data-parsley-trigger="keyup"
                                        name="tempat_lahir"
                                        type="text"
                                        value="{{$pembimbing->tempat_lahir}}"
                                        placeholder="Tempat Lahir"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Tanggal Lahir
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="tanggal_lahir"
                                        required data-parsley-trigger="keyup"
                                        name="tanggal_lahir"
                                        type="date"
                                        value="{{$pembimbing->tanggal_lahir}}"
                                        placeholder="Tanggal Lahir"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Mengampu Mata Pelajaran
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="mapel"
                                        required data-parsley-trigger="keyup"
                                        name="mapel"
                                        type="text"
                                        value="{{$pembimbing->mapel}}"
                                        placeholder="Mata Pelajaran"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    NIK
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="nik"
                                        name="nik"
                                        required data-parsley-minlength="16" data-parsley-type="integer" data-parsley-trigger="keyup"
                                        type="number"
                                        value="{{$pembimbing->nik}}"
                                        placeholder="NIK"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Nomor HP (Whatsapp)
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="no_telp"
                                        required data-parsley-trigger="keyup"
                                        name="no_telp"
                                        type="text"
                                        value="{{$pembimbing->no_telp}}"
                                        placeholder="WA"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    NUPTK
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="nuptk"
                                        name="nuptk"
                                        type="number"
                                        value="{{$pembimbing->nuptk}}"
                                        placeholder="NUPTK"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    NIP
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="nip"
                                        name="nip"
                                        type="number"
                                        value="{{$pembimbing->nip}}"
                                        placeholder="NIP"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>

                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Alamat Jalan
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="jalan"
                                        required data-parsley-trigger="keyup"
                                        name="jalan"
                                        type="text"
                                        value="{{$pembimbing->jalan}}"
                                        placeholder="Jalan"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Nomor Rumah
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="no_rmh"
                                        required data-parsley-trigger="keyup"
                                        name="no_rmh"
                                        type="text"
                                        value="{{$pembimbing->no_rmh}}"
                                        placeholder="Nomor Rumah"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    RT RW
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="rt_rw"
                                        required data-parsley-trigger="keyup"
                                        name="rt_rw"
                                        type="text"
                                        value="{{$pembimbing->rt_rw}}"
                                        placeholder="000/000"
                                        class="rt_rw text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Kode Pos
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="kodepos"
                                        required data-parsley-trigger="keyup"
                                        name="kodepos"
                                        type="number"
                                        value="{{$pembimbing->kodepos}}"
                                        placeholder="Kode Pos"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Kelurahan
                                </label>
                        
                                <div class="relative">    
                                    <select name="kelurahan_id" id="kelurahan_id" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                        @if (!empty($pembimbing->kelurahan_id))
                                        <option value="{{$pembimbing->kelurahan_id}}">{{$pembimbing->kelurahan->name}}, {{$pembimbing->kelurahan->district->name}}, {{$pembimbing->kelurahan->district->regency->name}}, {{$pembimbing->kelurahan->district->regency->province->name}}</option>
                                        <option></option>
                                        @else
                                            <option></option>
                                        @endif
                                    </select>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Surat Tugas dari Kepala Sekolah (PDF dan maksimal 2MB)
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="surat_kepsek"
                                        name="surat_kepsek"
                                        type="file"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="flex justify-center pt-2">
                        @if (empty($pembimbing->surat_kepsek))
                                <a type="button" class="focus:outline-none px-4 bg-red-500 p-3 ml-3 rounded-lg text-white hover:bg-red-400">Belum Ada Surat Yang Diunggah</a>
                            @else
                                <a type="button" href="{{asset('uploads/'.$pembimbing->surat_kepsek)}}" class="focus:outline-none px-4 bg-green-500 p-3 ml-3 rounded-lg text-white hover:bg-green-400">Buka Surat Yang Sudah Diunggah</a>
                            @endif
                    </div>
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
<script type="text/javascript">
    $(document).ready(function(){
      $('.rt_rw').mask('000/000');
     });
</script>
<script type="text/javascript">

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

      $( "#kelurahan_id" ).select2({
        ajax: { 
          url: "{{route('kelurahanss')}}",
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              _token: CSRF_TOKEN,
              search: params.term // search term
            };
          },
          processResults: function (response) {
            return {
              results: response
            };
          },
          cache: true
        }

      });

    });
</script>

@endsection