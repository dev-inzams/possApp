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
                <label for="mobileNumber">Mobile</label>
                <input type="text" class="form-control" id="mobileNumber" placeholder="Enter Mobile Number">
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
    function register(){
        let firstName = document.getElementById('firstName').value
        let lastName = document.getElementById('lastName').value
        let email = document.getElementById('email').value
        let mobileNumber = document.getElementById('mobileNumber').value
        let password = document.getElementById('password').value
        let confirmPassword = document.getElementById('confirmPassword').value
        console.log(firstName,lastName,email,mobileNumber,password,confirmPassword)
    }
</script>
@endsection
