@extends('layouts.juri')
@section('content')
@section('title','Review')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Edit Review {{$proposal->proposal->tim->nama_karya}}
</h2>  
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                <form id="validate_form" action="{{route('perbarui_review', $proposal->id)}}" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                @if (empty($proposal->proposal->proposal))
                                    <h2>Belum Unggah Proposal</h2>
                                @else
                                    <div>
                                        <embed style="width: 100%; height: 500px" class="embed-responsive-item" src="{{asset('uploads/'.$proposal->proposal->proposal)}}">
                                    </div>
                                    <h2>atau</h2>
                                    <div class="m-5"><a target="_blank" type="button" href="{{asset('uploads/'.$proposal->proposal->proposal)}}"
                                        class="focus:outline-none px-4 bg-yellow-500 p-3 ml-3 rounded-lg text-white hover:bg-yellow-400">Buka di Tab Baru</a></div>
                                @endif
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="jenis_kelamin"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Status Kelolosan
                                </label>
                        
                                <div class="relative">
                                    <select name="status" required class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                        <option @if ($proposal->status == '1') selected @endif value="1">Lolos</option>
                                        <option @if ($proposal->status == '0') selected @endif  value="0">Tidak Lolos</option>
                                    </select>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                   Komentar
                                </label>
                        
                                <div class="relative">
                                    <textarea name="komentar" required data-parsley-trigger="keyup" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">{{$proposal->komentar}}</textarea>
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
    $(document).ready(function(){
    
     $('#validate_form').parsley();
    
    });
</script>
@endsection