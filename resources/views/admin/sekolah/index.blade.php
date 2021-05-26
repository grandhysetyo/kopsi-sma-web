@extends('layouts.admin')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Sekolah') }}
</span>   
<a style="float: right" href="{{route('sekolah.create')}}" class='bg-blue-500 text-white p-2 rounded text-l font-bold'>Tambah Sekolah</a>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">ID</th>
                            <th data-priority="2">NPSN</th>
                            <th data-priority="3">Sekolah</th>
                            <th data-priority="4">Telp</th>
                            <th data-priority="5">Aksi</th>
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
       url: "{{ route('sekolah.index') }}",
      },
      columns:[
       {
        data: 'id',
        name: 'id'
       },
       
       {
        data: 'npsn',
        name: 'npsn'
       },
       {
        data: 'nama_sekolah',
        name: 'nama_sekolah'
       },
       {
        data: 'telp_sekolah',
        name: 'telp_sekolah'
       },
       {
        data: 'edit',
        name: 'edit',
        searchable: false,
        orderable: false
       }
       
      ]
     })
    .columns.adjust()
	.responsive.recalc();
    });
    </script>
@endsection