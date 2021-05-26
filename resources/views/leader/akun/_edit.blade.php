@extends('layouts.leader')
@section('description','Akun')
@section('title','Akun')
@section('content')
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Akun
        </h2>
    </div>
    <div>
        @if(session('sukses'))
        <div class="alert alert-success alert-dismissible show flex items-center mb-2" role="alert">
            <i data-feather="smile" class="w-6 h-6 mr-2"></i> Berhasil memperbarui data
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="w-4 h-4"></i> </button>
        </div>
        @endif
    </div>
    
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Input -->
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Akun
                    </h2>
                </div>
                <div id="input" class="p-5">
                    <form id="validate_form" method="POST" action="{{route('akun.leader.save')}}">
                        @method('PUT')
                        @csrf
                        <div class="preview">
                            <div>
                                <label for="name" class="form-label">Nama</label>
                                <input id="name" name="name" type="text" required data-parsley-trigger="keyup" value="{{$user->name}}" class="form-control" placeholder="Nama">
                            </div>
                            <div class="mt-3">
                                <label for="email" class="form-label">E-Mail</label>
                                <input id="email" name="email" required data-parsley-type="email" data-parsley-trigger="keyup" type="email" value="{{$user->email}}" class="form-control" placeholder="E-Mail">
                            </div>
                            <div class="mt-3">
                                <label for="password" class="form-label">Kata Sandi (Isi jika ingin mengganti)</label>
                                <input data-parsley-minlength="8" autocomplete="new-password" data-parsley-trigger="keyup" id="password" name="password" type="password" class="form-control" placeholder="Kata Sandi">
                            </div>
                            <div class="mt-3">
                                <label for="password-confirmation" class="form-label">Ulangi Kata Sandi (Isi jika ingin mengganti)</label>
                                <input data-parsley-equalto="#password" data-parsley-trigger="keyup" id="password-confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Ulangi Kata Sandi">
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mt-5 w-full">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Input -->
        </div>
    </div>
</div>
<!-- END: Content -->
@endsection
@section('script')
<script>
    $(document).ready(function(){
    
     $('#validate_form').parsley();
    
    });
</script>
@endsection