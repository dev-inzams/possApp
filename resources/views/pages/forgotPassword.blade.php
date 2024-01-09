@extends('pages.layout.app',['title'=>'Forgot Password'])
@section('content')

<section class="mt-5 content-middle w-50 mx-auto">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Forgot Password</h2>
            </div>
            <div class="card-body">
                <div class="form-group mt-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email">
                </div>
                <button onclick="forgotPassword()" type="submit" class="btn btn-primary mt-3">Sent OTP</button>
            </div>
        </div>
    </div>
</section>
<script>
    function forgotPassword(){
        let email = document.getElementById('email').value
        console.log(email)
    }
</script>
@endsection
