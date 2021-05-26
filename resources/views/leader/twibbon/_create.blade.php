@extends('layouts.leader')
@section('description','Unggahan')
@section('title','Unggahan')
@section('content')
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Twibbon
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
                        Twibbon
                    </h2>
                </div>
                <div id="input" class="p-5">
                    <div class="flex flex-wrap -mx-4 overflow-hidden sm:-mx-2 md:-mx-2 lg:-mx-2 xl:-mx-2">

                        <div class="my-4 px-4 w-1/2 overflow-hidden sm:my-2 sm:px-2 sm:w-full md:my-2 md:px-2 md:w-full lg:my-2 lg:px-2 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                            <div id="upload-demo"></div>
                        </div>
                      
                        <div class="my-4 px-4 w-1/2 overflow-hidden sm:my-2 sm:px-2 sm:w-full md:my-2 md:px-2 md:w-full lg:my-2 lg:px-2 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2">
                            <div id="preview-crop-image" style="background:#9d9d9d;width:600px;padding:50px 50px;height:600px;"></div>
                        </div>
                      </div>
                      <div class="mt-3">
                        <label for="image" class="form-label">Foto</label>
                        <input type="file" id="image" class="form-control">
                    </div>
                    <div>
                        <button class="upload-image btn btn-primary mt-5 w-full">Simpan</button>
                    </div>
                    
                </div>
            </div>
            <!-- END: Input -->
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
<script type="text/javascript">
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    var resize = $('#upload-demo').croppie({
        enableExif: true,
        enableOrientation: true,    
        viewport: { // Default { width: 100, height: 100, type: 'square' } 
            width: 600,
            height: 600,
            type: 'square' //square
        },
        boundary: {
            width: 600,
            height: 600
        }
    });
    $('#image').on('change', function () { 
      var reader = new FileReader();
        reader.onload = function (e) {
          resize.croppie('bind',{
            url: e.target.result
          }).then(function(){
            console.log('jQuery bind complete');
          });
        }
        reader.readAsDataURL(this.files[0]);
    });
    $('.upload-image').on('click', function (ev) {
      resize.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function (img) {
        $.ajax({
          url: "{{route('twibbonice.store')}}",
          type: "POST",
          data: {"foto":img},
          success: function (data) {
            html = '<img src="' + img + '" />';
            $("#preview-crop-image").html(html);
            if (data.status == 3) {
                window.location.href = '{{route('twibbonice.index')}}';
            } else {
                window.location.href = '{{route('twibbonice-member.index')}}';
            }
          }
        });
      });
    });
    </script>
@endsection