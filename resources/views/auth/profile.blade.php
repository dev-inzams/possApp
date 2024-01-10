@extends('auth.layout.app',['title'=> 'Profile'])
@section('content')


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
        <input readonly type="email" id="email" value="">

        <label for="phoneNumber">Phone Number</label>
        <input type="text" id="phoneNumber" value="">

        <button onclick="updateProfile()">Update</button>
    </div>

<script>
    getProfile();
    async function getProfile() {
        showLoader();
        let res = await axios.post('/user-profile');
        hideLoader();
        if (res.data['status'] == 'success') {
            let data = res.data['data'];
            document.getElementById('firstName').value = data['firstName'];
            document.getElementById('lastName').value = data['lastName'];
            document.getElementById('email').value = data['email'];
            document.getElementById('phoneNumber').value = data['phoneNumber'];
        }else{
            errorToast(res.data['message']);
        }
    }

    async function updateProfile(){
        try{
            let firstName = document.getElementById('firstName').value
            let lastName = document.getElementById('lastName').value
            let phoneNumber = document.getElementById('phoneNumber').value
            if(firstName == '' || lastName == '' || email == '' || phoneNumber == ''){
                errorToast('All fields are required')
            }else{
                let postobj = {
                    'firstName' : firstName,
                    'lastName' : lastName,
                    'phoneNumber' : phoneNumber
                }
                showLoader();
                let res = await axios.post("/update-profile",postobj);
                hideLoader();
                if(res.data['status'] == 'success'){
                    successToast(res.data['message']);
                }
            }
        }catch(error){
            errorToast(error.message)
        }
    }
</script>
@endsection
