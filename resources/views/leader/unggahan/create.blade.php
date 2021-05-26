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
                        Unggahan
                    </h2>
                </div>
                <div id="input" class="p-5">
                    <form id="validate_form" method="POST" enctype="multipart/form-data" action="{{route('unggahan.store')}}">
                        @csrf
                        <div class="preview">
                            <div>
                                <label for="berkas_id" class="form-label">Berkas</label>
                                <select id="berkas_id" name="berkas_id" onchange="haha();" class="form-select">
                                    <option>Pilih</option>
                                    @foreach ($unggahan as $item)
                                        <option value="{{$item->id}}">{{$item->nama_berkas}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="input" id="label_input" class="form-label"></label>
                                <input id="inputs" name="input" type="hidden" required data-parsley-trigger="keyup" class="form-control" placeholder="Unggahan">
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
<script>
    function haha()
    {
        var id = document.getElementById("berkas_id").value;
        var urll = '{{ route("unggah", ":id") }}';
        urll = urll.replace(':id', id);
        $.ajax({
        type: 'GET',
        url: urll,
        dataType: 'json',
        success: function(data) {
            document.getElementById("inputs").type = data.type;
            if (data.type == 'file') {
                document.getElementById("label_input").innerHTML = `Unggahan ${data.nama_berkas} (PDF)`;
            } else {
                document.getElementById("label_input").innerHTML = `Unggahan ${data.nama_berkas}`;
            }
           
            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log('Gagal');
            
        }
        });
    }
</script>
@endsection