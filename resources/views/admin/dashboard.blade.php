@extends('layouts.admin')
@section('content')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Dashboard') }}
</h2>  
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
              <div class="card">
                <h4>Persebaran Peserta KSN</h4>
                  
                  <a type="button" href="#"
                            class="focus:outline-none px-4 bg-blue-500 p-3 mt-3 rounded-lg text-white hover:bg-blue-400">Buka disini</a>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection