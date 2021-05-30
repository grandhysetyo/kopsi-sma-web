@extends('layouts.leader')
@section('content')
@section('title','Tim')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Tim') }}
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
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                <form id="validate_form" action="{{route('tim.leader.save')}}" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Nama Tim
                                </label>
                        
                                <div class="relative">
                        
                                    <input id="nama_tim"
                                        name="nama_tim"
                                        type="text"
                                        required data-parsley-trigger="keyup"
                                        value="{{$tim->nama_tim}}"
                                        placeholder="Nama Tim"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Provinsi
                                </label>
                        
                                <div class="relative">    
                                    <select name="province_id" required id="province_id" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                        @if (!empty($tim->province_id))
                                        <option value="{{$tim->province_id}}">{{$tim->provinsi->name}}</option>
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
                                    Bidang Lomba
                                </label>
                        
                                <div class="relative">    
                                    <select name="bidang_id" required id="bidang_id" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                        @if (!empty($tim->bidang_id))
                                        <option value="{{$tim->bidang_id}}">{{$tim->bidang->bidang->singkat}} - {{$tim->bidang->nama_sub}}</option>
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
                                    Judul Penelitian
                                </label>
                        
                                <div class="relative">
                        
                                    <input id="nama_karya"
                                        name="nama_karya"
                                        type="text"
                                        required data-parsley-trigger="keyup"
                                        value="{{$tim->nama_karya}}"
                                        placeholder="Nama Karya"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Deskripsi Penelitian
                                </label>
                        
                                <div class="relative">
                                    <textarea name="deskripsi_karya" required data-parsley-trigger="keyup" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">{{$tim->deskripsi_karya}}</textarea>
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <div>
                                    <label class="inline-flex items-center">
                                        <input required type="checkbox" name="simpan" value="1" class="checks form-checkbox text-green-500">
                                        <span class="ml-2">Saya sudah memeriksa kembali sebelum menyimpan</span>
                                    </label>
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
    
    (function($) {
        $(document).ready(function(){
    
        $('#validate_form').parsley();
    
    });
    })(jQuery);
</script>
<script type="text/javascript">

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

      $( "#province_id" ).select2({
        ajax: { 
          url: "{{route('province')}}",
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
<script type="text/javascript">

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

      $( "#bidang_id" ).select2({
        ajax: { 
          url: "{{route('bidang-kategori')}}",
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