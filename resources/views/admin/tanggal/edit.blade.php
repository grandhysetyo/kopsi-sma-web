@extends('layouts.admin')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Edit Tanggal {{$tanggal->title}}
</span>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{route('tanggal.update', $tanggal->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Judul
                                </label>
                        
                                <div class="relative">
                        
                                    
                        
                                    <input id="name"
                                        value="{{$tanggal->title}}"
                                        name="title"
                                        type="text"
                                        placeholder="judul"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Mulai
                                </label>
                        
                                <div class="relative">
                        
                                    <input id="start"
                                        name="start"
                                        type="date"
                                        value="{{$tanggal->start}}"
                                        placeholder="Judul"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Selesai (Kosongi Jika Satu Hari)
                                </label>
                        
                                <div class="relative">
                        
                                    <input id="end"
                                        name="end"
                                        type="date"
                                        value="{{$tanggal->end}}"
                                        placeholder="Judul"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Linimasa
                                </label>
                        
                                <div class="relative">
                        
                                    
    
                                    <select name="linimasa_id" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                        @foreach ($linimasa as $item)
                                            @if($item->id==$tanggal->linimasa_id)
                                            <option value={{$item->id}} selected='selected' >{{$item->title}}</option>
                                            @else
                                            <option value={{$item->id}}>{{$item->title}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                        
                                </div>
                            </div>
                            
                            
                            
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="flex justify-center pt-2">
                        <button type="submit"
                            class="focus:outline-none px-4 bg-indigo-500 p-3 ml-3 rounded-lg text-white hover:bg-indigo-400">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection