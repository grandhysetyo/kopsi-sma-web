@extends('layouts.admin')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Tambah Informasi
</span>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                <form id="validate_form" action="{{route('info.store')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Judul
                                </label>
                                <div class="relative">
                                    <input
                                        name="judul"
                                        type="text"
                                        id="judul"
                                        placeholder="Judul"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                </div>
                            </div>        
                        </div>
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Kode Warna
                                </label>
                                <div class="relative">
                                    <input
                                        name="color"
                                        type="text"
                                        id="color"
                                        placeholder="color"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                </div>
                            </div>        
                        </div>
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Isi
                                </label>
                                <div class="relative">
                                    <textarea name="content" class="summernote text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6"></textarea>
                                </div>
                            </div>        
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