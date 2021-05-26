@extends('layouts.admin')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Pembimbing') }}
</span>   
<a style="float: right" href="{{route('pembimbing.create')}}" class='bg-blue-500 text-white p-2 rounded text-l font-bold'>Tambah Pembimbing</a>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Nama</th>
                            <th data-priority="2">Email</th>
                            <th data-priority="3">Telp</th>
                            <th data-priority="4">Tim</th>
                            <th data-priority="5">Sekolah</th>
                            <th data-priority="6">Surat</th>
                            <th data-priority="7">Aksi</th>
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
       url: "{{ route('pembimbing.index') }}",
      },
      columns:[
       {
        data: 'nama',
        name: 'nama'
       },
       
       {
        data: 'email',
        name: 'email'
       },
       {
        data: 'no_telp',
        name: 'no_telp'
       },
       {
        data: 'tim.nama_tim',
        name: 'tim.nama_tim'
       },
       {
        data: 'tim.sekolah.nama_sekolah',
        name: 'tim.sekolah.nama_sekolah'
       },
       {
        data: 'surat',
        name: 'surat',
        searchable: false,
        orderable: false
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