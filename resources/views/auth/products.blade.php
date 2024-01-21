@extends('auth.layout.app',['title' => 'Products'])
@section('content')

{{-- update product modal --}}
<div class="modal" id="customModal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2>Update Customer</h2>
        <label for="categoryUpdate">Category</label>
        <select id="categoryUpdate">
            <option value="">Select Category</option>
        </select>

        <label for="updateName">Product Name</label>
        <input type="text" id="updateName">

        <label for="updatePrice">Price</label>
        <input type="text" id="updatePrice">

        <label for="updateUnit">Unit</label>
        <input type="text" id="updateUnit">

        <img class="img" id="updateNewImg" alt="NO image">
        <br/>
        <label for="updateImg">Product Image</label>
        <input oninput="updateNewImg.src = window.URL.createObjectURL(this.files[0])" type="file" id="updateImg">

        <button class="btn" id="update">Update</button>
    </div>
</div>


{{-- create product modal --}}
<div class="modal mt-5" id="createModal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModalTwo()">&times;</span>
        <h2>Add Product</h2>
            <label for="category">Category</label>
            <select id="category">
                <option value="">Select Category</option>
            </select>

            <label for="name">Product Name</label>
            <input type="text" id="name">

            <label for="price">Price</label>
            <input type="text" id="price">

            <label for="unit">Unit</label>
            <input type="text" id="unit">

            <img class="img" id="newImg" src="{{asset('img/default.png')}}" alt="NO image">
            <br/>

            <label for="img_url">Image</label>
            <input oninput="newImg.src = window.URL.createObjectURL(this.files[0])" type="file" id="img" name="img">

            <button type="submit" onclick="createProduct()" class="btn mt-3">Publish</button>
    </div>
</div>

<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class="bx bx-receipt"></i>
            <h3>All Products</h3>
            <i class="bx bx-filter"></i>
            <i class="bx bx-search"></i>
            <i onclick="createModal()" class="bx bx-plus btn">Add Product</i>
        </div>
        <table class="table" id="tableData">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Unit</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tableList">

            </tbody>
        </table>
    </div>

</div>

<script>
    // get categories
    getCategories();
    async function getCategories(){
       let res = await axios.post("/get-categories");
        res.data.forEach(function (item, i) {
            let option = `<option value="${item.id}">${item.name}</option>`;
            $('#category').append(option);
        });
        res.data.forEach(function (item, i) {
            let option = `<option value="${item.id}">${item.name}</option>`;
            $('#categoryUpdate').append(option);
        });
    }


    //getProducts
    getProducts();
    async function getProducts() {
        try{
            showLoader();
            let res = await axios.post("/get-products");
            hideLoader();
            let tableList = $('#tableList');
            tableList.empty();
            res.data.forEach(function (item, index) {
                let row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td><img src="${item.img_url}" alt="NO image"></td>
                        <td>${item.name}</td>
                        <td>${item.price}</td>
                        <td>${item.unit}</td>
                        <td>
                            <button onclick="editProduct(${item.id})" class="btn edit">Edit</button>
                            <span onclick="deleteProduct(${item.id})" class="btn-danger delete">Delete</span>
                        </td>
                    </tr>`

                tableList.append(row);
            });
        }catch(err){
            errorToast('Something went wrong');
        }
    }

    // create product
    async function createProduct(){
        try{
            let name = document.getElementById('name').value;
            let price = document.getElementById('price').value;
            let unit = document.getElementById('unit').value;
            let img = document.getElementById('img').files[0];
            let category = document.getElementById('category').value;
            // set multipart form data


            // Create FormData object and append form fields
            let formData = new FormData();
            formData.append('name', name);
            formData.append('price', price);
            formData.append('unit', unit);
            formData.append('img', img);
            formData.append('category_id', category);

            showLoader();
            let res = await axios.post("/add-product", formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });
            hideLoader();
            if(res.data['status'] == 'success'){
                closeModal();
                successToast(res.data['message']);
                document.getElementById('name').value = '';
                document.getElementById('price').value = '';
                document.getElementById('unit').value = '';
                document.getElementById('img').value = '';
                document.getElementById('category').value = '';
                await getProducts();
            }
        }catch(err){
            closeModal();
            errorToast('Something went wrong');
        }
    } // create product


    // edit product
    async function editProduct(id) {
        try{
            let res = await axios.post("/get-product",{'product_id' : id});
            openModal();
             document.getElementById('updateName').value = res.data['name'];
             document.getElementById('updatePrice').value = res.data['price'];
             document.getElementById('updateUnit').value = res.data['unit'];
             document.getElementById('updateNewImg').src = res.data['img_url'];
             document.getElementById('categoryUpdate').value = res.data['category_id'];
             document.getElementById('update').dataset.id = id;
             document.getElementById('update').addEventListener('click', async function() {
                let id = document.getElementById('update').dataset.id
                let name = document.getElementById('updateName').value
                let price = document.getElementById('updatePrice').value
                let unit = document.getElementById('updateUnit').value
                let category = document.getElementById('categoryUpdate').value
                let img = document.getElementById('updateImg').files[0];
                if(img){
                    let postobj = {
                        'product_id' : id,
                        'name' : name,
                        'price' : price,
                        'unit' : unit,
                        'img' : img,
                        'category_id' : category
                    };
                    showLoader();
                    let res = await axios.post("/update-product",postobj,{
                        headers: {
                            'Content-Type': 'multipart/form-data',
                        }
                    });
                    hideLoader();
                    if(res.data['status'] == 'success'){
                        closeModal();
                        successToast(res.data['message']);
                        await getProducts();
                    }
                }else{
                    let postobj = {
                        'product_id' : id,
                        'name' : name,
                        'price' : price,
                        'unit' : unit,
                        'category_id' : category
                    };
                    showLoader();
                    let res = await axios.post("/update-product",postobj);
                    hideLoader();
                    if(res.data['status'] == 'success'){
                        closeModal();
                        successToast(res.data['message']);
                        await getProducts();
                    }
                } // if image

            });
        }catch(error){
            errorToast(error);
        }
    }
</script>

@endsection
