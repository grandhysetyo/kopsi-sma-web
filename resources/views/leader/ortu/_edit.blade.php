@extends('layouts.leader')
@section('description','Orang Tua')
@section('title','Orang Tua')
@section('content')
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Orang Tua {{$ortu->ketua->user->name}}
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
    <div>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    </div>
    
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Input -->
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Orang Tua
                    </h2>
                </div>
                <div>
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                </div>
                <div id="input" class="p-5">
                    <form id="validate_form" method="POST" enctype="multipart/form-data" action="{{route('ortu.leader.save')}}">
                        @method('PUT')
                        @csrf
                        <div class="preview">
                            <div>
                                <label for="nama_ibu_kandung" class="form-label">Nama Ibu Kandung</label>
                                <input id="nama_ibu_kandung" name="nama_ibu_kandung" type="text" required data-parsley-trigger="keyup" value="{{$ortu->nama_ibu_kandung}}" class="form-control" placeholder="Nama Ibu Kandung">
                            </div>
                            <div class="mt-3">
                                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                <input id="nama_ibu" name="nama_ibu" type="text" required data-parsley-trigger="keyup" value="{{$ortu->nama_ibu}}" class="form-control" placeholder="Nama Ibu">
                            </div>
                            <div class="mt-3">
                                <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                                <input id="pekerjaan_ibu" name="pekerjaan_ibu" type="text" required data-parsley-trigger="keyup" value="{{$ortu->pekerjaan_ibu}}" class="form-control" placeholder="Pekerjaan Ibu">
                            </div>
                            <div class="mt-3">
                                <label for="pendidikan_terakhir_ibu" class="form-label">Pendidikan Terakhir Ibu</label>
                                <input id="pendidikan_terakhir_ibu" name="pendidikan_terakhir_ibu" type="text" required data-parsley-trigger="keyup" value="{{$ortu->pendidikan_terakhir_ibu}}" class="form-control" placeholder="Pendidikan Terakhir Ibu">
                            </div>
                            <div class="mt-3">
                                <label for="nohp_ibu" class="form-label">Nomor HP Ibu</label>
                                <input id="nohp_ibu" name="nohp_ibu" type="text" required data-parsley-trigger="keyup" value="{{$ortu->nohp_ibu}}" class="form-control" placeholder="Nomor HP Ibu">
                            </div>
                            <div class="mt-3">
                                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                <input id="nama_ayah" name="nama_ayah" type="text" required data-parsley-trigger="keyup" value="{{$ortu->nama_ayah}}" class="form-control" placeholder="Nama Ayah">
                            </div>
                            <div class="mt-3">
                                <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                                <input id="pekerjaan_ayah" name="pekerjaan_ayah" type="text" required data-parsley-trigger="keyup" value="{{$ortu->pekerjaan_ayah}}" class="form-control" placeholder="Pekerjaan Ayah">
                            </div>
                            <div class="mt-3">
                                <label for="pendidikan_terakhir_ayah" class="form-label">Pendidikan Terakhir Ayah</label>
                                <input id="pendidikan_terakhir_ayah" name="pendidikan_terakhir_ayah" type="text" required data-parsley-trigger="keyup" value="{{$ortu->pendidikan_terakhir_ayah}}" class="form-control" placeholder="Pendidikan Terakhir Ayah">
                            </div>
                            <div class="mt-3">
                                <label for="nohp_ayah" class="form-label">Nomor HP Ayah</label>
                                <input id="nohp_ayah" name="nohp_ayah" type="text" required data-parsley-trigger="keyup" value="{{$ortu->nohp_ayah}}" class="form-control" placeholder="Nomor HP Ayah">
                            </div>
                            <div class="mt-3">
                                <label for="jalan" class="form-label">Alamat Jalan</label>
                                <input id="jalan" name="jalan" type="text" required data-parsley-trigger="keyup" value="{{$ortu->jalan}}" class="form-control" placeholder="Jalan">
                            </div>
                            <div class="mt-3">
                                <label for="no_rmh" class="form-label">Nomor Rumah</label>
                                <input id="no_rmh" name="no_rmh" type="text" required data-parsley-trigger="keyup" value="{{$ortu->no_rmh}}" class="form-control" placeholder="No. Rumah">
                            </div>
                            <div class="mt-3">
                                <label for="rt_rw" class="form-label">RT/RW</label>
                                <input id="rt_rw" name="rt_rw" type="text" required data-parsley-trigger="keyup" value="{{$ortu->rt_rw}}" class="form-control rt_rw" placeholder="000/000">
                            </div>
                            <div class="mt-3">
                                <label for="kodepos" class="form-label">Kode Pos</label>
                                <input id="kodepos" name="kodepos" type="text" required data-parsley-trigger="keyup" value="{{$ortu->kodepos}}" class="form-control" placeholder="Kode Pos">
                            </div>
                            <div class="mt-3">
                                <label for="kelurahan_id" class="form-label">Kelurahan, Kecamatan, Kab/Kota, Provinsi (Cari berdasarkan kelurahan)</label>
                                <select required class="form-select mt-2 sm:mr-2" id="kelurahan_id" name="kelurahan_id" aria-label="Default select example">
                                    @if (!empty($ortu->kelurahan_id))
                                        <option value="{{$ortu->kelurahan_id}}">{{$ortu->kelurahan->name}}, {{$ortu->kelurahan->district->name}}, {{$ortu->kelurahan->district->regency->name}}, {{$ortu->kelurahan->district->regency->province->name}}</option>
                                        <option></option>
                                    @else
                                        <option></option>
                                    @endif
                                </select>
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