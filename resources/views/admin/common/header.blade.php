<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar sticky">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i
                        data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                    <i data-feather="maximize"></i>
                </a></li>
            <li>
            </li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image"
                    src="{{ asset(Auth::guard('admin')->check() && Auth::guard('admin')->user()->image ? Auth::guard('admin')->user()->image : 'public/admin/assets/images/user.png') }}"
                    class="user-img-radious-style">
                <span class="d-sm-none d-lg-inline-block"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title">
                    @if (Auth::guard('admin')->check())
                        {{ Auth::guard('admin')->user()->name }}
                    @elseif(Auth::guard('branch')->check())
                        {{ Auth::guard('branch')->user()->name }}
                    @endif
                </div>
                <a href="{{ Auth::guard('admin')->check() ? url('admin/profile') : url('branch/profile') }}"
                    class="dropdown-item has-icon">
                    <i class="fa fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ Auth::guard('admin')->check() ? url('admin/logout') : url('branch/logout') }}"
                    class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>

    </ul>
</nav>
