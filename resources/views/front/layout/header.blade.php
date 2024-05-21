<?php $sections = \App\Models\Section::sections(); ?>
<header>
    <div class="full-layer-outer-header">
        <div class="container clearfix">
            <nav>
                <ul class="primary-nav g-nav">
                    <li>
                        <a href="{{ url('/'); }} ">NutriBites</a>
                    </li>
                </ul>
            </nav>
            <nav>
                <ul class="secondary-nav g-nav">
                    <li>
                        <a>Login/Register
                            <i class="fas fa-chevron-down u-s-m-l-9"></i>
                        </a>
                        <ul class="g-dropdown" style="width:200px">
                            @if (\Illuminate\Support\Facades\Auth::check())
                            <li>
                                <a href="{{ url('user/account') }}">
                                    <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                    My Account
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('user/orders') }}">
                                    <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                    My Orders
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('user/logout') }}">
                                    <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                    Logout
                                </a>
                            </li>
                            @else
                            <li>
                                <a href="{{ url('user/login-register') }}">
                                    <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                    Customer Login
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('vendor/login-register') }}">
                                    <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                    Vendor Login
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </nav>
            <nav>
                <ul class="secondary-nav g-nav">
                    <li>
                        <a href="{{ url('cart') }}">
                            <i class="ion ion-md-basket"></i>
                            <span class="item-counter totalCartItems">{{ totalCartItems() }}</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>