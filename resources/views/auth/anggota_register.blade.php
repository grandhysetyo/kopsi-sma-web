<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KOPSI | Masuk</title>
    <link rel="icon" type="image/png" href="/assets/images/favicon.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <script src="{{asset('superadmin/js/jquery.min.js')}}"></script>
    <script src="//parsleyjs.org/dist/parsley.js"></script> 
    <style>
        input.parsley-success,
        select.parsley-success,
        textarea.parsley-success {
          color: #468847;
          background-color: #DFF0D8;
          border: 1px solid #D6E9C6;
        }
      
        input.parsley-error,
        select.parsley-error,
        textarea.parsley-error {
          color: #B94A48;
          background-color: #F2DEDE;
          border: 1px solid #EED3D7;
        }
      
        .parsley-errors-list {
          margin: 2px 0 3px;
          padding: 0;
          list-style-type: none;
          font-size: 0.9em;
          line-height: 0.9em;
          opacity: 0;
      
          transition: all .3s ease-in;
          -o-transition: all .3s ease-in;
          -moz-transition: all .3s ease-in;
          -webkit-transition: all .3s ease-in;
        }
      
        .parsley-errors-list.filled {
          opacity: 1;
        }
        
        .parsley-type, .parsley-required, .parsley-equalto, .parsley-pattern, .parsley-length{
         color:#ff0000;
        }
        
    </style>
</head>
<body>
    <section class="login" style="padding-top:2%;">
        <img src="{{asset('assets/images/sky-login.png')}}" class="sky" alt="" />
        <div class="container">
            <div class="row">
                
                <div class="col-lg-12">
                    
                    <form action="{{route('anggota_daftar_post')}}" id="validate_form" method="POST" class="form-login">
                        @csrf
                        <div class="row">
                            <div class="col-12">                                                        
                                    <img src="{{asset('assets/images/logo.png')}}" class="img-fluid" style="height: 70px; display: block;
                                    margin-left: auto;
                                    margin-right: auto;">                                                                                           
                                <h4 class="paragraph-header"><u>Peraturan Pendaftaran</u></h4>                        
                                <p><strong>Ketua</strong> ataupun <strong>Anggota</strong> dapat melakukan pendaftaran mandiri sebagai perekaman data</p> 
                                <p>Untuk <strong>Anggota Satu Tim</strong> silahkan minta kode refferal agar dapat mendaftar sebagai anggota tim</p>
                                @csrf
                                <div>
                                    Jika Kamu belum Pernah Mendaftar, Pada Create Account isilah kolom berikut ini:
                                </div>
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                @if(session('notfound'))
                                    <small>Not Found</small>
                                @endif
                                @if(session('warning'))
                                    <small>Gagal</small>
                                @endif
                                
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-6 ">
                                <div class="form-group">
                                    <label>NISN</label>
                                    <input class="form-control" type="number" placeholder="Tulis NISN Kamu" id="nisn" value="{{old('nisn')}}" data-parsley-type="integer" data-parsley-trigger="keyup" required name="nisn">                            
                                    <small id="tunggu"></small>                                                                                    
                                </div>      
                                <div class="form-group">
                                    <button type="button" onclick="findNisn();" class="btn btn-primary">Cari</button>
                                </div>  
                                <div class="form-group">
                                    <label>Kode Refferal</label>
                                    <input type="text" placeholder="Kode Refferal Ketua" id="kode" value="{{old('kode')}}" data-parsley-trigger="keyup" required class="form-control" name="kode">
                                    <small id="tunggus"></small>                                                                                  
                                </div>      
                                <div class="form-group">
                                    <button type="button" onclick="ref();" class="btn btn-primary">Cari</button>
                                </div>                                                                            
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="name" placeholder="Tulis nama kamu" id="name" value="{{old('name')}}" required data-parsley-trigger="keyup" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Surel (Email)</label>
                                    <input type="email" placeholder="Tulis alamat email kamu" id="email" value="{{old('email')}}" required data-parsley-type="email" data-parsley-trigger="keyup" class="form-control" name="email">
                                    <small>*Pastikan email yang didaftarkan belum pernah digunakan untuk mendaftar KoPSI</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Kata Sandi (Password)</label>
                                    <input type="password" placeholder="Buat Kata Sandi" id="password" data-parsley-minlength="8" required autocomplete="new-password" data-parsley-trigger="keyup" class="form-control" name="password">
                                    <small>*Ingat kata kunci ini dan jangan diberitahukan kepada siapapun.</small>
                                </div> 
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ketik Ulang Kata Sandi (Password)</label>
                                    <input type="password" placeholder="Tulis Kembali Kata Sandi" data-parsley-equalto="#password" required data-parsley-trigger="keyup" id="password_confirmation" class="form-control" name="password_confirmation">
                                    
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
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

                                <button type="submit" class="btn-me btn-daftar"  name="sub">Daftar</button>
                                <span class="text-muted">Sudah memiliki akun?</span>
                                <a href="/login" class="btn-me btn-masuk">Masuk</a> 
                            </div>                        
                        </div>                                                                                                                          
                    </form>
                </div>
            </div>
        </div>
    </section>   
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
</body>
</html>