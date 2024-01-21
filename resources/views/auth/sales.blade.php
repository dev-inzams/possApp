@extends('auth.layout.app',['title' => 'Sales'])
@section('content')


{{-- product modal --}}
<div class="modal" id="customModal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2>Update Customer</h2>
        <label for="product_id">Product ID</label>
        <input type="text" id="product_id">

        <label for="product_name">Product Name</label>
        <input type="text" id="product_name">

        <label for="product_price">Price</label>
        <input type="text" id="product_price">

        <label for="product_qty">QTY</label>
        <input type="text" id="product_qty">

        <button onclick="add()" class="btn" id="add">Add</button>
    </div>
</div>







<div class="bottom-data">

    {{-- order --}}
    <div class="orders">
        <div class="header">
            <i class="bx bx-receipt"></i>
            <h3>BILLED TO</h3>

        </div>
        <p>Name: <strong id="Cname"></strong></p>
        <p>Email: <strong id="Cemail"></strong></p>
        <p>User Id: <strong id="Cid"></strong></p>

        <table class="mt-5">
            <thead>
                <tr>
                    <th width="40%">Name</th>
                    <th width="20%">QTY</th>
                    <th width="20%">Total</th>
                    <th width="20%">Remove</th>
                </tr>
            </thead>
            <tbody id="invoice_list">
                <tr></tr>
            </tbody>
        </table>

        <div class="payment-details mt-5">
            <h5>Payment Details</h5>
            <p>Payment Type: <strong>Cash</strong></p>
            <p>Total: <strong id="total"> $</strong></p>
            <p>Vat(5%): <strong id="vat"> $</strong></p>
            <p>Discount: <strong id="discount"> $</strong></p>
            <p>Payable: <strong id="payable"> $</strong></p>

            <label for="custom-discount">Discount</label>
            <input type="number" id="custom-discount">

            <button onclick="createInvoice()" class="btn">Confirm</button>
        </div>
    </div>

    {{-- product --}}
    <div class="orders">
        <div class="header">
            <i class="bx bx-receipt"></i>
            <h3>All Products</h3>
            <i class="bx bx-filter"></i>
            <i class="bx bx-search"></i>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Pick</th>
                </tr>
            </thead>
            <tbody id="products">

            </tbody>
        </table>
    </div>

    {{-- customer --}}
    <div class="orders">
        <div class="header">
            <i class="bx bx-group"></i>
            <h3>All Customers</h3>
            <i class="bx bx-filter"></i>
            <i class="bx bx-search"></i>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Pick</th>
                </tr>
            </thead>
            <tbody id ="customers">

            </tbody>
        </table>
    </div>



</div>

<script>

    // get customer
    getCustomers();
    async function getCustomers() {
        showLoader();
        let res = await axios.post("/get-customers");
        hideLoader();
        let tableList = $('#customers');
        tableList.empty();
        res.data.forEach(function (item, index) {
            let row = `
                <tr>
                    <td>${item.name}</td>
                    <td>
                        <button data-name="${item.name}" data-email="${item.email}" data-id="${item.id}" class="addCustomer btn edit">Add</button>
                    </td>
                </tr>`

            tableList.append(row);
        });

        $('.addCustomer').on('click', async function () {
            let Cname = $(this).data('name');
            let Cemail = $(this).data('email');
            let Cid = $(this).data('id');

            $("#Cname").text(Cname);
            $("#Cemail").text(Cemail);
            $("#Cid").text(Cid);
        });
    }

    //getProducts
    getProducts();
    async function getProducts() {
        try{
            showLoader();
            let res = await axios.post("/get-products");
            hideLoader();
            let tableList = $('#products');
            tableList.empty();
            res.data.forEach(function (item, index) {
                let row = `
                    <tr>
                        <td><img src="${item.img_url}" alt="NO image"><p>${item.name}</p></td>
                        <td>${item.price}</td>
                        <td>
                            <button data-name="${item.name}" data-price="${item.price}" data-id="${item.id}" class="addProduct btn edit">Add</button>
                        </td>
                    </tr>`

                tableList.append(row);
            });
            $('.addProduct').on('click', async function () {

                let Pname = $(this).data('name');
                let Pprice = $(this).data('price');
                let Pid = $(this).data('id');

                $("#product_name").val(Pname);
                $("#product_price").val(Pprice);
                $("#product_id").val(Pid);

                openModal();

            });
        }catch(err){
            errorToast('Something went wrong');
        }
    }



    // add product
    let InvoiceItemLists = [];
    function add(){
        let product_id = $("#product_id").val();
        let product_name = $("#product_name").val();
        let product_price = $("#product_price").val();
        let product_qty = $("#product_qty").val();
        let PTotalPrice = product_price * product_qty;
        if(product_id == "" || product_name == "" || product_price == "" || product_qty == ""){
            errorToast("All fields are required");
        }else{
            let item = {
                product_id : product_id,
                product_name : product_name,
                product_price : product_price,
                qty : product_qty,
                sale_price : PTotalPrice
            }
            InvoiceItemLists.push(item);
            console.log(InvoiceItemLists);
            closeModal();
            showInvoice();
        }
    }


    function showInvoice(){
        let total = 0;
        let tableList = $('#invoice_list');
        tableList.empty();
        InvoiceItemLists.forEach(function (item, index) {
            let row = `
                <tr>
                    <td>${item.product_name}</td>
                    <td>${item.qty}</td>
                    <td>${item.sale_price}</td>

                    <td><button data-id="${index}" class="btn-danger delete">Delete</button></td>
                </tr>`

            tableList.append(row);

            total += item.sale_price;
            vat = total * 1 / 100;
            // check if key up in discount
            payable = total + vat;
            $('#custom-discount').on('keyup', function () {
                let customeDiscount = $('#custom-discount').val();
                payable = (total + vat) - ( total * customeDiscount) / 100;
                $("#payable").text(payable);
                $('#discount').text(customeDiscount);
            });


        });
        $("#payable").text(payable);
        $("#total").text(total);
        $("#vat").text(vat);

        $('.delete').on('click', function () {
            let id = $(this).data('id');
            InvoiceItemLists.splice(id, 1);
            showInvoice();
        });


    }









    async function  createInvoice() {
        try{
            let customer_id = $("#Cid").text();
            let discout = $("#discount").text();
            let total = $("#total").text();
            let vat = $("#vat").text();
            let payable = $("#payable").text();
            let product = JSON.stringify(InvoiceItemLists);

            let postobj = {
                "total" : total,
                "discount": discout,
                "vat" : vat,
                "payable": payable,
                "customer_id": customer_id,
                "products": InvoiceItemLists
            }
            showLoader();
            let res = await axios.post("/create-invoice",postobj);
            hideLoader();
            if(res.data['status'] == 'success'){
                successToast(res.data['message']);
                InvoiceItemLists = [];
            }
        }catch(err){
            errorToast('Something went wrong');
        }
    }



</script>
@endsection
