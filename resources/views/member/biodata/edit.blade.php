@extends('layouts.member')
@section('content')
@section('title','Biodata')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Biodata') }}
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
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                <form id="validate_form" action="{{route('biodata.member.save')}}" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                @if (empty($member->foto))
                                    <img style="height: 200px;width: 200px; object-fit: cover" alt="{{$member->nisn}}" class="rounded-full" src="{{asset('dist/images/profile-2.jpg')}}">
                                @else
                                    <img style="height: 200px;width: 200px; object-fit: cover" alt="{{$member->nisn}}" class="rounded-full" src="{{asset('uploads/'.$member->foto)}}">
                                @endif
                            </div>
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
                                        value="{{$member->nisn}}"
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
                                    NIK
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="nik"
                                        name="nik"
                                        required data-parsley-minlength="16" data-parsley-type="integer" data-parsley-trigger="keyup"
                                        type="number"
                                        value="{{$member->nik}}"
                                        placeholder="NIK"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    KIP (Jika Ada)
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="kip"
                                        name="kip"
                                        type="text"
                                        value="{{$member->kip}}"
                                        placeholder="KIP"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="jenis_kelamin"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Jenis Kelamin
                                </label>
                        
                                <div class="relative">
                                    <select id="jenis_kelamin" name="jenis_kelamin" required class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                        <option @if ($member->jenis_kelamin == 'L') selected @endif value="L">Laki - Laki</option>
                                        <option @if ($member->jenis_kelamin == 'P') selected @endif value="P">Perempuan</option>
                                    </select>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Agama
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="agama"
                                        required data-parsley-trigger="keyup"
                                        name="agama"
                                        type="text"
                                        value="{{$member->agama}}"
                                        placeholder="Agama"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
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
                                        value="{{$member->tempat_lahir}}"
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
                                        value="{{$member->tanggal_lahir}}"
                                        placeholder="Tanggal Lahir"
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
                                        id="nohp"
                                        required data-parsley-trigger="keyup"
                                        name="nohp"
                                        type="text"
                                        value="{{$member->nohp}}"
                                        placeholder="WA"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="kelas"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Ukuran Baju
                                </label>
                        
                                <div class="relative">
                                    <select name="ukuran_baju" required class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                        <option @if($member->ukuran_baju == 'XS') selected @endif value="XS">XS</option>
                                        <option @if($member->ukuran_baju == 'S') selected @endif value="S">S</option>
                                        <option @if($member->ukuran_baju == 'M') selected @endif value="M">M</option>
                                        <option @if($member->ukuran_baju == 'L') selected @endif value="L">L</option>
                                        <option @if($member->ukuran_baju == 'XL') selected @endif value="XL">XL</option>
                                        <option @if($member->ukuran_baju == 'XXL') selected @endif value="XXL">XXL</option>
                                        <option @if($member->ukuran_baju == 'XXXL') selected @endif value="XXXL">XXXL</option>
                                    </select>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="kelas"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Kelas
                                </label>
                        
                                <div class="relative">
                                    <select id="kelas" name="kelas" required class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                        <option @if ($member->kelas == 10) selected @endif value="10">10</option>
                                        <option @if ($member->kelas == 11) selected @endif value="11">11</option>
                                    </select>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="kelas"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Jurusan
                                </label>
                        
                                <div class="relative">
                                    <select name="jurusan" required class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                        <option @if ($member->jurusan == 'IPA') selected @endif value="IPA">IPA</option>
                                        <option @if ($member->jurusan == 'IPS') selected @endif value="IPS">IPS</option>
                                        <option @if ($member->jurusan == 'Bahasa') selected @endif value="Bahasa">Bahasa</option>
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
                                        value="{{$member->jalan}}"
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
                                        value="{{$member->no_rmh}}"
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
                                        value="{{$member->rt_rw}}"
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
                                        value="{{$member->kodepos}}"
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
                                        @if (!empty($member->kelurahan_id))
                                        <option value="{{$member->kelurahan_id}}">{{$member->kelurahan->name}}, {{$member->kelurahan->district->name}}, {{$member->kelurahan->district->regency->name}}, {{$member->kelurahan->district->regency->province->name}}</option>
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
                                    Alamat Lengkap (Khusus Sekolah Indonesia Luar Negri)
                                </label>
                        
                                <div class="relative">
                                    <textarea name="alamat_siln" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">{{$member->alamat_siln}}</textarea>
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                   Foto
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="foto"
                                        name="foto"
                                        type="file"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
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
                $('#nik').val(data.nik);
                $('#kip').val(data.no_kip);
                $('#agama').val(data.agama);
                $('#tempat_lahir').val(data.tempat_lahir);
                $('#tanggal_lahir').val(data.tanggal_lahir);
                $('#kelas').val(data.tingkat);
                $('#jenis_kelamin').val(data.jenis_kelamin);
            })
            .catch((err) => {
                document.getElementById("tunggu").innerHTML = "Data tidak ditemukan, silahkan isi manual";
            })
    }
</script>
@endsection