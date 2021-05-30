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
    <section class="login">
        <img src="{{asset('assets/images/sky-login.png')}}" class="sky" alt="" />
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mx-auto">
                    
                    <form action="{{route('login')}}" id="validate_form" method="POST" class="form-login">
                        @csrf
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        @if(session('berhasil'))
                            <span>Daftar Berhasil, Silahkan Masuk</span>
                        @endif
                        <div>
                            <img src="{{asset('assets/images/logo.png')}}" class="img-fluid" style="height: 70px; display: block;
                            margin-left: auto;
                            margin-right: auto;">
                        </div>
                        <div class="form-group">
                            <label for="email">Surel (Email)</label>
                            <input value="{{old('email')}}" required data-parsley-type="email" data-parsley-trigger="keyup" type="email" id="email" class="form-control" name="email" placeholder="Enter email" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Kata Sandi (Password)</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Kata Sandi" />
                        </div>                                    
                        <button type="submit" class="btn-me btn-masuk">Masuk</button>
                        <span class="text-muted">Belum memiliki akun?</span>
                        <a href="/leader-register" class="btn-me btn-daftar">Daftar Ketua</a>
                        <a href="/member-register" class="btn-me btn-daftar">Daftar Anggota</a>
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
</body>
</html>