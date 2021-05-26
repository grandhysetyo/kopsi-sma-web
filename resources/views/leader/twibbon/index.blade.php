@extends('layouts.leader')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Twibbonice') }}
</span>   
<a href="{{route('twibbonice.create')}}" style="float: right" class='bg-blue-500 text-white p-2 rounded text-l font-bold'>Buat Twibbon</a>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div>
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Nama</th>
                            <th data-priority="2">Unduh</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($twibbon as $item)
                            <tr class="hover:bg-gray-200">
                                <td class="border">{{$item->user->name}}</td>
                                <td class="border"><a id="download" class="focus:outline-none px-4 bg-green-500 p-3 ml-3 rounded-lg text-white hover:bg-green-400">Unduh</a><a type="button" href="{{route('hapus.twibbonice', $item->id)}}" class="focus:outline-none px-4 bg-red-500 p-3 ml-3 rounded-lg text-white hover:bg-red-400">Hapus</a></td>
                                <img src="{{asset('uploads/'.$item->foto)}}" id="img1" width="1000px" height="1000px" style="display: none" class="img-fluid">
                                <img src="{{asset('kopsi/img/twibbon.png')}}" id="img2" width="1000px" height="1000px" style="display: none" hidden="true" class="img-fluid">
                                <h2 style="display: none"><canvas id="canvas" class="img-fluid"></canvas></h2>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    window.onload = function () {
        var img1 = document.getElementById('img1');
        var img2 = document.getElementById('img2');
        var canvas = document.getElementById("canvas");
        var context = canvas.getContext("2d");
        var width = img2.width;
        var height = img2.height;
        canvas.width = width;
        canvas.height = height;

        context.drawImage(img1, 0, 1, width, height);
        var image1 = context.getImageData(0, 0, width, height);
        var imageData1 = image1.data;
        context.drawImage(img2, 0, 0, width, height);
        var image2 = context.getImageData(0, 0, width, height);
        var imageData2 = image2.data;
    };

    function downloadCanvas(link, canvasId, filename) {
        link.href = document.getElementById(canvasId).toDataURL();
        link.download = filename;
    }

    document.getElementById('download').addEventListener('click', function() {
        downloadCanvas(this, 'canvas', 'twibbon-kopsi.png');
    }, false);

</script>
@endsection