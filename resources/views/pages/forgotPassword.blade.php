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
    async function forgotPassword(){
        try{
           let email = document.getElementById('email').value
           if(email == ''){
               errorToast('Email is required')
           }else{
               let postobj = {
                   'email' : email
               }
               showLoader();
               let res = await axios.post("/user-send-otp",postobj);
               hideLoader();
               if(res.data['status'] == 'success'){
                   successToast(res.data['message']);
                   sessionStorage.setItem('email',email);
                   setTimeout(() => {
                       window.location.href = "{{ route('otp') }}";
                   }, 1000);
               }else{
                   errorToast(res.data['message']);
               }
           }
        }catch(error){
            errorToast(error.message)
        }

    }
</script>
@endsection
