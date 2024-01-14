<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/preloader.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tostify.css') }}">
    <script src="{{ asset('js/preloader.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    {{-- data table css --}}
    <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
    <title>@yield('title')</title>
</head>

<body>
    <div id="overlay"></div>
    <div id="preloader">
        <div id="loader"></div>
    </div>

    <div class="delete-modal" id="deleteModal">
        <div class="delete-modal-content">
            <span class="delete-close-btn" onclick="deleteModalClose()">&times;</span>
            <h2>Delete Confirmation</h2>
            <p>Are you sure you want to delete this item?</p>
            <button onclick="deleteConfirm()" class="delete-modal-btn btn-danger" id="confirmDeleteBtn">Delete</button>
        </div>
    </div>



    @include('auth.layout.sidebar')
    @include('auth.layout.rightbar')
    <main>
        @yield('content')
    </main>
</div>

<script src="{{ asset('js/dashboard.js') }}"></script>

<script src="{{ asset('js/tostify.js') }}"></script>
<script src="{{ asset('js/dataTables.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    function deleteModal() {
        document.getElementById('deleteModal').style.display = 'block';
    }

    function deleteModalClose() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    // Open modal
    function openModal(){
        document.getElementById('customModal').style.display = 'block';
     }

    //  close modal
     function closeModal(){
        document.getElementById('customModal').style.display = 'none';
     }

</script>

</body>
</html>
