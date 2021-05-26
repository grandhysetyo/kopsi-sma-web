@extends('layouts.leader')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Kejuaraan Yang Pernah diikuti 2 tahun terakhir') }}
</span>   
<a href="{{route('kejuaraan.create')}}" style="float: right" class='bg-blue-500 text-white p-2 rounded text-l font-bold'>Tambah Prestasi</a>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div>
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
            <div>
                @if(session('gagal'))
                    <div class="mt-8 mr-4 ml-4 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-1">Berkas dengan jenis yang sama sudah ada</strong> 
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Judul</th>
                            <th data-priority="2">Tempat</th>
                            <th data-priority="3">Waktu</th>
                            <th data-priority="4">Penyelenggara</th>
                            <th data-priority="5">Prestasi</th>
                            <th data-priority="6">Aksi</th>
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
    $(document).ready(function(){
      var id = $(this).attr('id');
     $('#example').DataTable({
      processing: true,
      stateSave: true,
      serverSide: true,
      responsive: true,
      ajax:{
       url: "{{ route('kejuaraan.index') }}",
      },
      columns:[
       {
        data: 'judul',
        name: 'judul'
       },
       {
        data: 'tempat',
        name: 'tempat'
       },
       {
        data: 'tanggal',
        name: 'tanggal',
        searchable: false,
        orderable: false
       },
       {
        data: 'penyelenggara',
        name: 'penyelenggara'
       },
       {
        data: 'prestasi',
        name: 'prestasi'
       },
       {
        data: 'edit',
        name: 'edit',
        searchable: false,
        orderable: false,
       }
       
      ]
     })
    .columns.adjust()
	.responsive.recalc();
    });
    </script>
@endsection