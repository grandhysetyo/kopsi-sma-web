@extends('layouts.auth')
@section('title','Review')
@section('content')
<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
<header id="header">
    <!--<span id="logo"></span>-->

    <div id="logo-group">
        <span id="logo"> <img src="{{asset('kopsi/img/logo.svg')}}" alt="KoPSI Logo"> </span>

        <!-- END AJAX-DROPDOWN -->
    </div>

    <span id="extr-page-header-space"> <span class="hidden-mobile">Sudah Mendaftar?</span> <a href="{{route('login')}}" class="btn btn-danger">Masuk</a> </span>

</header>

<div id="main" role="main">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 hidden-xs hidden-sm">
                
                <h1 class="txt-color-red login-header-big">KoPSI</h1>
                <div class="hero">
                    <div class="pull-left login-desc-box-l">
                        <h4 class="paragraph-header"><u>Peraturan Pendaftaran</u></h4>
                        
                        <p><strong>Ketua</strong> ataupun <strong>Anggota</strong> dapat melakukan pendaftaran mandiri sebagai perekaman data</p> 
                        <p>Untuk <strong>Anggota Satu Tim</strong> silahkan minta kode refferal agar dapat mendaftar sebagai anggota tim</p>
                        
                    </div>
                    
                    
                    <img src="{{asset('img/demo/opsi.png')}}" alt="" class="pull-right display-image" style="width:210px">
                    
                </div>

                

            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                <div class="well no-padding">

                    <form id="validate_form" class="form-horizontal contactform smart-form client-form" action="{{route('anggota_daftar_post')}}" method="post">
                        @csrf
                        <header>
                            Jika Kamu belum Pernah Mendaftar, Pada Create Account isilah kolom berikut ini:
                        </header>
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        @if(session('notfound'))
                            <span>Not Found</span>
                        @endif
                        @if(session('warning'))
                            <span>Gagal</span>
                        @endif
                        <fieldset>
                            

                            <section>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <input type="number" placeholder="Tulis NISN Kamu" id="nisn" value="{{old('nisn')}}" data-parsley-type="integer" data-parsley-trigger="keyup" required class="form-control" name="nisn">
                                    <!--<b class="tooltip tooltip-bottom-right">Needed to enter the website</b>--> </label>
                                    <small id="tunggu"></small>
                                    <br>
                                    <button type="button" onclick="wkwk();" class="btn btn-primary">
                                        Cari
                                    </button>
                            </section>

                            <section>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <input type="text" placeholder="Tulis Nama Kamu" id="name" class="form-control" value="{{old('name')}}" required data-parsley-trigger="keyup" name="name">
                                    <!--<b class="tooltip tooltip-bottom-right">Needed to enter the website</b>--> </label>
                            </section>

                            <section>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <input type="text" placeholder="Kode Refferal Ketua" id="kode" value="{{old('kode')}}" data-parsley-trigger="keyup" required class="form-control" name="kode">
                                    <!--<b class="tooltip tooltip-bottom-right">Needed to enter the website</b>--> </label>
                                    <small id="tunggus"></small>
                                    <br>
                                    <button type="button" onclick="ref();" class="btn btn-primary">
                                        Cari
                                    </button>
                            </section>

                            <section>
                                <label class="input"> <i class="icon-append fa fa-envelope"></i>
                                    <input type="email" placeholder="Tulis alamat email kamu" id="email" value="{{old('email')}}" required data-parsley-type="email" data-parsley-trigger="keyup" class="form-control" name="email">
                                    <b class="tooltip tooltip-bottom-right">Pastikan email yang didaftarkan belum pernah digunakan untuk mendaftar KoPSI</b> </label>
                            </section>

                            <section>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                    <input type="password" placeholder="Buat Kata Sandi" id="password" data-parsley-minlength="8" required autocomplete="new-password" data-parsley-trigger="keyup" class="form-control" name="password">
                                    <b class="tooltip tooltip-bottom-right">ingat kata kunci ini dan jangan diberitahukan kepada siapapun.</b> </label>
                            </section>

                            <section>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                    <input type="password" placeholder="Tulis Kembali Kata Sandi" data-parsley-equalto="#password" required data-parsley-trigger="keyup" id="password_confirmation" class="form-control" name="password_confirmation">
                                    <b class="tooltip tooltip-bottom-right">Tulis Kembali Kata Sandi yang kamu buat</b> </label>
                            </section>
                        </fieldset>
                        <input type="hidden" name="kip" id="kip">
                        <input type="hidden" name="agama" id="agama">
                        <input type="hidden" name="nik" id="nik">
                        <input type="hidden" name="tempat_lahir" id="tempat_lahir">
                        <input type="hidden" name="tanggal_lahir" id="tanggal_lahir">
                        <input type="hidden" name="kelas" id="kelas">
                        <input type="hidden" name="npsn" id="npsn">
                        <input type="hidden" name="sekolah" id="sekolah">
                        <input type="hidden" name="nama_ibu" id="nama_ibu">
                        <input type="hidden" name="pekerjaan_ibu" id="pekerjaan_ibu">
                        <input type="hidden" name="pendidikan_terakhir_ibu" id="pendidikan_terakhir_ibu">
                        <input type="hidden" name="nama_ayah" id="nama_ayah">
                        <input type="hidden" name="pekerjaan_ayah" id="pekerjaan_ayah">
                        <input type="hidden" name="pendidikan_terakhir_ayah" id="pendidikan_terakhir_ayah">

                        
                        <footer>
                            <button type="submit" class="btn btn-primary" name="sub">
                                Register
                            </button>
                        </footer>
                    </form>


                </div>
                <p class="note text-center">*KoPSI.</p>
                
                
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
                $('#name').val(data.nama);
                $('#email').val(data.email_pd);
                $('#kip').val(data.no_kip);
                $('#agama').val(data.agama);
                $('#tempat_lahir').val(data.tempat_lahir);
                $('#tanggal_lahir').val(data.tanggal_lahir);
                $('#kelas').val(data.tingkat);
                $('#nik').val(data.nik);
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
<script>
    function ref() {
        document.getElementById("tunggus").innerHTML = "Mohon Menunggu...";
        var id = document.getElementById("kode").value;
        var urll = '{{ route("kode_ref", ":id") }}';
        urll = urll.replace(':id', id);
        $.ajax({
        type: 'GET',
        url: urll,
        dataType: 'json',
        success: function(data) {
            if (data == 0) {
                document.getElementById("tunggus").innerHTML = "Data Tidak Ditemukan";
            } else {
                document.getElementById("tunggus").innerHTML = `Data ditemukan dengan nama ${data.user.name}`;
            }
            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log('data tidak ditemukan');
            
        }
        });
    }
</script>
@endsection