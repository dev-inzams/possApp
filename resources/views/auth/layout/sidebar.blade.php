    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Asmr</span>Prog</div>
        </a>
        <ul class="side-menu">
            <li class="@if (Route::currentRouteName() == 'dashboard') active @endif"><a href="{{ route('dashboard') }}"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li class="@if (Route::currentRouteName() == 'profile') active @endif"><a href="{{ route('profile') }}"><i class='bx bx-user'></i>Profile</a></li>
            <li class="@if (Route::currentRouteName() == 'categories') active @endif"><a href="{{ route('categories') }}"><i class='bx bx-category'></i>Categories</a></li>
            <li class="@if (Route::currentRouteName() == 'customers') active @endif"><a href="{{ route('customers') }}"><i class='bx bx-group'></i>Customers</a></li>
            <li class="@if (Route::currentRouteName() == 'products') active @endif"><a href="{{ route('products') }}"><i class='bx bx-package'></i>Products</a></li>
            <li><a href="#"><i class='bx bx-message-square-dots'></i>Tickets</a></li>
            <li><a href="#"><i class='bx bx-group'></i>Users</a></li>
            <li><a href="#"><i class='bx bx-cog'></i>Settings</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="{{ route('logout')}}" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

