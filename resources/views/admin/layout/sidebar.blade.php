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
                <span class="menu-title">Detil Penjual</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-vendors">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                    <li class="nav-item"> <a @if (Session::get('page')=='update_personal_details' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/update-vendor-details/personal') }}">Detil Penjual</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=='update_business_details' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/update-vendor-details/business') }}">Detil Toko</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if (Session::get('page')=='products' || Session::get('page')=='coupons' ) style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-catalogue" aria-expanded="false" aria-controls="ui-catalogue">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Kelola Katalog</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-catalogue">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                    <li class="nav-item"> <a @if (Session::get('page')=='products' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/products') }}">Produk</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=='coupons' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/coupons') }}">Kupon</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if (Session::get('page')=='orders' ) style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-orders" aria-expanded="false" aria-controls="ui-orders">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Kelola Pesanan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-orders">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                    <li class="nav-item"> <a @if (Session::get('page')=='orders' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/orders') }}">Pesanan</a></li>
                </ul>
            </div>
        </li>
        @else
        <li class="nav-item">
            <a @if (Session::get('page')=='update_admin_password' || Session::get('page')=='update_admin_details' ) style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-settings" aria-expanded="false" aria-controls="ui-settings">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Pengaturan Admin</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-settings">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                    <li class="nav-item"> <a @if (Session::get('page')=='update_admin_password' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/update-admin-password') }}">Perbarui Kata Sandi
                            Admin</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=='update_admin_details' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/update-admin-details') }}">Perbarui Detil Admin</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if (Session::get('page')=='admins' || Session::get('page')=='users' ) style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-admins" aria-expanded="false" aria-controls="ui-admins">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Kelola Pengguna</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-admins">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                    <li class="nav-item"> <a @if (Session::get('page')=='admins' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/admins') }}">Penjual</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=='users' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/users') }}">Pembeli</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if (Session::get('page')=='sections' || Session::get('page')=='categories' || Session::get('page')=='products' || Session::get('page')=='coupons' ) style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-catalogue" aria-expanded="false" aria-controls="ui-catalogue">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Kelola Katalog</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-catalogue">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                    <li class="nav-item"> <a @if (Session::get('page')=='sections' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/sections') }}">Sections</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=='categories' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/categories') }}">Kategori</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=='products' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/products') }}">Produk</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=='coupons' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/coupons') }}">Kupon</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if (Session::get('page')=='orders' ) style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-orders" aria-expanded="false" aria-controls="ui-orders">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Kelola Pesanan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-orders">
                <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                    <li class="nav-item"> <a @if (Session::get('page')=='orders' ) style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/orders') }}">Pesanan</a></li>
                </ul>
            </div>
        </li>
        @endif
    </ul>
</nav>