@extends('layouts.admin')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Informasi') }}
</span>   
<a style="float: right" href="{{route('info.create')}}" class='bg-blue-500 text-white p-2 rounded text-l font-bold'>Tambah Informasi</a>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Judul</th>
                            <th data-priority="2">Aksi</th>
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
      $.noConflict();
     $('#example').DataTable({
      processing: true,
      stateSave: true,
      serverSide: true,
      responsive: true,
      ajax:{
       url: "{{ route('info.index') }}",
      },
      columns:[
       {
        data: 'judul',
        name: 'judul'
       },
       {
        data: 'edit',
        name: 'edit',
        searchable: false,
        orderable: false
       }
       
      ],
     })
    .columns.adjust()
	.responsive.recalc();
    });
    </script>
@endsection