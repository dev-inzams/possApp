@extends('auth.layout.app',['title' => 'Category'])
@section('content')
<div class="header">
    <div class="left">
        <h1>Categories</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('dashboard') }}">
                    Dashboard
                </a></li>
            /
            <li><a href="{{ route('profile') }}" class="active">categories</a></li>
        </ul>
    </div>
    <a href="#" class="report">
        <i class="bx bx-cloud-download"></i>
        <span>Download Categories CSV</span>
    </a>
</div>


{{-- create modal --}}
<div class="modal" id="customModal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2>Update Category</h2>
        <input type="text" id="updatecategory">
        <button class="btn" data-id="" onclick="updateCategory()">Update</button>
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
                    <th>Category</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tableList">

            </tbody>
        </table>
    </div>

    <!-- Reminders -->
    <div class="reminders">
        <div class="header">
            <i class="bx bx-note"></i>
            <h3>Add New Category</h3>
            <i class="bx bx-filter"></i>
            <i class="bx bx-plus"></i>
        </div>

        <div class="task-list">
            <label for="category">Category</label>
            <input type="text" id="category" placeholder="Enter Category Name">

            <button onclick="addCategory()" type="submit">Add Category</button>
        </div>
    </div>

    <!-- End of Reminders-->
</div>

<script>

    // get all categories list
    getCategories();
    async function getCategories() {
        showLoader();
        let res = await axios.post("/get-categories");
        hideLoader();
        let tableList = $('#tableList');
        let tableData = $('#tableData');
        //tableData.DataTable().destroy();
        tableList.empty();
        res.data.forEach(function (item, index) {
            let row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>
                        <p>${item.name}</p>
                    </td>
                    <td>${item.created_at}</td>
                    <td>
                        <button onclick="editCategory(${item.id})" class="btn edit">Edit</button>
                        <span onclick="deleteCategory(${item.id})" class="btn-danger delete">Delete</span>
                    </td>
                </tr>
            `

            tableList.append(row);

        });
        tableData.dataTable();
    }



    // add new category
    async function addCategory() {
        try{
            let category = document.getElementById('category').value
            if(category == ''){
                errorToast('Fields are required')
            }else{
                let postobj = {
                    'name' : category
                };
                showLoader()
                let res = await axios.post("/add-category",postobj);
                hideLoader();
                if(res.data['status'] == 'success'){
                    successToast(res.data['message']);
                    document.getElementById('category').reset();
                    await getCategories();
                }
            }
        }catch(error){
            errorToast('Something went wrong')
        }
    }

    // delete category
    async function deleteCategory(id){
        try{
            deleteModal();
            await new Promise(resolve => {
                document.getElementById('confirmDeleteBtn').addEventListener('click', resolve, { once: true });
            });
            let res = await axios.post("/delete-category",{'category_id' : id});
            if(res.data['status'] == 'success'){
                deleteModalClose();
                successToast(res.data['message']);
                await getCategories();
            }
        }catch(error){
            errorToast('Something went wrong')
        }
    }


    // edit category
    async function editCategory(id) {
        try{
            let res = await axios.post("/get-category",{'category_id' : id});
            openModal();
            document.getElementById('updatecategory').value = res.data['name'];
            document.getElementById('updatecategory').dataset.id = id;
        }catch(error){
            errorToast('Something went wrong')
        }
    }


    // update category
    async function updateCategory() {
        try{
            let updatecategory = document.getElementById('updatecategory').value
            let category_id = document.getElementById('updatecategory').dataset.id
            let res = await axios.post("/update-category",{'category_id' : category_id,'name' : updatecategory});
            if(res.data['status'] == 'success'){
                closeModal();
                successToast(res.data['message']);
                await getCategories();
            }
        }catch(error){
            errorToast('Something went wrong')
        }
    }




</script>

@endSection
