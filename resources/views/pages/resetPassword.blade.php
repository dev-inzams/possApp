@extends('pages.layout.app',['title'=>'Change Password'])
@section('content')

<section class="mt-5 content-middle w-50 mx-auto">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Change Password</h2>
            </div>
            <div class="card-body">
                <div class="form-group mt-3">
                    <label for="newPassword">New Password</label>
                    <input type="password" class="form-control" id="newPassword" placeholder="Enter new password">
                </div>
                <div class="form-group mt-3">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Enter confirm password">
                </div>
                <button onclick="changePassword()" type="submit" class="btn btn-primary mt-3">Change</button>
            </div>
        </div>
    </div>
</section>

<script>
    async function changePassword(){
        try{
           let newPassword = document.getElementById('newPassword').value
           let confirmPassword = document.getElementById('confirmPassword').value
           if( newPassword != confirmPassword){
               errorToast('Password and Confirm Password does not match')
           }else{
               showLoader();
               let res = await axios.post("/user-reset-password",{'password' : newPassword});
               hideLoader();
               if(res.data['status'] == 'success'){
                   successToast(res.data['message']);
                   setTimeout(() => {
                       window.location.href = "{{ route('dashboard') }}";
                   },1000);
               }else{
                   errorToast(res.data['message']);
               }
           }
        }catch(error){
            errorToast('Something went wrong')
        }

    }
</script>
@endsection
