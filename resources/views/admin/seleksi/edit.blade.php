@extends('layouts.admin')
@section('description','Seleksi')
@section('title','Seleksi')
@section('content')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Seleksi') }}
</h2>  
@endsection  
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @forelse ($proposal->tim->unggahan as $item)
            <div class="p-6 bg-white border-b border-gray-200">
                <div><span class="text-xl text-bold">{{$item->berkasss->nama_surat}}</span></div>
                <br>
                <div><embed style="width: 100%; height: 500px" class="embed-responsive-item" src="{{asset('uploads/'.$item->berkas)}}"></div>
            </div>
            @empty
                <h1>Belum Unggah Berkas</h1>
            @endforelse
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form action="{{route('seleksi-admin.update', $proposal->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="my-5">
                    <div class="flex flex-col w-full max-w-sm mx-auto p-4 bg-white">
                        <div class="flex flex-col mb-4">
                            <label for="name"
                                class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                Status
                            </label>
                    
                            <div class="relative">
                    
                                <select name="lolos" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                    <option @if ($proposal->lolos == 0) selected @endif value="0">Belum Ditentukan</option>
                                    <option @if ($proposal->lolos == 1) selected @endif value="1">Lolos</option>
                                    <option @if ($proposal->lolos == 2) selected @endif value="2">Tidak Lolos</option>
                                </select>
                    
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
@endsection
@section('script')
<script>
    $(document).ready(function(){
    
     $('#validate_form').parsley();
    
    });
</script>
@endsection
