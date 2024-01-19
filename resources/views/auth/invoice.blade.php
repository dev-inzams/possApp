@extends('auth.layout.app', ['title' => 'Invoice'])
@section('content')

<div class="modal mt-5" id="createModal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2>Update Customer</h2>
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

            <button type="submit" onclick="createInvoice()" class="btn mt-3">Publish</button>
    </div>
</div>

<div class="modal" id="customModal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2>Update Customer</h2>
        <label for="category">Category</label>
        <select id="category">
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




<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class="bx bx-cart"></i>
            <h3>All Invoices</h3>
            <i class="bx bx-filter"></i>
            <i class="bx bx-search"></i>
            <i onclick="createModal()" class="bx bx-plus btn">Add Invoice</i>
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

@endsection
