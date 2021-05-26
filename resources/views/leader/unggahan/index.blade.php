@extends('layouts.leader')
@section('description','Unggahan')
@section('title','Unggahan')
@section('content')
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Unggahan
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="{{route('unggahan.create')}}" class="btn btn-primary shadow-md mr-2">Tambah Unggahan</a>
        </div>
    </div>

    <div>
        @if(session('gagal'))
            <div class="alert alert-danger-soft show flex items-center mb-2" role="alert"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i>Berkas dengan jenis yang sama sudah ada </div>
        @endif
    </div>
    <div>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    </div>
    <div>
        @if(session('sukses'))
        <div class="alert alert-success alert-dismissible show flex items-center mb-2" role="alert">
            <i data-feather="smile" class="w-6 h-6 mr-2"></i> Berhasil menghapus data
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="w-4 h-4"></i> </button>
        </div>
        @endif
    </div>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Input -->
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Unggahan
                    </h2>
                </div>
                <div class="p-10 overflow-x-auto scrollbar-hidden">
                    <table id="example" class="table">
                        <thead>
                            <tr>
                                <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">Nama Unggahan</th>
                                <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">Berkas</th>
                                <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                    </table>
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
    $(document).ready(function(){
      var id = $(this).attr('id');
     $('#example').DataTable({
      processing: true,
      stateSave: true,
      serverSide: true,
      ajax:{
       url: "{{ route('unggahan.index') }}",
      },
      columns:[
       {
        data: 'unggahan_bidang.nama_berkas',
        name: 'unggahan_bidang.nama_berkas'
       },
       {
        data: 'unggahan_file_tim',
        name: 'unggahan_file_tim',
        searchable: false,
        orderable: false
       },
       {
        data: 'edit',
        name: 'edit',
        searchable: false,
        orderable: false
       }
       
      ]
     });
    });
</script>
@endsection