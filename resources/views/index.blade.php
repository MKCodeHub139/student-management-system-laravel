<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css', 'resources/js/app.js')
    <title>@yield('title')</title>
   @yield('styles')
</head>
<body>
    
    <!-- You can open the modal using ID.showModal() method -->
    {{-- long modal --}}
    <dialog id="my_modal_4" class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <form method="dialog">
                <button class="btn float-end">Close</button>
            </form>
            <div class="myForm">
              {{-- @include('teacherForm') --}}
             </div> 

        </div>
    </dialog>
    {{-- short modal --}}
    <!-- Open the modal using ID.showModal() method -->
<dialog id="my_modal_1" class="modal">
  <div class="modal-box">
    <p class="py-4">Are you sure you want to delete this Student !</p>
    <div class="modal-action">
      <form method="dialog">
        <!-- if there is a button in form, it will close the modal -->
        <button class="btn">Close</button>
      </form>
      <button class="delete-btn bg-red-300 hover:bg-red-400 btn">Delete</button>
    </div>
  </div>
</dialog>
    {{--  modal with x icon--}}
    <!-- You can open the modal using ID.showModal() method -->
<dialog id="my_modal_3" class="modal">
  <div class="modal-box">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
      
    <div class="courseForm">
      {{-- @include('components.view-attendance-history') --}}
    </div>
      {{-- <form method="dialog" class="">
              <button class="btn px-3 py-1 rounded-xl border-1">Cancel</button>
      </form> --}}
  </div>
</dialog>
    {{--  --}}
    
    <div class="main flex">
        <div class="sidebar w-[22%]">
            @include('components.sidebar')
        </div>
        <div class="w-[78%]">
         @include('components.nav')
            <div class="content bg-gray-50  p-5">

              @yield('main')
            </div>
        </div>
    </div>
    
    {{-- jquery cdn --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    {{-- datatable --}}
    <script src="https://cdn.datatables.net/2.3.5/js/dataTables.min.js"></script>
    {{-- SweerAlert 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    </script>
    @yield('scripts')
</body>
</html>