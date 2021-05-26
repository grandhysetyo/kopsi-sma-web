@extends('layouts.leader')
@section('description','Berkas')
@section('title','Berkas')
@section('content')
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Edit {{$berkas->berkasss->nama_surat}}
        </h2>
    </div>
    <div>
        @if(session('gagal'))
            <div class="alert alert-danger-soft show flex items-center mb-2" role="alert"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i>Berkas dengan jenis yang sama sudah ada </div>
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
                        Edit
                    </h2>
                </div>
                <div id="input" class="p-5">
                    <form id="validate_form" method="POST" enctype="multipart/form-data" action="{{route('berkas.update', $berkas->id)}}">
                        @method('PUT')
                        @csrf
                        <div class="preview">
                            <div>
                                <label for="berkas" class="form-label">Berkas</label>
                                <input id="berkas" name="berkas" type="file" required data-parsley-trigger="keyup" class="form-control" placeholder="Surat Tugas">
                            </div>
                        </div>
                        <div>
                            @if (empty($berkas->berkas))
                                <a type="button" class="btn btn-danger mt-5 w-full">Belum Ada Surat Yang Diunggah</a>
                            @else
                                <a type="button" href="{{asset('uploads/'.$berkas->berkas)}}" class="btn btn-success mt-5 w-full">Buka Surat Yang Sudah Diunggah</a>
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
@endsection