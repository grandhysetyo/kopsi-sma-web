@extends('layouts.leader')
@section('content')
@section('title','Sekolah')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Sekolah
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
                <form id="validate_form" action="{{route('sekolah.leader.save')}}" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    NPSN
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="npsn"
                                        required data-parsley-trigger="keyup"
                                        name="npsn"
                                        type="number"
                                        value="{{$sekolah->npsn}}"
                                        placeholder="NPSN"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                        <small id="tunggu">Cari NPSN dari Data Peserta Didik (DAPODIK)</small>
                                </div>
                                <div>
                                    <button type="button" onclick="npsnwoe();"
                                    class="focus:outline-none px-4 bg-yellow-500 p-2 rounded-lg text-white hover:bg-yellow-400">Cari</button>
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Nama Sekolah
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="sekolah"
                                        required data-parsley-trigger="keyup"
                                        name="nama_sekolah"
                                        type="text"
                                        value="{{$sekolah->nama_sekolah}}"
                                        placeholder="Nama Sekolah"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Telp. Sekolah
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="telp_sekolah"
                                        required data-parsley-trigger="keyup"
                                        name="telp_sekolah"
                                        type="text"
                                        value="{{$sekolah->telp_sekolah}}"
                                        placeholder="Telp.Sekolah"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    E-Mail Sekolah
                                </label>
                        
                                <div class="relative">
                        
                                    <input id="email"
                                        name="email"
                                        type="email"
                                        required data-parsley-type="email" data-parsley-trigger="keyup"
                                        value="{{$sekolah->email}}"
                                        placeholder="Email"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="jenis_kelamin"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Jenis Sekolah
                                </label>
                        
                                <div class="relative">
                                    <select name="status" required class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                        <option @if ($sekolah->status == 'N') selected @endif value="N">Negeri</option>
                                        <option @if ($sekolah->status == 'S') selected @endif value="S">Swasta</option>
                                    </select>
                        
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
                                        value="{{$sekolah->jalan}}"
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
                                        value="{{$sekolah->no_rmh}}"
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
                                        value="{{$sekolah->rt_rw}}"
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
                                        value="{{$sekolah->kodepos}}"
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
                                        @if (!empty($sekolah->kelurahan_id))
                                        <option value="{{$sekolah->kelurahan_id}}">{{$sekolah->kelurahan->name}}, {{$sekolah->kelurahan->district->name}}, {{$sekolah->kelurahan->district->regency->name}}, {{$sekolah->kelurahan->district->regency->province->name}}</option>
                                        <option></option>
                                        @else
                                            <option></option>
                                        @endif
                                    </select>
                        
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
<script>
    function npsnwoe() {
        document.getElementById("tunggu").innerHTML = "Mohon Menunggu...";
        var val = $('#npsn').val();
        fetch('{{asset('api.php')}}?npsn=' + val)
            .then((response) => {
                return response.json()
            })
            .then((data) => {
                console.log(data);
                document.getElementById("tunggu").innerHTML = "Data ditemukan";
                $('#sekolah').val(data.nama);
                $('#telp_sekolah').val(data.telp_sekolah);
                $('#alamat_sekolah').val(data.alamat_jalan);
            })
            .catch((err) => {
                document.getElementById("tunggu").innerHTML = "Data tidak ditemukan, silahkan isi manual";
            })
    }
</script>
@endsection