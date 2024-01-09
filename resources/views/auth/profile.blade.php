@extends('auth.layout.app',['title'=> 'Profile'])
@section('content')

<main>
    <div class="header">
        <div class="left">
            <h1>Profile</h1>
            <ul class="breadcrumb">
                <li><a href="{{ route('dashboard') }}">
                        Dashboard
                    </a></li>
                /
                <li><a href="{{ route('profile') }}" class="active">profile</a></li>
            </ul>
        </div>
        <a href="#" class="report">
            <i class="bx bx-cloud-download"></i>
            <span>Download CSV</span>
        </a>
    </div>

    {{-- profile --}}
    <div class="profile mt-5">
        <label for="firstName">First Name</label>
        <input type="text" id="firstName" value="">

        <label for="lastName">Last Name</label>
        <input type="text" id="lastName" value="">

        <label for="email">Email</label>
        <input type="text" id="email" value="">

        <label for="mobileNumber">Mobile</label>
        <input type="text" id="mobileNumber" value="">

        <button onclick="updateProfile()">Update</button>
    </div>
</main>
<script>
    function updateProfile(){
        SuccessToast('Operation Failed!');
    }

</script>
@endsection
