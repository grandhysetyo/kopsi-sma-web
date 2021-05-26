@extends('layouts.leader')
@section('description','Pembimbing')
@section('title','Pembimbing')
@section('content')
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Pembimbing
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
                        Pembimbing
                    </h2>
                </div>
                <div>
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                </div>
                <div id="input" class="p-5">
                    <form id="validate_form" method="POST" enctype="multipart/form-data" action="{{route('pembimbing.leader.save')}}">
                        @method('PUT')
                        @csrf
                        <div class="preview">
                            <div>
                                <label for="nama" class="form-label">Nama</label>
                                <input id="nama" name="nama" type="text" required data-parsley-trigger="keyup" value="{{$pembimbing->nama}}" class="form-control" placeholder="Nama">
                            </div>
                            <div class="mt-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin </label><span class="text-red-500">*</span>
                                <select class="form-select" required name="jenis_kelamin">
                                    <option @if ($pembimbing->jenis_kelamin == 'L') selected @endif value="L">Laki-Laki</option>
                                    <option @if ($pembimbing->jenis_kelamin == 'P') selected @endif value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input id="tempat_lahir" name="tempat_lahir" type="text" required data-parsley-trigger="keyup" value="{{$pembimbing->tempat_lahir}}" class="form-control" placeholder="Tempat Lahir">
                            </div>
                            <div class="mt-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input id="tanggal_lahir" name="tanggal_lahir" type="date" required data-parsley-trigger="keyup" value="{{$pembimbing->tanggal_lahir}}" class="form-control" placeholder="Tanggal Lahir">
                            </div>
                            <div class="mt-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input id="nik" name="nik" type="number" value="{{$pembimbing->nik}}" class="form-control" required data-parsley-minlength="16" data-parsley-type="integer" data-parsley-trigger="keyup" placeholder="NIK">
                            </div>
                            <div class="mt-3">
                                <label for="no_telp" class="form-label">Nomor HP (Whatsapp)</label>
                                <input id="no_telp" name="no_telp" type="text" required data-parsley-trigger="keyup" value="{{$pembimbing->no_telp}}" class="form-control" placeholder="Nomor HP">
                            </div>
                            <div class="mt-3">
                                <label for="nuptk" class="form-label">NUPTK</label>
                                <input id="nuptk" name="nuptk" type="number" value="{{$pembimbing->nuptk}}" class="form-control" placeholder="NUPTK">
                            </div>
                            <div class="mt-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input id="nip" name="nip" type="number" value="{{$pembimbing->nip}}" class="form-control" placeholder="NIP">
                            </div>
                            <div class="mt-3">
                                <label for="jalan" class="form-label">Alamat Jalan</label>
                                <input id="jalan" name="jalan" type="text" required data-parsley-trigger="keyup" value="{{$pembimbing->jalan}}" class="form-control" placeholder="Jalan">
                            </div>
                            <div class="mt-3">
                                <label for="no_rmh" class="form-label">Nomor Rumah</label>
                                <input id="no_rmh" name="no_rmh" type="text" required data-parsley-trigger="keyup" value="{{$pembimbing->no_rmh}}" class="form-control" placeholder="No. Rumah">
                            </div>
                            <div class="mt-3">
                                <label for="rt_rw" class="form-label">RT/RW</label>
                                <input id="rt_rw" name="rt_rw" type="text" required data-parsley-trigger="keyup" value="{{$pembimbing->rt_rw}}" class="form-control rt_rw" placeholder="000/000">
                            </div>
                            <div class="mt-3">
                                <label for="kodepos" class="form-label">Kode Pos</label>
                                <input id="kodepos" name="kodepos" type="text" required data-parsley-trigger="keyup" value="{{$pembimbing->kodepos}}" class="form-control" placeholder="Kode Pos">
                            </div>
                            <div class="mt-3">
                                <label for="kelurahan_id" class="form-label">Kelurahan, Kecamatan, Kab/Kota, Provinsi (Cari berdasarkan kelurahan)</label>
                                <select required class="form-select mt-2 sm:mr-2" id="kelurahan_id" name="kelurahan_id" aria-label="Default select example">
                                    @if (!empty($pembimbing->kelurahan_id))
                                        <option value="{{$pembimbing->kelurahan_id}}">{{$pembimbing->kelurahan->name}}, {{$pembimbing->kelurahan->district->name}}, {{$pembimbing->kelurahan->district->regency->name}}, {{$pembimbing->kelurahan->district->regency->province->name}}</option>
                                        <option></option>
                                    @else
                                        <option></option>
                                    @endif
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="surat_kepsek" class="form-label">Surat Tugas dari Kepala Sekolah (PDF dan maksimal 2MB)</label>
                                <input id="surat_kepsek" name="surat_kepsek" type="file" class="form-control" placeholder="Surat Tugas">
                            </div>
                            
                        </div>
                        <div>
                            @if (empty($pembimbing->surat_kepsek))
                                <a type="button" class="btn btn-danger mt-5 w-full">Belum Ada Surat Yang Diunggah</a>
                            @else
                                <a type="button" href="{{asset('uploads/'.$pembimbing->surat_kepsek)}}" class="btn btn-success mt-5 w-full">Buka Surat Yang Sudah Diunggah</a>
                            @endif
                           
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