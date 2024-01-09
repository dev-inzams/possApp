@extends('pages.layout.app',['title' => 'Login'])
@section('content')

<section class="mt-5 content-middle w-50 mx-auto">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Login</h2>
            </div>
            <div class="card-body">
                <div class="form-group mt-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button onclick="login()" type="submit" class="btn btn-primary mt-3">Login</button>
                <a href="{{ route('register') }}" class="btn btn-link btn-block mt-3">Register</a>
                <a href="{{ route('forgotPassword') }}" class="btn btn-link btn-block mt-3">Forgot Password</a>
            </div>
        </div>
    </div>
</section>

<script>
   async function login(){
        try{
            let email = document.getElementById('email').value
            let password = document.getElementById('password').value

            if(email == '' || password == ''){
                errorToast('All fields are required')
            }else{
                let postobj = {
                    'email' : email,
                    'password' : password
                }
                showLoader();
                let res = await axios.post("/user-login",postobj);
                hideLoader();
                if(res.data['status'] == 'success'){
                    successToast(res.data['message']);
                    window.location.href = "{{ route('dashboard') }}";

                }else{
                    errorToast(res.data['message']);
                }
            }

        }catch(e){
            console.log(e)
        } // end try
    } // end login function
</script>
@endSection
