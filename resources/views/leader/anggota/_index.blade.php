@extends('layouts.leader')
@section('description','Biodata')
@section('title','Biodata')
@section('content')
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Anggota Tim
        </h2>
    </div>
    <div>
        <label for="myInput" class="form-label">Kode Refferal</label>
        <input id="myInput" type="text" class="form-control" value="{{auth()->user()->ketua->kode}}">
        <button class="btn btn-primary mt-3" onclick="myFunction()">Copy text</button>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Input -->
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Anggota Tim
                    </h2>
                </div>
                <div class="p-5" id="hoverable-table">
                    <div class="preview">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">NISN</th>
                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">Nama</th>
                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">Sekolah</th>
                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">Tim</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anggota as $item)
                                        <tr class="hover:bg-gray-200">
                                            <td class="border">{{$loop->iteration}}</td>
                                            <td class="border">{{$item->nisn}}</td>
                                            <td class="border">{{$item->user->name}}</td>
                                            <td class="border">{{$item->tim->sekolah->nama_sekolah}}</td>
                                            <td class="border">{{$item->tim->nama_tim}}</td>
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
        function myFunction() {
        /* Get the text field */
        var copyText = document.getElementById("myInput");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        document.execCommand("copy");

        /* Alert the copied text */
        alert("Copied the text: " + copyText.value);
        }
    </script>
@endsection