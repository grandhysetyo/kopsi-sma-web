@extends('layouts.leader')
@section('content')
@section('title','Twibbonice')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Twibbonice') }}
</h2>  
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div>
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Foto
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="image"
                                        type="file"
                                        required data-parsley-trigger="keyup"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <div id="upload-demo"></div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <div id="preview-crop-image" style="background:#9d9d9d;width:600px;padding:50px 50px;height:600px;"></div>
                            </div>
                            
                            
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="flex justify-center pt-2">
                        <button
                            class="upload-image focus:outline-none px-4 bg-yellow-500 p-3 ml-3 rounded-lg text-white hover:bg-yellow-400">Simpan</button>
                    </div>
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
            width: 1000,
            height: 1000,
            type: 'square' //square
        },
        boundary: {
            width: 1000,
            height: 1000
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
        type: "canvas",
        size: "original",
        format: "png", 
        quality: 1
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