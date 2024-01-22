@extends('auth.layout.app', ['title' => 'Dashboard'])
@section('content')
    <div class="header">
        <div class="left">
            <h1>Dashboard</h1>
            <ul class="breadcrumb">
                <li><a href="#">
                        Analytics
                    </a></li>
                /
                <li><a href="#" class="active">Shop</a></li>
            </ul>
        </div>
        <a href="#" class="report">
            <i class='bx bx-cloud-download'></i>
            <span>Download CSV</span>
        </a>
    </div>

    <!-- Insights -->
    <ul class="insights">
        <li>
            <i class='bx bx-calendar-check'></i>
            <div class="gc gb" id="gl"> </div>
            <span class="info">
                <h3 id="total-order">

                </h3>
                <p>Order</p>
            </span>
        </li>
        <li><i class='bx bx-show-alt'></i>
            <span class="info">
                <h3>
                    3,944
                </h3>
                <p>Site Visit</p>
            </span>
        </li>
        <li><i class='bx bx-line-chart'></i>
            <span class="info">
                <h3>
                    14,721
                </h3>
                <p>Searches</p>
            </span>
        </li>
        <li><i class='bx bx-dollar-circle'></i>
            <div class="gc gb" id="gl"> </div>
            <span class="info">
                <h3 id="total">
                </h3>
                <p>Total Sales</p>
            </span>
        </li>
    </ul>
    <!-- End of Insights -->

    <div class="bottom-data">
        <div class="orders">
            <div class="header">
                <i class='bx bx-receipt'></i>
                <h3>Recent Orders</h3>
                <i class='bx bx-filter'></i>
                <i class='bx bx-search'></i>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Phone</th>
                        <th>Created</th>
                        <th>Payable</th>
                    </tr>
                </thead>
                <tbody id="recentOrder">

                </tbody>
            </table>
        </div>

        <!-- Reminders -->
        <div class="reminders">
            <div class="header">
                <i class='bx bx-note'></i>
                <h3>Remiders</h3>
                <i class='bx bx-filter'></i>
                <i class='bx bx-plus'></i>
            </div>
            <ul class="task-list">
                <li class="completed">
                    <div class="task-title">
                        <i class='bx bx-check-circle'></i>
                        <p>Start Our Meeting</p>
                    </div>
                    <i class='bx bx-dots-vertical-rounded'></i>
                </li>
                <li class="completed">
                    <div class="task-title">
                        <i class='bx bx-check-circle'></i>
                        <p>Analyse Our Site</p>
                    </div>
                    <i class='bx bx-dots-vertical-rounded'></i>
                </li>
                <li class="not-completed">
                    <div class="task-title">
                        <i class='bx bx-x-circle'></i>
                        <p>Play Footbal</p>
                    </div>
                    <i class='bx bx-dots-vertical-rounded'></i>
                </li>
            </ul>
        </div>

        <!-- End of Reminders-->

    </div>



<script>
    totalPaid();
    async function totalPaid(){
        gls();
        let res = await axios.post("/total-payed");
        glh();
        let total = document.getElementById('total');
        total.innerText = res.data['totalPaid'] + " $";
    }

    totalOrder();
    async function totalOrder(){
        gls();
        let res = await axios.post("/total-order");
        glh();
        let total = document.getElementById('total-order');
        total.innerText = res.data['totalOrder'] + " Paid";

    }


    recentOrder();
    async function recentOrder(){
        gls();
        let res = await axios.post("/recent-order");
        glh();
        let total = document.getElementById('recentOrder');
        // make loop

        for(let i = 0; i < res.data['recentOrder'].length; i++){
            total.innerHTML += `
                <tr>
                    <td>${res.data['recentOrder'][i]['customer']['name']}</td>
                    <td>${res.data['recentOrder'][i]['customer']['phone']}</td>
                    <td>${res.data['recentOrder'][i]['created_at']}</td>
                    <td>${res.data['recentOrder'][i]['payable']}</td>
                </tr>
            `
        }

    }


    function gls() {
        document.getElementById('gl').style.display = 'block';
    }

    function glh() {
        document.getElementById('gl').style.display = 'none';
    }
</script>


@endSection
