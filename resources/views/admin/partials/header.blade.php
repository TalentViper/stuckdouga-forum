<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="bx bx-menu"></i></a>
            </li>
        </ul>
    </form>

    <ul class="navbar-nav navbar-right">
        <li>
            <div class="p-1 mr-3 bg-light d-flex align-items-center">
                <img alt="image" src="{{ static_asset('images/flags/gb.png') }}" class="mr-1" height="30">
                <div class="d-flex flex-column">
                    <div id="current_date" class="text-center" style="font-size: 0.8rem; line-height: 1rem"></div>
                    <div id="current_time" class="text-center font-weight-bold" style="font-size: 0.8rem; line-height: 1rem"></div>
                </div>
            </div>
        </li>

        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                                                     class="nav-link notification-toggle nav-link-lg beep "><i
                        class="bx bx-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">{{ __('Notifications') }}
                    <div class="float-right">
                        <a href="">{{ __('Mark All As Read') }}</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons">                    
                    
                </div>
                <div class="dropdown-footer text-center">
                    <a href="">{{ __('View All') }} <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>
        
        <li class="dropdown">
            <a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="" src="{{static_asset('images/default/user32x32.jpg')}}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">{{Auth::guard('admin')->user()->first_name}}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">                
                <a href=""
                   class="dropdown-item has-icon">
                    <i class="bx bx-user"></i> {{ __('Profile') }}
                </a>
                <a href=""
                   class="dropdown-item has-icon">
                    <i class='bx bx-file'></i>{{ __('Login Activities') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{route('admin.logout')}}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="bx bx-log-out"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
