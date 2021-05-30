@extends('layouts.leader')
@section('content')
@section('header')
@section('title','Anggota')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Anggota') }}
</span>   
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="m-10">
                <div class="flex flex-col mb-4">
                    <label for="name"
                        class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                        Kode Refferal
                    </label>
            
                    <div class="relative">
            
                        <input id="myInput"
                            value="{{auth()->user()->ketua->kode}}"
                            class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
            
                    </div>
                </div>
                <button class="focus:outline-none px-4 bg-yellow-500 p-3 ml-3 rounded-lg text-white hover:bg-yellow-400" onclick="myFunction()">Copy text</button>
            </div>
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">NISN</th>
                            <th data-priority="2">Nama</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    (function($) {
        $(document).ready(function(){
      var id = $(this).attr('id');
     $('#example').DataTable({
      processing: true,
      stateSave: true,
      serverSide: true,
      responsive: true,
      ajax:{
       url: "{{ route('anggota.leader') }}",
      },
      columns:[
       {
        data: 'nisn',
        name: 'nisn'
       },
       {
        data: 'user.name',
        name: 'user.name'
       }
       
      ]
     })
    .columns.adjust()
	.responsive.recalc();
    });
    })(jQuery);
    </script>
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