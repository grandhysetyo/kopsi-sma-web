@extends('layouts.juri')
@section('content')
@section('header')
@section('title','Dasbor')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Dashboard') }}
</h2>  
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                Selamat Datang {{Auth::user()->name}}
            </div>
        </div>
    </div>
</div>
@endsection