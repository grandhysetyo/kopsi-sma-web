<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.1.0/dist/chart.min.js"></script>

        @yield('style')
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <script src="{{asset('superadmin/js/jquery.min.js')}}"></script>
        <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
        <!--Responsive Extension Datatables CSS-->
        <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
        <link href="//cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <script src="//cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script src="//parsleyjs.org/dist/parsley.js"></script>
        <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script src="{{ asset('js/select2.min.js') }}" defer></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
        @stack('styles')
        <style>
            /*Overrides for Tailwind CSS */
            /*Form fields*/
            
            .dataTables_wrapper select,
            .dataTables_wrapper .dataTables_filter input {
                color: #4a5568;
                /*text-gray-700*/
                padding-left: 1rem;
                /*pl-4*/
                padding-right: 1rem;
                /*pl-4*/
                padding-top: .5rem;
                /*pl-2*/
                padding-bottom: .5rem;
                /*pl-2*/
                line-height: 1.25;
                /*leading-tight*/
                border-width: 2px;
                /*border-2*/
                border-radius: .25rem;
                border-color: #edf2f7;
                /*border-gray-200*/
                background-color: #edf2f7;
                /*bg-gray-200*/
            }
            /*Row Hover*/
            
            table.dataTable.hover tbody tr:hover,
            table.dataTable.display tbody tr:hover {
                background-color: #ebf4ff;
                /*bg-indigo-100*/
            }
            /*Pagination Buttons*/
            
            .dataTables_wrapper .dataTables_paginate .paginate_button {
                font-weight: 700;
                /*font-bold*/
                border-radius: .25rem;
                /*rounded*/
                border: 1px solid transparent;
                /*border border-transparent*/
            }
            /*Pagination Buttons - Current selected */
            
            .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                color: #fff !important;
                /*text-white*/
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
                /*shadow*/
                font-weight: 700;
                /*font-bold*/
                border-radius: .25rem;
                /*rounded*/
                background: #667eea !important;
                /*bg-indigo-500*/
                border: 1px solid transparent;
                /*border border-transparent*/
            }
            /*Pagination Buttons - Hover */
            
            .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
                color: #fff !important;
                /*text-white*/
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
                /*shadow*/
                font-weight: 700;
                /*font-bold*/
                border-radius: .25rem;
                /*rounded*/
                background: #667eea !important;
                /*bg-indigo-500*/
                border: 1px solid transparent;
                /*border border-transparent*/
            }
            /*Add padding to bottom border */
            
            table.dataTable.no-footer {
                border-bottom: 1px solid #e2e8f0;
                /*border-b-1 border-gray-300*/
                margin-top: 0.75em;
                margin-bottom: 0.75em;
            }
            /*Change colour of responsive icon*/
            
            table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
            table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
                background-color: #667eea !important;
                /*bg-indigo-500*/
            }
        </style>
        <style>
            input.parsley-success,
            select.parsley-success,
            textarea.parsley-success {
              color: #468847;
              background-color: #DFF0D8;
              border: 1px solid #D6E9C6;
            }
          
            input.parsley-error,
            select.parsley-error,
            textarea.parsley-error {
              color: #B94A48;
              background-color: #F2DEDE;
              border: 1px solid #EED3D7;
            }
          
            .parsley-errors-list {
              margin: 2px 0 3px;
              padding: 0;
              list-style-type: none;
              font-size: 0.9em;
              line-height: 0.9em;
              opacity: 0;
          
              transition: all .3s ease-in;
              -o-transition: all .3s ease-in;
              -moz-transition: all .3s ease-in;
              -webkit-transition: all .3s ease-in;
            }
          
            .parsley-errors-list.filled {
              opacity: 1;
            }
            
            .parsley-type, .parsley-required, .parsley-equalto, .parsley-pattern, .parsley-length{
             color:#ff0000;
            }
            
        </style>
        <style>
            .animated {
                -webkit-animation-duration: 1s;
                animation-duration: 1s;
                -webkit-animation-fill-mode: both;
                animation-fill-mode: both;
            }
        
            .animated.faster {
                -webkit-animation-duration: 500ms;
                animation-duration: 500ms;
            }
        
            .fadeIn {
                -webkit-animation-name: fadeIn;
                animation-name: fadeIn;
            }
        
            .fadeOut {
                -webkit-animation-name: fadeOut;
                animation-name: fadeOut;
            }
        
            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
        
                to {
                    opacity: 1;
                }
            }
        
            @keyframes fadeOut {
                from {
                    opacity: 1;
                }
        
                to {
                    opacity: 0;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.nav_juri')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
            });
        });
        </script>
        @yield('script')
        @stack('scripts')
        
    </body>
    
</html>
