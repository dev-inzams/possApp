@extends('auth.layout.app',['title' => 'Customers'])
@section('content')


{{-- update modal --}}
<div class="modal" id="customModal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2>Update Customer</h2>
        <input type="text" id="name">
        <input type="text" id="email">
        <input type="text" id="phone">
        <button class="btn" id="update" onclick="updateCustomer()">Update</button>
    </div>
</div>






<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class="bx bx-receipt"></i>
            <h3>Categories</h3>
            <i class="bx bx-filter"></i>
            <i class="bx bx-search"></i>
        </div>
        <table class="table" id="tableData">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tableList">

            </tbody>
        </table>
    </div>
    <div class="reminders">
        <div class="header">
            <i class="bx bx-note"></i>
            <h3>Add New Customer</h3>
            <i class="bx bx-filter"></i>
            <i class="bx bx-plus"></i>
        </div>

        <div class="task-list">
            <input type="text" id="newName" placeholder="Full Name">
            <input type="email" id="newEmail" placeholder="Email">
            <input type="text" id="newPhone" placeholder="Phone">

            <button onclick="addCustomer()" type="submit">Add Customer</button>
        </div>
    </div>
</div>
<script>
    // get customers list
    getCustomer();
    async function getCustomer() {
        showLoader();
        let res = await axios.post("/get-customers");
        hideLoader();
        let tableList = $('#tableList');
        tableList.empty();
        res.data.forEach(function (item, index) {
            let row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.name}</td>
                    <td>${item.email}</td>
                    <td>${item.phone}</td>
                    <td>
                        <button onclick="editCustomer(${item.id})" class="btn edit">Edit</button>
                        <span onclick="deleteCustomer(${item.id})" class="btn-danger delete">Delete</span>
                    </td>
                </tr>`

            tableList.append(row);
        });
    }


    // edit category
    async function editCustomer(id) {
        try{
           let res = await axios.post("/get-customer",{'id' : id});
            openModal();
            document.getElementById('name').value = res.data['name'];
            document.getElementById('email').value = res.data['email'];
            document.getElementById('phone').value = res.data['phone'];
            document.getElementById('update').dataset.id = id;
        }catch(error){
            errorToast('Something went wrong')
        }
    }

    // update customer
    async function  updateCustomer() {
        let id = document.getElementById('update').dataset.id
        let name = document.getElementById('name').value
        let email = document.getElementById('email').value
        let phone = document.getElementById('phone').value

        let postobj = {
            'id' : id,
            'name' : name,
            'email' : email,
            'phone' : phone
        }
        showLoader();
        let res = await axios.post("/update-customer",postobj);
        hideLoader();
        if(res.data['status'] == 'success'){
            closeModal();
            successToast(res.data['message']);
            await getCustomer();
        }else{
            closeModal();
            errorToast(res.data['message']);
        }
    }


    // delete category
    async function deleteCustomer(id) {
        document.getElementById('confirmDeleteBtn').dataset.id = id
        deleteModal();
    }


    // delete category
    async function deleteConfirm() {
        try{
            let id = document.getElementById('confirmDeleteBtn').dataset.id
            let res = await axios.post("/delete-customer",{'id' : id});
            if(res.data['status'] == 'success'){
                deleteModalClose();
                successToast(res.data['message']);
                await getCustomer();
            }else{
                deleteModalClose();
                errorToast(res.data['message']);
            }
        }catch(error){
            errorToast('Something went wrong')
        }
    }

    // addCustomer
    async function addCustomer() {
        let newEmail = document.getElementById('newEmail').value;
        let newPhone = document.getElementById('newPhone').value;
        let newName = document.getElementById('newName').value;

        let postobj = {
            'name' : newName,
            'email' : newEmail,
            'phone' : newPhone
        };

        showLoader();
        let res = await axios.post("/add-customer",postobj);
        hideLoader();
        if(res.data['status'] == 'success'){
            successToast(res.data['message']);
            document.getElementById('name').value = '';
            document.getElementById('email').value = '';
            document.getElementById('phone').value = '';
            await getCustomer();
        }else{
            errorToast(res.data['message']);
        }
    }

</script>
@endSection
