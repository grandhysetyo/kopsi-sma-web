@extends('layouts.leader')
@section('content')
@section('title','Orang Tua')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Orang Tua {{$ortu->ketua->user->name}}
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
                <form id="validate_form" action="{{route('ortu.leader.save')}}" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    NISN
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        disabled
                                        type="number"
                                        id="nisn"
                                        value="{{$ortu->ketua->nisn}}"
                                        placeholder="NISN"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                        <small id="tunggu">Cari NISN dari Data Peserta Didik (DAPODIK)</small>
                                </div>
                                <div>
                                    <button type="button" onclick="wkwk();"
                                    class="focus:outline-none px-4 bg-yellow-500 p-2 rounded-lg text-white hover:bg-yellow-400">Cari</button>
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Nama Ibu Kandung
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="nama_ibu"
                                        required data-parsley-trigger="keyup"
                                        name="nama_ibu"
                                        type="text"
                                        value="{{$ortu->nama_ibu}}"
                                        placeholder="Nama Ibu"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Pekerjaan Ibu
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="pekerjaan_ibu"
                                        required data-parsley-trigger="keyup"
                                        name="pekerjaan_ibu"
                                        type="text"
                                        value="{{$ortu->pekerjaan_ibu}}"
                                        placeholder="Pekerjaan Ibu"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Pendidikan Terakhir Ibu
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="pendidikan_terakhir_ibu"
                                        required data-parsley-trigger="keyup"
                                        name="pendidikan_terakhir_ibu"
                                        type="text"
                                        value="{{$ortu->pendidikan_terakhir_ibu}}"
                                        placeholder="Pendidikan Terakhir Ibu"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Nomor HP Ibu
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="nohp_ibu"
                                        required data-parsley-trigger="keyup"
                                        name="nohp_ibu"
                                        type="text"
                                        value="{{$ortu->nohp_ibu}}"
                                        placeholder="HP Ibu"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Nama Ayah
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="nama_ayah"
                                        required data-parsley-trigger="keyup"
                                        name="nama_ayah"
                                        type="text"
                                        value="{{$ortu->nama_ayah}}"
                                        placeholder="Nama Ayah"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Pekerjaan Ayah
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="pekerjaan_ayah"
                                        required data-parsley-trigger="keyup"
                                        name="pekerjaan_ayah"
                                        type="text"
                                        value="{{$ortu->pekerjaan_ayah}}"
                                        placeholder="Pekerjaan Ayah"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Pendidikan Terakhir Ayah
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="pendidikan_terakhir_ayah"
                                        required data-parsley-trigger="keyup"
                                        name="pendidikan_terakhir_ayah"
                                        type="text"
                                        value="{{$ortu->pendidikan_terakhir_ayah}}"
                                        placeholder="Pendidikan Terakhir Ayah"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Nomor HP Ayah
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="nohp_ayah"
                                        required data-parsley-trigger="keyup"
                                        name="nohp_ayah"
                                        type="text"
                                        value="{{$ortu->nohp_ayah}}"
                                        placeholder="HP Ayah"
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
                                        value="{{$ortu->jalan}}"
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
                                        value="{{$ortu->no_rmh}}"
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
                                        value="{{$ortu->rt_rw}}"
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
                                        value="{{$ortu->kodepos}}"
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
                                        @if (!empty($ortu->kelurahan_id))
                                        <option value="{{$ortu->kelurahan_id}}">{{$ortu->kelurahan->name}}, {{$ortu->kelurahan->district->name}}, {{$ortu->kelurahan->district->regency->name}}, {{$ortu->kelurahan->district->regency->province->name}}</option>
                                        <option></option>
                                        @else
                                            <option></option>
                                        @endif
                                    </select>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <div>
                                    <label class="inline-flex items-center">
                                        <input required type="checkbox" name="status" value="1" class="checks form-checkbox text-green-500">
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
    function wkwk() {
        document.getElementById("tunggu").innerHTML = "Mohon Menunggu...";
        var val = $('#nisn').val();
        fetch('{{asset('api_nisn.php')}}?nisn=' + val)
            .then((response) => {
                return response.json()
            })
            .then((data) => {
                console.log(data);
                document.getElementById("tunggu").innerHTML = "Data ditemukan";
                $('#nama_ibu').val(data.nama_ibu);
                $('#pekerjaan_ibu').val(data.pekerjaan_ibu);
                $('#pendidikan_terakhir_ibu').val(data.pendidikan_ibu);
                $('#nama_ayah').val(data.nama_ayah);
                $('#pekerjaan_ayah').val(data.pekerjaan_ayah);
                $('#pendidikan_terakhir_ayah').val(data.pendidikan_ayah);
            })
            .catch((err) => {
                document.getElementById("tunggu").innerHTML = "Data tidak ditemukan, silahkan isi manual";
            })
    }
</script>
@endsection