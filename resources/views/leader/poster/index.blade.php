@extends('layouts.leader')
@section('description','Poster')
@section('title','Poster')
@section('content')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Poster') }}
</h2>  
@endsection  
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div class="p-6 bg-white border-b border-gray-200">
                @if (!poster(auth()->user()->ketua->tim->id))
                <form action="{{ route('poster.store') }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Poster
                                </label>
                        
                                <div class="relative">
                        
                                    <input
                                        id="poster"
                                        name="poster"
                                        required
                                        type="file"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                    <div class="flex justify-center pt-2">
                        <input type="submit"  value="Simpan" class="focus:outline-none px-4 bg-yellow-500 p-3 ml-3 rounded-lg text-white hover:bg-yellow-400">
                    </div>
    
                </form>
                @else
                <h3>Kamu hanya diperbolehkan unggah ulang 1 kali</h3>
                @if (count_poster(auth()->user()->ketua->tim->id) == 0)
                    <div class="m-5"><a type="button" href="{{route('poster.edit', $poster->id)}}"
                    class="focus:outline-none px-4 bg-yellow-500 p-3 ml-3 rounded-lg text-white hover:bg-yellow-400">Unggah Ulang</a></div>
                @else
                    <h3>Kamu sudah melakukan perubahan terakhir pada {{$poster->updated_at}}</h3>
                    
                @endif
               
                <div><embed style="width: 100%; height: 500px" class="embed-responsive-item" src="{{asset('uploads/'.$poster->poster)}}"></div>
                @endif
                
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
@endsection
