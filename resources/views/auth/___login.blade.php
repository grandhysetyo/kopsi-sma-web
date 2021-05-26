@extends('layouts.auth')
@section('title','Login')
@section('content')
<section class="login">
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    @if(session('berhasil'))
    <div class="mt-8 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
        <strong class="mr-1">Daftar berhasil, silahkan masuk</strong>
        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
        </button>
    </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mx-auto">
                <form class="form-login" action="{{route('login')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">Surel (Email)</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter email" />
                        
                    </div>
                    <div class="form-group">
                        <label for="password">Kata Sandi (Password)</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Kata Sandi" />
                    </div>                                    
                    <button type="submit" class="btn-me btn-masuk">Masuk</button>
                    {{-- <span class="text-muted">Belum memiliki akun?</span>
                    <a href="/daftar" class="btn-me btn-daftar">Daftar</a> --}}
                </form>
                
            </div>
        </div>
    </div>
</section>
@endsection