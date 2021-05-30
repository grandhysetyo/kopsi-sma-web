@extends('layouts.member')
@section('content')
@section('title','Akun')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Akun') }}
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
                <form id="validate_form" action="{{route('akun.member.save')}}" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Nama
                                </label>
                        
                                <div class="relative">
                        
                                    <input id="name"
                                        name="name"
                                        type="text"
                                        required data-parsley-trigger="keyup"
                                        value="{{$user->name}}"
                                        placeholder="Nama"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    E-Mail
                                </label>
                        
                                <div class="relative">
                        
                                    <input id="email"
                                        name="email"
                                        type="email"
                                        required data-parsley-type="email" data-parsley-trigger="keyup"
                                        value="{{$user->email}}"
                                        placeholder="Email"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Kata Sandi (Isi jika ingin mengubah)
                                </label>
                        
                                <div class="relative">
                        
                                    <input id="password"
                                        name="password"
                                        data-parsley-minlength="8" autocomplete="new-password" data-parsley-trigger="keyup"
                                        type="password"
                                        placeholder="Kata Sandi"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Ulangi Kata Sandi (Isi jika ingin mengubah)
                                </label>
                        
                                <div class="relative">
                        
                                    <input data-parsley-equalto="#password" data-parsley-trigger="keyup" id="password-confirmation" name="password_confirmation"
                                        type="password"
                                        placeholder="Kata Sandi"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
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
    
    (function($) {
        $(document).ready(function(){
    
        $('#validate_form').parsley();
    
    });
    })(jQuery);
</script>
@endsection