@extends('layouts.admin')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
   Tambah Berkas {{$info->judul}}
</span>  

<button style="float: right" onclick="openModal()" class='bg-blue-500 text-white p-2 rounded text-l font-bold'>Tambah Berkas</button>
<div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
                style="background: rgba(0,0,0,.7);">
                <div
                    class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                    <div class="modal-content py-4 text-left px-6">
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-2xl font-bold">Tambah Berkas</p>
                            <div class="modal-close cursor-pointer z-50">
                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 18 18">
                                    <path
                                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <!--Body-->
                        <form action="{{route('lampiran.store', $info->id)}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="my-5">
                                <div class="flex flex-col w-full max-w-sm mx-auto p-4 bg-white">
                                    
                                    <div class="flex flex-col mb-4">
                                        <label for="name"
                                            class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                            Judul
                                        </label>
                                
                                        <div class="relative">

                                            <input id="judul"
                                                name="judul"
                                                type="text"
                                                placeholder="Judul"
                                                class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                
                                        </div>
                                    </div>  
                                    <div class="flex flex-col mb-4">
                                        <label for="name"
                                            class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                            Tipe
                                        </label>
                                
                                        <div class="relative">
                                            <select name="type" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                                <option value="0">Berkas</option>
                                                <option value="1">Tautan</option>
                                            </select>
                                
                                        </div>
                                    </div>
                                    <div class="flex flex-col mb-4">
                                        <label for="name"
                                            class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                            Berkas (Isi jika pilih tipe berkas)
                                        </label>
                                
                                        <div class="relative">

                                            <input id="file"
                                                name="berkas"
                                                type="file"
                                                placeholder="Mulai"
                                                class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                
                                        </div>
                                    </div> 
                                    <div class="flex flex-col mb-4">
                                        <label for="name"
                                            class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                            Tautan (Isi jika pilih tipe tautan)
                                        </label>
                                
                                        <div class="relative">

                                            <input id="url"
                                                name="url"
                                                type="url"
                                                placeholder="Tautan"
                                                class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                
                                        </div>
                                    </div>      
                                </div>
                            </div>
                            <!--Footer-->
                            <div class="flex justify-end pt-2">
                                <button
                                    class="focus:outline-none modal-close px-4 bg-gray-400 p-3 rounded-lg text-black hover:bg-gray-300">Cancel</button>
                                <button type="submit"
                                    class="focus:outline-none px-4 bg-blue-500 p-3 ml-3 rounded-lg text-white hover:bg-indigo-400">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="examples" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">id</th>
                            <th data-priority="2">Berkas</th>
                            <th data-priority="3">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    (function($) {
        $(document).ready(function(){
     $('#examples').DataTable({
      processing: true,
      stateSave: true,
      serverSide: true,
      responsive: true,
      ajax:{
       url: "{{ route('lampiran.index', $info->id) }}",
      },
      columns:[
        {
        data: 'judul',
        name: 'judul'
       },
       {
        data: 'file',
        name: 'file',
        searchable: false,
        orderable: false,
       },
       {
        data: 'edit',
        name: 'edit',
        searchable: false,
        orderable: false,
       }
       
      ]
     }).columns.adjust()
	.responsive.recalc();
    });  
    })(jQuery);
  
</script>
    <script>
		const modal = document.querySelector('.main-modal');
		const closeButton = document.querySelectorAll('.modal-close');

		const modalClose = () => {
			modal.classList.remove('fadeIn');
			modal.classList.add('fadeOut');
			setTimeout(() => {
				modal.style.display = 'none';
			}, 500);
		}

		const openModal = () => {
			modal.classList.remove('fadeOut');
			modal.classList.add('fadeIn');
			modal.style.display = 'flex';
		}

		for (let i = 0; i < closeButton.length; i++) {

			const elements = closeButton[i];

			elements.onclick = (e) => modalClose();

			modal.style.display = 'none';

			window.onclick = function (event) {
				if (event.target == modal) modalClose();
			}
		}
	</script>
@endsection

