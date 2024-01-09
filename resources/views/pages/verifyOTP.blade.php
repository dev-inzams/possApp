@extends('pages.layout.app',['title'=>'Verify OTP'])

@section('content')
<section class="mt-5 content-middle w-50 mx-auto">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Verify OTP</h2>
            </div>
            <div class="card-body">
                <div class="form-group mt-3">
                    <label for="otp">OTP</label>
                    <input type="text" class="form-control" id="otp" placeholder="Enter 4-Digit OTP">
                </div>
                <button onclick="verifyOTP()" type="submit" class="btn btn-primary mt-3">Verify</button>
            </div>
        </div>
</section>
<script>
    function verifyOTP(){
        let otp = document.getElementById('otp').value
        console.log(otp)
    }
</script>
@endsection
