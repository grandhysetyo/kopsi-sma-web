@extends('layouts.leader')
@section('description','Twibbonice')
@section('title','Twibbonice')
@section('content')
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Twibbonice
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Input -->
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Twibbonice
                    </h2>
                    @if (!twibbon(auth()->user()->id))
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <a type="button" href="{{route('twibbonice.create')}}" class="btn btn-primary shadow-md mr-2">Buat Twibbon</a>
                    </div>
                    @endif
                    
                </div>
                <div class="p-5" id="hoverable-table">
                    <div class="preview">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">Nama</th>
                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">Unduh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($twibbon as $item)
                                        <tr class="hover:bg-gray-200">
                                            <td class="border">{{$loop->iteration}}</td>
                                            <td class="border">{{$item->user->name}}</td>
                                            <td class="border"><a id="download" class="btn btn-primary text-white">Unduh</a><a type="button" href="{{route('hapus.twibbonice', $item->id)}}" class="btn btn-danger text-white">Hapus</a></td>
                                            <img src="{{asset('uploads/'.$item->foto)}}" id="img1" width="500px" height="500px" style="display: none" class="img-fluid">
										    <img src="#" id="img2" width="500px" height="500px" style="display: none" hidden="true" class="img-fluid">
										    <h2 style="display: none"><canvas id="canvas" class="img-fluid"></canvas></h2>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
        downloadCanvas(this, 'canvas', 'wfi-twibbon.png');
    }, false);

</script>
@endsection