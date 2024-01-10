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
        <span>Download CSV</span>
    </a>
</div>

<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class="bx bx-receipt"></i>
            <h3>Recent Orders</h3>
            <i class="bx bx-filter"></i>
            <i class="bx bx-search"></i>
        </div>
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Order Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>
                            <p>{{ $category->name }}</p>
                        </td>
                        <td>{{ $category->created_at }}</td>
                        <td>
                            <span class="btn">Edit</span>
                            <span class="btn-danger">Delete</span>
                        </td>
                    </tr>

                @endforeach

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
                }
            }
        }catch(error){
            errorToast('Something went wrong')
        }
    }
</script>

@endSection
