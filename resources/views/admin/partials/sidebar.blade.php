<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}"></a>
        </div>
        <div class="sidebar-brand">
            <!-- <a href="{{ route('admin.dashboard') }}"> -->
                <!-- <img src="{{ static_asset('images/default/logo.png') }}" -->
                        <!-- alt="Logo" style="max-width: 150px"></a> -->
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="bx bxs-dashboard"></i>
                    <span>{{ __('Dashboard') }}</span>
                </a>
            </li>
            <li class="{{ Request::routeIs('admin.customers') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.customers') }}">
                    <i class="bx bxs-user"></i>
                    <span>{{ __('Users') }}</span>
                </a>
            </li>
            <li class="{{ Request::routeIs('admin.gallery') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.gallery') }}">
                    <i class="bx bx-image-alt"></i>
                    <span>{{ __('Gallery') }}</span>
                </a>
            </li>
            <li class="{{ Request::routeIs('admin.message') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.message') }}">
                    <i class="bx bx-message-alt"></i>
                    <span>{{ __('Messages') }}</span>
                </a>
            </li>
            <li class="{{ Request::routeIs('admin.threads.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.threads.index') }}">
                    <i class="bx bx-detail"></i>
                    <span>{{ __('Forum') }}</span>
                </a>
            </li>
            <li class="{{ Request::routeIs('admin.market') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.market') }}">
                    <i class="bx bx-line-chart"></i>
                    <span>{{ __('STATISTICS') }}</span>
                </a>
            </li>
            <li class="{{ Request::routeIs('admin.tag') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.tag') }}">
                    <i class="bx bxs-tag"></i>
                    <span>{{ __('Tags') }}</span>
                </a>
            </li>
            <li class="{{ Request::routeIs('admin.content.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.content.index') }}">
                    <i class="bx bx-edit-alt"></i>
                    <span>{{ __('Content Editor') }}</span>
                </a>
            </li>
            <li class="{{ Request::routeIs('admin.settings') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.settings') }}">
                    <i class="bx bx-cog"></i>
                    <span>{{ __('Settings') }}</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
