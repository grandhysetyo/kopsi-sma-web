@extends('layouts.juri')
@section('content')
@section('title','Review')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Edit Nilai Presentasi {{$presentasi->presentasi->tim->nama_karya}}
</h2>  
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                <form id="validate_form" action="{{route('simpan.nilai.presentasi', $presentasi->id)}}" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            @foreach ($presentasi->nilai_presentasi as $item)
                            <div class="flex flex-col mb-4">
                                <label for="jenis_kelamin"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    {{$item->aspek_presentasi->keterangan}}
                                </label>

                                <input type="hidden" name="id[{{$loop->index}}]" value="{{$item->aspek_presentasi->id}}">
                                <input type="hidden" name="id_nilai[{{$loop->index}}]" value="{{$item->id}}">
                        
                                <div class="relative">
                                    <select name="nilai[{{$loop->index}}]" required class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                        <option @if ($item->nilai == '100') selected @endif value="100">Sangat Baik (10)</option>
                                        <option @if ($item->nilai == '80') selected @endif value="80">Baik (8)</option>
                                        <option @if ($item->nilai == '60') selected @endif value="60">Cukup (6)</option>
                                        <option @if ($item->nilai == '40') selected @endif value="40">Kurang (4)</option>
                                    </select>
                                </div>
                            </div>
                            @endforeach
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