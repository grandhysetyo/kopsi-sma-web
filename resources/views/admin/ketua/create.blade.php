@extends('layouts.admin')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Tambah Ketua
</span>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                @if ($errors->any())
                    <div>
                        <div class="font-medium text-red-600">
                            {{ __('Whoops! Something went wrong.') }}
                        </div>

                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="validate_form" action="{{route('ketua.store')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Akun
                                </label>
                        
                                <div class="relative">    
                                    <select name="user_id" id="user_id" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                        <option></option>
                                    </select>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    NISN
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        name="nisn"
                                        type="number"
                                        id="nisn"
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
                                        <option value="L">Laki - Laki</option>
                                        <option value="P">Perempuan</option>
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
                                        <option value="XS">XS</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                        <option value="XXXL">XXXL</option>
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
                                        <option value="10">10</option>
                                        <option value="11">11</option>
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
                                        <option value="IPA">IPA</option>
                                        <option value="IPS">IPS</option>
                                        <option value="Bahasa">Bahasa</option>
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
                                        <option></option>
                                    </select>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Alamat Lengkap (Khusus Sekolah Indonesia Luar Negri)
                                </label>
                        
                                <div class="relative">
                                    <textarea name="alamat_siln" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6"></textarea>
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
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Tim
                                </label>
                        
                                <div class="relative">    
                                    <select name="tim_id" id="tim_id" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                        <option></option>
                                    </select>
                        
                                </div>
                            </div>
                            <input id="nama_ibu" name="nama_ibu" type="hidden" class="form-control">
                            <input id="pekerjaan_ibu" name="pekerjaan_ibu" type="hidden" class="form-control">
                            <input id="pendidikan_terakhir_ibu" name="pendidikan_terakhir_ibu" type="hidden" class="form-control">
                            <input id="nama_ayah" name="nama_ayah" type="hidden" class="form-control">
                            <input id="pekerjaan_ayah" name="pekerjaan_ayah" type="hidden" class="form-control">
                            <input id="pendidikan_terakhir_ayah" name="pendidikan_terakhir_ayah" type="hidden" class="form-control">                
                            
                            
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="flex justify-center pt-2">
                        <button type="submit"
                            class="focus:outline-none px-4 bg-indigo-500 p-3 ml-3 rounded-lg text-white hover:bg-indigo-400">Save</button>
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
<script type="text/javascript">

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

      $( "#tim_id" ).select2({
        ajax: { 
          url: "{{route('cari-tim')}}",
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

      $( "#user_id" ).select2({
        ajax: { 
          url: "{{route('cari-user')}}",
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