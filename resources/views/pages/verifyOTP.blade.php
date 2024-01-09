@extends('pages.layout.app',['title'=>'Verify OTP'])

@section('content')
<section class="mt-5 content-middle w-25 mx-auto">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Verify OTP</h2>
            </div>
            <div class="card-body">
                <div class="form-group mt-3">
                    <label for="otp">Enter 4-Digit OTP </label>
                    <input type="text" class="form-control" id="otp" placeholder="Enter 4-Digit OTP">
                </div>
                <button onclick="verifyOTP()" type="submit" class="btn btn-primary mt-3">Verify</button>
            </div>
        </div>
</section>
<script>
    async function verifyOTP(){
        try{
            let otp = document.getElementById('otp').value
            let email = sessionStorage.getItem('email');
            if(otp == ''){
                errorToast('OTP is required')
            }else{
                let postobj = {
                    'otp' : otp,
                    'email' : email
                };
                showLoader();
                let res = await axios.post("/user-verify-otp",postobj);
                hideLoader();
                if(res.data['status'] == 'success'){
                    successToast(res.data['message']);
                    sessionStorage.removeItem('email');
                    setTimeout(() => {
                        window.location.href = "{{ route('resetPassword') }}";
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
