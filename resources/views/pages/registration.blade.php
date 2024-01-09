@extends('pages.layout.app',['title'=>'Registration'])
@section('content')
<section class="mt-5">
    <div class="container">
        <h2>Registration</h2>
            <div class="form-group mt-3">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" placeholder="Enter first name">
            </div>
            <div class="form-group mt-3">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" placeholder="Enter last name">
            </div>
            <div class="form-group mt-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email">
            </div>
            <div class="form-group mt-3">
                <label for="mobileNumber">Phone Number</label>
                <input type="text" class="form-control" id="phoneNumber" placeholder="Enter Mobile Number">
            </div>
            <div class="form-group mt-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-group mt-3">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" placeholder="Password">
            </div>
            <button onclick="register()" type="submit" class="btn btn-primary mt-3">Register</button>
    </div>
</section>
<script>
   async function register(){
        try{
            let firstName = document.getElementById('firstName').value
            let lastName = document.getElementById('lastName').value
            let email = document.getElementById('email').value
            let phoneNumber = document.getElementById('phoneNumber').value
            let password = document.getElementById('password').value
            let confirmPassword = document.getElementById('confirmPassword').value
            if(password != confirmPassword){
                errorToast('Password and Confirm Password does not match');
            }else{
                let postobj = {
                    'firstName' : firstName,
                    'lastName' : lastName,
                    'email' : email,
                    'phoneNumber' : phoneNumber,
                    'password' : password
                };
                showLoader();
                let res = await axios.post("/user-register",postobj);
                hideLoader();
                if(res.data['status'] == 'success'){
                    successToast(res.data['message']);
                    setTimeout(() => {
                        window.location.href = "{{ route('login') }}";
                    }, 1000);
                }else{
                    errorToast(res.data['message']);
                }
            }
        }catch(e){
            errorToast('Invalid Credentials')
        }

    }
</script>
@endsection
