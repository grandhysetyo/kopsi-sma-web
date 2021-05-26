@extends('layouts.leader')
@section('description','Biodata')
@section('title','Biodata')
@section('content')
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Biodata
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
                        Biodata
                    </h2>
                </div>
                <div id="input" class="p-5">
                    <form id="validate_form" method="POST" enctype="multipart/form-data" action="{{route('biodata.leader.save')}}">
                        @method('PUT')
                        @csrf
                        <div class="preview">
                            <div>
                                @if (empty($ketua->foto))
                                <img style="height: 200px;width: 200px; object-fit: cover" alt="{{$ketua->nisn}}" class="rounded-full" src="{{asset('dist/images/profile-2.jpg')}}">
                                @else
                                <img style="height: 200px;width: 200px; object-fit: cover" alt="{{$ketua->nisn}}" class="rounded-full" src="{{asset('uploads/'.$ketua->foto)}}">
                                @endif
                               
                            </div>
                            <div>
                                <label for="nisn" class="form-label">NISN</label>
                                <input id="nisn" type="text" disabled value="{{$ketua->nisn}}" class="form-control" placeholder="NSIN">
                            </div>
                            <div class="mt-3">
                                <label for="kode" class="form-label">Kode Refferal</label>
                                <input id="kode" type="text" disabled value="{{$ketua->kode}}" class="form-control" placeholder="Kode">
                            </div>
                            <div class="mt-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input id="nik" name="nik" type="number" value="{{$ketua->nik}}" class="form-control" required data-parsley-minlength="16" data-parsley-type="integer" data-parsley-trigger="keyup" placeholder="NIK">
                            </div>
                            <div class="mt-3">
                                <label for="kip" class="form-label">KIP (Jika Ada)</label>
                                <input id="kip" name="kip" type="number" value="{{$ketua->kip}}" class="form-control" placeholder="KIP">
                            </div>
                            <div class="mt-3">
                                <label for="kip" class="form-label">Jenis Kelamin </label><span class="text-red-500">*</span>
                                <select class="form-select" required name="jenis_kelamin">
                                    <option @if ($ketua->jenis_kelamin == 'L') selected @endif value="L">Laki-Laki</option>
                                    <option @if ($ketua->jenis_kelamin == 'P') selected @endif value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="agama" class="form-label">Agama</label>
                                <input id="agama" name="agama" type="text" required data-parsley-trigger="keyup" value="{{$ketua->agama}}" class="form-control" placeholder="Agama">
                            </div>
                            <div class="mt-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input id="tempat_lahir" name="tempat_lahir" type="text" required data-parsley-trigger="keyup" value="{{$ketua->tempat_lahir}}" class="form-control" placeholder="Tempat Lahir">
                            </div>
                            <div class="mt-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input id="tanggal_lahir" name="tanggal_lahir" type="date" required data-parsley-trigger="keyup" value="{{$ketua->tanggal_lahir}}" class="form-control" placeholder="Tanggal Lahir">
                            </div>
                            <div class="mt-3">
                                <label for="nohp" class="form-label">Nomor HP (Whatsapp)</label>
                                <input id="nohp" name="nohp" type="text" required data-parsley-trigger="keyup" value="{{$ketua->nohp}}" class="form-control" placeholder="Nomor HP">
                            </div>
                            <div class="mt-3">
                                <label for="kelas" class="form-label">Kelas </label><span class="text-red-500">*</span>
                                <select class="form-select" required name="kelas">
                                    <option @if ($ketua->kelas == 10) selected @endif value="10">10</option>
                                    <option @if ($ketua->kelas == 11) selected @endif value="11">11</option>
                                    <option @if ($ketua->kelas == 12) selected @endif value="12">12</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="jalan" class="form-label">Alamat Jalan</label>
                                <input id="jalan" name="jalan" type="text" required data-parsley-trigger="keyup" value="{{$ketua->jalan}}" class="form-control" placeholder="Jalan">
                            </div>
                            <div class="mt-3">
                                <label for="no_rmh" class="form-label">Nomor Rumah</label>
                                <input id="no_rmh" name="no_rmh" type="text" required data-parsley-trigger="keyup" value="{{$ketua->no_rmh}}" class="form-control" placeholder="No. Rumah">
                            </div>
                            <div class="mt-3">
                                <label for="rt_rw" class="form-label">RT/RW</label>
                                <input id="rt_rw" name="rt_rw" type="text" required data-parsley-trigger="keyup" value="{{$ketua->rt_rw}}" class="form-control rt_rw" placeholder="000/000">
                            </div>
                            <div class="mt-3">
                                <label for="kodepos" class="form-label">Kode Pos</label>
                                <input id="kodepos" name="kodepos" type="text" required data-parsley-trigger="keyup" value="{{$ketua->kodepos}}" class="form-control" placeholder="Kode Pos">
                            </div>
                            <div class="mt-3">
                                <label for="kelurahan_id" class="form-label">Kelurahan, Kecamatan, Kab/Kota, Provinsi (Cari berdasarkan kelurahan)</label>
                                <select required class="form-select mt-2 sm:mr-2" id="kelurahan_id" name="kelurahan_id" aria-label="Default select example">
                                    @if (!empty($ketua->kelurahan_id))
                                        <option value="{{$ketua->kelurahan_id}}">{{$ketua->kelurahan->name}}, {{$ketua->kelurahan->district->name}}, {{$ketua->kelurahan->district->regency->name}}, {{$ketua->kelurahan->district->regency->province->name}}</option>
                                        <option>Kelurahan</option>
                                    @else
                                        <option>Kelurahan</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input id="foto" name="foto" type="file" class="form-control" placeholder="Kode Pos">
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