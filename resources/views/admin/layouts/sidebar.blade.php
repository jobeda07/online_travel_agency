<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('admin/assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item  @yield('dashboard')">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>dashboard</p>
                        {{-- <span class="badge badge-success">4</span> --}}
                    </a>
                </li>
                <li class="nav-item @yield('access_control')">
                    <a data-bs-toggle="collapse" href="#access_control" class="collapsed" aria-expanded="false">
                        <i class="fas fa-user-cog"></i>
                        <p>Access Control</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse @yield('access_collapse')" id="access_control">
                        <ul class="nav nav-collapse">
                            <li class=" @yield('role_list')">
                                <a href="{{ route('role.list') }}">
                                    <span class="sub-item">All Role</span>
                                </a>
                            </li>
                            <li class="@yield('user_list')">
                                <a href="{{ route('user.list') }}">
                                    <span class="sub-item">User List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @if (Auth::guard('admin')->user()->can('airticket-list'))
                    <li class="nav-item @yield('air_ticket')">
                        <a data-bs-toggle="collapse" href="#airticket" class="collapsed" aria-expanded="false">
                            <i class="fas fa-ticket-alt"></i>
                            <p>Air/Ticket</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse @yield('air_collapse')" id="airticket">
                            <ul class="nav nav-collapse">
                                <li class="@yield('booking')">
                                    <a href="{{ route('airticket.booking.list') }}">
                                        <span class="sub-item">Booking</span>
                                    </a>
                                </li>
                                <li class="@yield('report')">
                                    <a href="{{ route('airticket.booking.reports') }}">
                                        <span class="sub-item">Reports</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if (Auth::guard('admin')->user()->can('hotelticket-list'))
                    <li class="nav-item @yield('hotel_booking')">
                        <a data-bs-toggle="collapse" href="#hotel" class="collapsed" aria-expanded="false">
                            <i class="fas fa-hotel"></i>
                            <p>Hotel</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse @yield('hotel_collapse')" id="hotel">
                            <ul class="nav nav-collapse">
                                <li class="@yield('booking')">
                                    <a href="{{ route('hotel.booking.list') }}">
                                        <span class="sub-item">Booking</span>
                                    </a>
                                </li>
                                <li class="@yield('report')">
                                    <a href="{{ route('hotel.booking.reports') }}">
                                        <span class="sub-item">Reports</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="nav-item @yield('package')">
                    <a data-bs-toggle="collapse" href="#package" class="collapsed" aria-expanded="false">
                        <i class="fa fa-gift" aria-hidden="true"></i>
                        <p>Package</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse @yield('package_collapse')" id="package">
                        <ul class="nav nav-collapse">
                            <li class="@yield('list')">
                                <a href="{{ route('holiday.package.list') }}">
                                    <span class="sub-item">list</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @if (Auth::guard('admin')->user()->can('customer-list'))
                    <li class="nav-item @yield('customer')">
                        <a data-bs-toggle="collapse" href="#customer" class="collapsed" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <p>Customers</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse @yield('customer_collapse')" id="customer">
                            <ul class="nav nav-collapse">
                                <li class="@yield('list')">
                                    <a href="{{ route('customer.list') }}">
                                        <span class="sub-item">List</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="nav-item @yield('common')">
                    <a data-bs-toggle="collapse" href="#common" class="collapsed" aria-expanded="false">
                        <i class="far fa-folder-open"></i>
                        <p>Common</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse @yield('common_collapse')" id="common">
                        <ul class="nav nav-collapse">
                            <li class="@yield('country')">
                                <a href="{{ route('country.list') }}">
                                    <span class="sub-item">Country</span>
                                </a>
                            </li>
                            <li class="@yield('city')">
                                <a href="{{ route('city.list') }}">
                                    <span class="sub-item">City</span>
                                </a>
                            </li>
                            <li class="@yield('currency')">
                                <a href="{{ route('currency.list') }}">
                                    <span class="sub-item">Currency</span>
                                </a>
                            </li>
                            <li class="@yield('payment_method')">
                                <a href="{{ route('paymentMethod.list') }}">
                                    <span class="sub-item">Payment Method</span>
                                </a>
                            </li>
                            <li class="@yield('language')">
                                <a href="{{ route('language.list') }}">
                                    <span class="sub-item">Language</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item @yield('support_ticket')">
                    <a href="{{ route('adminSupportTicket.list') }}">
                        <i class="far fa-envelope"></i>
                        <p>Support Ticket</p>
                        {{-- <span class="badge badge-success">4</span> --}}
                    </a>
                </li>
                @if (Auth::guard('admin')->user()->can('customer-list'))
                    <li class="nav-item @yield('accounts')">
                        <a data-bs-toggle="collapse" href="#account" class="collapsed" aria-expanded="false">
                            <i class="fas fa-calculator"></i>
                            <p>Account</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse @yield('account_collapse')" id="account">
                            <ul class="nav nav-collapse">
                                <li class="@yield('account_head')">
                                    <a href="{{ route('account.head.list') }}">
                                        <span class="sub-item">Account Head</span>
                                    </a>
                                </li>
                                <li class="@yield('account_ledger')">
                                    <a href="{{ route('account.ledger.list') }}">
                                        <span class="sub-item">Account Ledger</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="nav-item @yield('frontend')">
                    <a data-bs-toggle="collapse" href="#submenu">
                        <i class="fas fa-bars"></i>
                        <p>Frontend</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse @yield('frontend_collapse')" id="submenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a data-bs-toggle="collapse" href="#subnav1">
                                    <span class="sub-item">Home Page</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse @yield('subnav1')" id="subnav1">
                                    <ul class="nav nav-collapse subnav">
                                        <li class="@yield('slider')">
                                            <a href="{{ route('slider.list') }}">
                                                <span class="sub-item">Sliders</span>
                                            </a>
                                        </li>
                                        <li class="@yield('our_partner')">
                                            <a href="{{ route('ourPartner.list') }}">
                                                <span class="sub-item">Our Partner</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Level 1</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item @yield('setting')">
                    <a href="{{ route('setting.list') }}">
                        <i class="fas fa-cogs"></i>
                        <p>Setting</p>
                        {{-- <span class="badge badge-success">4</span> --}}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
