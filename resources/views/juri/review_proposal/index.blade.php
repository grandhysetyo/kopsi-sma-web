@extends('layouts.juri')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Review Proposal') }}
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
                            <th data-priority="6">Status</th>
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
    (function($) {
        $(document).ready(function(){
      var id = $(this).attr('id');
     $('#example').DataTable({
      processing: true,
      stateSave: true,
      serverSide: true,
      responsive: true,
      ajax:{
       url: "{{ route('proposal.review') }}",
      },
      columns:[
       {
        data: 'proposal.tim.nama_karya',
        name: 'proposal.tim.nama_karya'
       },
       {
        data: 'proposal.tim.nama_tim',
        name: 'proposal.tim.nama_tim'
       },
       {
        data: 'proposal.tim.sekolah.nama_sekolah',
        name: 'proposal.tim.sekolah.nama_sekolah'
       },
       {
        data: 'proposal.tim.provinsi.name',
        name: 'proposal.tim.provinsi.name'
       },
       {
        data: 'proposal.tim.bidang.nama_sub',
        name: 'proposal.tim.bidang.nama_sub'
       },
       {
        data: 'lolos',
        name: 'lolos',
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