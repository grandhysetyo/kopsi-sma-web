@extends('layouts.leader')
@section('description','Sekolah')
@section('title','Sekolah')
@section('content')
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Sekolah
        </h2>
    </div>
    <div>
        @if(session('sukses'))
        <div class="alert alert-success alert-dismissible show flex items-center mb-2" role="alert">
            <i data-feather="smile" class="w-6 h-6 mr-2"></i> Berhasil memperbarui data
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="w-4 h-4"></i> </button>
        </div>
        @endif
        @if(session('selesaikan'))
        <div class="alert alert-danger alert-dismissible show flex items-center mb-2" role="alert">
            <i data-feather="x" class="w-6 h-6 mr-2"></i> Pastikan sudah diisi semua
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
                        Sekolah
                    </h2>
                </div>
                <div>
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                </div>
                <div id="input" class="p-5">
                    <form id="validate_form" method="POST" enctype="multipart/form-data" action="{{route('sekolah.leader.save')}}">
                        @method('PUT')
                        @csrf
                        <div class="preview">
                            <div>
                                <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                                <input id="nama_sekolah" name="nama_sekolah" type="text" required data-parsley-trigger="keyup" value="{{$sekolah->nama_sekolah}}" class="form-control" placeholder="Nama Sekolah">
                            </div>
                            <div class="mt-3">
                                <label for="npsn" class="form-label">NPSN</label>
                                <input id="npsn" name="npsn" type="number" required data-parsley-trigger="keyup" value="{{$sekolah->npsn}}" class="form-control" placeholder="NPSN">
                            </div>
                            <div class="mt-3">
                                <label for="telp_sekolah" class="form-label">Telp. Sekolah</label>
                                <input id="telp_sekolah" name="telp_sekolah" type="text" required data-parsley-trigger="keyup" value="{{$sekolah->telp_sekolah}}" class="form-control" placeholder="Telp">
                            </div>
                            <div class="mt-3">
                                <label for="status" class="form-label">Jenis Sekolah </label><span class="text-red-500">*</span>
                                <select class="form-select" required name="status">
                                    <option @if ($sekolah->status == 'N') selected @endif value="N">Negeri</option>
                                    <option @if ($sekolah->status == 'S') selected @endif value="S">Swasta</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="kelurahan_id" class="form-label">Kelurahan, Kecamatan, Kab/Kota, Provinsi (Cari berdasarkan kelurahan)</label>
                                <select required class="form-select mt-2 sm:mr-2" id="kelurahan_id" name="kelurahan_id" aria-label="Default select example">
                                    @if (!empty($sekolah->kelurahan_id))
                                        <option value="{{$sekolah->kelurahan_id}}">{{$sekolah->kelurahan->name}}, {{$sekolah->kelurahan->district->name}}, {{$sekolah->kelurahan->district->regency->name}}, {{$sekolah->kelurahan->district->regency->province->name}}</option>
                                        <option>Kelurahan</option>
                                    @else
                                        <option>Kelurahan</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="jalan" class="form-label">Alamat Jalan</label>
                                <input id="jalan" name="jalan" type="text" required data-parsley-trigger="keyup" value="{{$sekolah->jalan}}" class="form-control" placeholder="Jalan">
                            </div>
                            <div class="mt-3">
                                <label for="no_rmh" class="form-label">Nomor Rumah</label>
                                <input id="no_rmh" name="no_rmh" type="text" required data-parsley-trigger="keyup" value="{{$sekolah->no_rmh}}" class="form-control" placeholder="No. Rumah">
                            </div>
                            <div class="mt-3">
                                <label for="rt_rw" class="form-label">RT/RW</label>
                                <input id="rt_rw" name="rt_rw" type="text" required data-parsley-trigger="keyup" value="{{$sekolah->rt_rw}}" class="form-control rt_rw" placeholder="000/000">
                            </div>
                            <div class="mt-3">
                                <label for="kodepos" class="form-label">Kode Pos</label>
                                <input id="kodepos" name="kodepos" type="text" required data-parsley-trigger="keyup" value="{{$sekolah->kodepos}}" class="form-control" placeholder="Kode Pos">
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
    $(document).ready(function(){
      $('.rt_rw').mask('000/000');
     });
</script>
<script type="text/javascript">

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

      $( "#kelurahan_id" ).select2({
        ajax: { 
          url: "{{route('kelurahanss')}}",
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