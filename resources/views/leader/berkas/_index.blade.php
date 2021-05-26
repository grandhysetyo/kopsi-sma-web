@extends('layouts.leader')
@section('description','Berkas')
@section('title','Berkas')
@section('content')
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Berkas
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a data-toggle="modal" data-target="#header-footer-modal-preview" class="btn btn-primary shadow-md mr-2">Tambah Berkas</a>
        </div>
        
        <div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- BEGIN: Modal Header -->
                    <div class="modal-header">
                        <h2 class="font-medium text-base mr-auto">
                            Unggah Berkas
                        </h2>
                    </div>
                    <form action="{{route('berkas.store')}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-12">
                                <label for="berkas_id" class="form-label">Jenis</label>
                                <select id="berkas_id" name="berkas_id" class="form-select">
                                    @foreach ($berkas as $item)
                                        <option value="{{$item->id}}">{{$item->nama_surat}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="berkas" class="form-label">Berkas (PDF, Max 2MB)</label>
                                <input id="berkas" type="file" name="berkas" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer text-right">
                            <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Batal</button>
                            <button type="submit" class="btn btn-primary w-20">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
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
            <i data-feather="smile" class="w-6 h-6 mr-2"></i> Berhasil memperbarui data
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
                        Berkas
                    </h2>
                </div>
                <div class="p-10 overflow-x-auto scrollbar-hidden">
                    <table id="example" class="table">
                        <thead>
                            <tr>
                                <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">Nama Berkas</th>
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
       url: "{{ route('berkas.index') }}",
      },
      columns:[
       {
        data: 'berkasss.nama_surat',
        name: 'berkasss.nama_surat'
       },
       {
        data: 'berkass',
        name: 'berkass',
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