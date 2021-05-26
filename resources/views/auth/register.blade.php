@extends('layouts.auth')
@section('title','Daftar')
@section('content')
<section class="register">
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    @if(session('nisn'))
    <div class="mt-8 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
        <strong class="mr-1">Maaf</strong> data kamu sudah terdaftar
        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
        </button>
    </div>
    @endif

    @if(session('warning'))
    <div class="mt-8 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
        <strong class="mr-1">Maaf</strong> sepertinya ada yang belum diisi
        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
        </button>
    </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mx-auto">
                <form id="validate_form" class="form-login" action="{{route('ketua_daftar_post')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="number" class="form-control" name="nisn" value="{{old('nisn')}}" data-parsley-type="integer" data-parsley-trigger="keyup" required placeholder="NISN" />
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}" required data-parsley-trigger="keyup" placeholder="Nama" />
                        
                    </div>
                    <div class="form-group">
                        <label for="email">Surel (Email)</label>
                        <input type="email" class="form-control" name="email"  value="{{old('email')}}" required data-parsley-type="email" data-parsley-trigger="keyup" placeholder="Email" />
                        
                    </div>
                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <input type="password" class="form-control" id="password" type="password" name="password" data-parsley-minlength="8" required autocomplete="new-password" data-parsley-trigger="keyup" placeholder="Kata Sandi" />
                    </div>       
                    <div class="form-group">
                        <label for="password">Ulangi Kata Sandi</label>
                        <input type="password" class="form-control" id="password-confirmation" name="password_confirmation" data-parsley-equalto="#password" required data-parsley-trigger="keyup" placeholder="Kata Sandi" />
                    </div>                                    
                    <button type="submit" class="btn-me btn-daftar">Daftar</button>
                    {{-- <span class="text-muted">Sudah memiliki akun?</span>
                    <a href="/daftar" class="btn-me btn-masuk">Masuk</a> --}}
                </form>
                
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    $(document).ready(function(){
    
     $('#validate_form').parsley();
    
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
                $('#nama').val(data.nama);
                $('#email').val(data.email_pd);
                $('#kip').val(data.no_kip);
                $('#agama').val(data.agama);
                $('#tempat_lahir').val(data.tempat_lahir);
                $('#tanggal_lahir').val(data.tanggal_lahir);
                $('#kelas').val(data.tingkat);
                $('#npsn').val(data.npsn);
                $('#sekolah').val(data.sekolah);

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