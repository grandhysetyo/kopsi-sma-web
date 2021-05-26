@extends('layouts.leader')
@section('description','Presentasi')
@section('title','Presentasi')
@section('content')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Presentasi') }}
</h2>  
@endsection  
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div class="p-6 bg-white border-b border-gray-200">
                @if (!presentasi(auth()->user()->ketua->tim->id))
                <form action="{{ route('presentasi.store') }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col mb-4">
                            <div>
                                <label class="inline-flex items-center">
                                    <input required type="checkbox" name="konfirmasi" value="1" class="checks form-checkbox text-green-500">
                                    <span class="ml-2">Kami Siap Mengikuti Final KOPSI</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center pt-2">
                        <input type="submit"  value="Simpan" class="focus:outline-none px-4 bg-yellow-500 p-3 ml-3 rounded-lg text-white hover:bg-yellow-400">
                    </div>
    
                </form>
                @else
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Judul</th>
                            <th data-priority="2">Bidang</th>
                            <th data-priority="3">Aksi</th>
                        </tr>
                    </thead>
                </table>
                @endif
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
    
     $('#validate_form').parsley();
    
    });
</script>
<script>
    $(document).ready(function(){
      var id = $(this).attr('id');
     $('#example').DataTable({
      processing: true,
      stateSave: true,
      serverSide: true,
      responsive: true,
      ajax:{
       url: "{{ route('presentasi.index') }}",
      },
      columns:[
       {
        data: 'judul',
        name: 'judul'
       },
       {
        data: 'bidang.singkat',
        name: 'bidang.singkat'
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
