@extends('layouts.leader')
@section('description','Tim')
@section('title','Tim')
@section('content')
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Tim
        </h2>
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
                        Tim
                    </h2>
                </div>
                <div id="input" class="p-5">
                    <form id="validate_form" method="POST" action="{{route('tim.leader.save')}}">
                        @method('PUT')
                        @csrf
                        <div class="preview">
                            <div>
                                <label for="nama_tim" class="form-label">Nama Tim</label>
                                <input id="nama_tim" name="nama_tim" type="text" required data-parsley-trigger="keyup" value="{{$tim->nama_tim}}" class="form-control" placeholder="Nama Tim">
                            </div>
                            <div class="mt-3">
                                <label for="vertical-form-2" class="form-label">Provinsi <small>*</small></label>
                                <select class="form-select mt-2 sm:mr-2" name="province_id" id="province_id" aria-label="Default select example">
                                    @if (!empty($tim->province_id))
                                        <option value="{{$tim->province_id}}">{{$tim->provinsi->name}}</option>
                                    @else
                                        <option></option> 
                                    @endif
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="vertical-form-2" class="form-label">Bidang Lomba <small>*</small></label>
                                <select class="form-select mt-2 sm:mr-2" name="bidang_id" id="bidang_id" aria-label="Default select example">
                                    @if (!empty($tim->bidang_id))
                                        <option value="{{$tim->bidang->id}}">{{$tim->bidang->nama_bidang}}</option>
                                    @else
                                        <option></option> 
                                    @endif
                                </select>
                            </div>
                            <div class="mt-3">
                              <label for="nama_karya" class="form-label">Nama Karya</label>
                              <input id="nama_karya" name="nama_karya" type="text" required data-parsley-trigger="keyup" value="{{$tim->nama_karya}}" class="form-control" placeholder="Nama Produk/Usaha">
                            </div>
                            <div class="mt-3">
                              <label for="deskripsi_karya" class="form-label">Deskripsi Karya</label>
                              <textarea name="deskripsi_karya" id="deskripsi_karya" class="form-control" required data-parsley-trigger="keyup">{{$tim->deskripsi_karya}}</textarea>
                          </div>
                           
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mt-5 w-full">Simpan</button>
                        </div>
                    </form>
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
    
     $('#validate_form').parsley();
    
    });
</script>
<script type="text/javascript">

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

      $( "#province_id" ).select2({
        ajax: { 
          url: "{{route('province')}}",
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              _token: CSRF_TOKEN,
              search: params.term // search term
            };
          },
          processResults: function (response) {
            return {
              results: response
            };
          },
          cache: true
        }

      });

    });
</script>
<script type="text/javascript">

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

      $( "#bidang_id" ).select2({
        ajax: { 
          url: "{{route('bidang-kategori')}}",
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              _token: CSRF_TOKEN,
              search: params.term // search term
            };
          },
          processResults: function (response) {
            return {
              results: response
            };
          },
          cache: true
        }

      });

    });
</script>
@endsection