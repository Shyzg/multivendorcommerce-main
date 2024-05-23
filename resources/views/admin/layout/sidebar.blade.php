<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a @if (Session::get('page')=='dashboard' ) style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" href="{{ url('admin/dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if (Auth::guard('admin')->user()->type == 'vendor')
        <li class="nav-item">
            <a @if (Session::get('page')=='update_personal_details' || Session::get('page')=='update_business_details' ) style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-vendors" aria-expanded="false" aria-controls="ui-vendors">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Vendor Details</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-vendors">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                    <li class="nav-item"> <a @if (Session::get('page')=='update_personal_details' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/update-vendor-details/personal') }}">Personal
                            Details</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=='update_business_details' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/update-vendor-details/business') }}">Business
                            Details</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if (Session::get('page')=='sections' || Session::get('page')=='categories' || Session::get('page')=='products' || Session::get('page')=='coupons' ) style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-catalogue" aria-expanded="false" aria-controls="ui-catalogue">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Catalogue Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-catalogue">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                    <li class="nav-item"> <a @if (Session::get('page')=='products' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/products') }}">Products</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=='coupons' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/coupons') }}">Coupons</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if (Session::get('page')=='orders' ) style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-orders" aria-expanded="false" aria-controls="ui-orders">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Orders Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-orders">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                    <li class="nav-item"> <a @if (Session::get('page')=='orders' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/orders') }}">Orders</a></li>
                </ul>
            </div>
        </li>
        @else
        <li class="nav-item">
            <a @if (Session::get('page')=='update_admin_password' || Session::get('page')=='update_admin_details' ) style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-settings" aria-expanded="false" aria-controls="ui-settings">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Settings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-settings">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                    <li class="nav-item"> <a @if (Session::get('page')=='update_admin_password' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/update-admin-password') }}">Update Admin
                            Password</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=='update_admin_details' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/update-admin-details') }}">Update Admin Details</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if (Session::get('page')=='users' || Session::get('page')=='view_vendors' ) style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-admins" aria-expanded="false" aria-controls="ui-admins">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">User Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-admins">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                    <li class="nav-item"> <a @if (Session::get('page')=='view_admins' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/admins/vendor') }}">Vendors</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=='users' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/admins/user') }}">Users</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if (Session::get('page')=='sections' || Session::get('page')=='categories' || Session::get('page')=='products' || Session::get('page')=='coupons' ) style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-catalogue" aria-expanded="false" aria-controls="ui-catalogue">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Catalogue Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-catalogue">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                    <li class="nav-item"> <a @if (Session::get('page')=='sections' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/sections') }}">Sections</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=='categories' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/categories') }}">Categories</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=='products' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/products') }}">Products</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=='coupons' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/coupons') }}">Coupons</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if (Session::get('page')=='orders' ) style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-orders" aria-expanded="false" aria-controls="ui-orders">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Orders Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-orders">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                    <li class="nav-item"> <a @if (Session::get('page')=='orders' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/orders') }}">Orders</a></li>
                </ul>
            </div>
        </li>
        @endif
    </ul>
</nav>