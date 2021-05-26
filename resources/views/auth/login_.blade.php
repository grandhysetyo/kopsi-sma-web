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

    <span id="extr-page-header-space"> <span class="hidden-mobile">Belum Mendaftar?</span> <a href="/" class="btn btn-danger">Daftar</a> </span>

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
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                <div class="well no-padding">
                    <form action="{{route('login')}}" id="validate_form" method="POST"  class="smart-form client-form">
                        @csrf
                        <header>
                            Sign In
                        </header>
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        @if(session('berhasil'))
                            <span>Daftar Berhasil, Silahkan Masuk</span>
                        @endif
                        <fieldset>
                            
                            <section>
                                <label class="label">E-mail</label>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <input type="email" value="{{old('email')}}" required data-parsley-type="email" data-parsley-trigger="keyup" name="email">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label>
                            </section>

                            <section>
                                <label class="label">Password</label>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                    <input type="password" name="password">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
                            </section>
                        </fieldset>
                        <footer>
                            <button type="submit" class="btn btn-primary">
                                Sign in
                            </button>
                        </footer>
                    </form>

                </div>
                
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
@endsection