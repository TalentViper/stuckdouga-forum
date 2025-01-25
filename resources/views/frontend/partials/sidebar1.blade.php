<div class="col-md-2 sider">
    <div class="side_title"><h5>{{ auth()->user()->full_name }}</h5></div>
    <div class="tag-page-gallery mb30">
        <div class="text-center">
            <img src="{{ auth()->user()->avatar ? static_asset('uploads/' . auth()->user()->avatar) : ( auth()->user()->gender == 'female' ? static_asset('images/img/female_default.jpg') : static_asset('images/img/male_default.jpg') ) }}" alt="" width="200">
        </div>
        <div class="menu" style="padding: 0;">
            <a class="mt-10 {{ Request::routeIs('account') ? 'active' : '' }}" href="{{ route('account') }}">My Account</a>
            <a class="{{ Request::routeIs('accountmessage') ? 'active' : '' }}" href="{{ route('accountmessage') }}">Messages</a>
            <a class="{{ Request::routeIs('detail') ? 'active' : '' }}" href="{{ route('detail') }}">Personal Details</a>
            <a class="" href="#">Sections:</a>
            <ul>
                <li>
                    <a class="{{ Request::routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">Profile Info</a>
                </li>
                <li>
                    <a class="{{ Request::routeIs('accountgallery') ? 'active' : '' }}" href="{{ route('accountgallery') }}">Galleries</a>
                </li>
                <li>
                    <a class="{{ Request::routeIs('news') ? 'active' : '' }}" href="{{ route('news') }}">News & Updates</a>
                </li>
                <li>
                    <a class="{{ Request::routeIs('private') ? 'active' : '' }}" href="{{ route('private') }}">Private Area</a>
                </li>
                <li>
                    <a class="{{ Request::routeIs('link') ? 'active' : '' }}" href="{{ route('link') }}">Links</a>
                </li>
                <li>
                    <a class="{{ Request::routeIs('wishlist') ? 'active' : '' }}" href="{{ route('wishlist') }}">Wishlist</a>
                </li>
            </ul>
            <a class="{{ Request::routeIs('coming') ? 'active' : '' }}" href="{{ route('coming') }}">Your Topics</a>
            <a class="" href="{{ route('coming') }}">Reactions</a>
            <a class="" href="{{ route('coming') }}">Following</a>
            <a class="" href="{{ route('coming') }}">Followers</a>
            <a class="" href="{{ route('coming') }}">Saved ArtWorks</a>
            <a class="" href="{{ route('coming') }}">Settings</a>
            <a class="logout" href="{{ route('logout') }}">Logout</a>
        </div>
    </div>
</div>