@extends('layouts.juri')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Naskah') }}
</span>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Judul</th>
                            <th data-priority="2">Tim</th>
                            <th data-priority="3">Sekolah</th>
                            <th data-priority="4">Provinsi</th>
                            <th data-priority="5">Sub Bidang</th>
                            <th data-priority="6">Bidang</th>
                            <th data-priority="7">Review Proposal</th>
                            <th data-priority="8">Aksi</th>
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
       url: "{{ route('naskah.juri') }}",
      },
      columns:[
       {
        data: 'tim.nama_karya',
        name: 'tim.nama_karya'
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
        data: 'tim.provinsi.name',
        name: 'tim.provinsi.name'
       },
       {
        data: 'tim.bidang.nama_sub',
        name: 'tim.bidang.nama_sub'
       },
       {
        data: 'tim.bidang.bidang.singkat',
        name: 'tim.bidang.bidang.singkat'
       },
       {
        data: 'review',
        name: 'review',
        searchable: false,
        orderable: false,
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
    })(jQuery);
    </script>
@endsection