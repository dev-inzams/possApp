@extends('auth.layout.app', ['title' => 'Invoice'])
@section('content')



<div class="modal" id="customModal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2>Update Invoice</h2>
        <input type="text" id="total">
    </div>
</div>







<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class="bx bx-cart"></i>
            <h3>All Invoices</h3>
            <i class="bx bx-filter"></i>
            <i class="bx bx-search"></i>
        </div>
        <table class="table" id="tableData">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Total</th>
                    <th>Discount</th>
                    <th>Vat</th>
                    <th>Payable</th>
                    <th>Customer</th>
                </tr>
            </thead>
            <tbody id="invoicelist">

            </tbody>
        </table>
    </div>

</div>

<script>
    getInvoice();
    async function getInvoice() {
        showLoader();
        let res = await axios.post('/select-invoice');
        hideLoader();
        let tableList = $('#invoicelist');
        tableList.empty();
        res.data.forEach(function (item, index) {
            let row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.total}</td>
                    <td>${item.discount}</td>
                    <td>${item.vat}</td>
                    <td>${item.payable}</td>
                    <td>${item.customer.name}</td>
                </tr>
                `
            tableList.append(row);
        });
    }



</script>



@endsection
