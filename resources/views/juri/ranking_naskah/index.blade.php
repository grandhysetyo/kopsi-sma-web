@extends('layouts.juri')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Rangking Naskah') }}
</span>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Peringkat</th>
                            <th data-priority="2">Judul</th>
                            <th data-priority="3">Tim</th>
                            <th data-priority="4">Sekolah</th>
                            <th data-priority="5">Provinsi</th>
                            <th data-priority="6">Sub Bidang</th>
                            <th data-priority="7">Bidang</th>
                            <th data-priority="8">Nilai</th>
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
       url: "{{ route('naskah.ranking') }}",
      },
      columns:[
        {
                    "data": 'DT_RowIndex',
                    orderable: false, 
                    searchable: false
                },
       {
        data: 'naskah.tim.nama_karya',
        name: 'naskah.tim.nama_karya'
       },
       {
        data: 'naskah.tim.nama_tim',
        name: 'naskah.tim.nama_tim'
       },
       {
        data: 'naskah.tim.sekolah.nama_sekolah',
        name: 'naskah.tim.sekolah.nama_sekolah'
       },
       {
        data: 'naskah.tim.provinsi.name',
        name: 'naskah.tim.provinsi.name'
       },
       {
        data: 'naskah.tim.bidang.nama_sub',
        name: 'naskah.tim.bidang.nama_sub'
       },
       {
        data: 'naskah.tim.bidang.bidang.singkat',
        name: 'naskah.tim.bidang.bidang.singkat'
       },
       {
        data: 'nilai',
        name: 'nilai',
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