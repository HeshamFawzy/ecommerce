<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
    <!--  <img src="{{ asset('assets/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8"> -->
        <span class="brand-text font-weight-light">Cashmere</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
            </div>
        </div> -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @hasrole('superAdmin' , 'admin')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            @lang('side-bar.admins')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('systemUsers.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('side-bar.admins-list')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('systemUsers.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('side-bar.admins-create')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endhasrole
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            @lang('side-bar.public_pages')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('public.slider') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('side-bar.public_pages-slider')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('public.about') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('side-bar.public_pages-about')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('public.contact') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('side-bar.public_pages-contact')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            @lang('side-bar.categories')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('side-bar.categories-list')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('side-bar.categories-create')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            @lang('side-bar.colors')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('colors.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('side-bar.colors-list')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('colors.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('side-bar.colors-create')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            {{ __('side-bar.sizes') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sizes.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('side-bar.sizes-list') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sizes.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('side-bar.sizes-create') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            @lang('side-bar.products')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('store.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('side-bar.products-material')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('side-bar.products-list')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('side-bar.products-create')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('orders.index') }}" class="nav-link">
                        <i class="fas fa-list nav-icon"></i>
                        <p>@lang('side-bar.orders')</p>
                        <p class="badge badge-info" id="orders">
                            @hasrole('superAdmin' , 'admin')
                            {{ \App\Order::all()->count() }}
                            @else
                                {{ \App\Order::where('status' , \Illuminate\Support\Facades\Auth::guard('admin')->user()->roles->pluck('id')->first() - 1)->count() }}
                                @endhasrole
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('members') }}" class="nav-link">
                        <i class="fas fa-list nav-icon"></i>
                        <p>@lang('side-bar.members')</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
