<div class="col-md-2 sider">
    <div class="side_title"><h5>Krenky</h5></div>
    <div class="tag-page-gallery mb30">
        <img src="{{ static_asset('images/img/art_thumb.jpg') }}" alt="">
        <div class="menu">
            <a class="mt-10" href="{{ route('account') }}">My Account</a>
            <a class="" href="{{ route('accountmessage') }}">Messages</a>
            <a class="" href="{{ route('detail') }}">Personal Details</a>
            <a class="" href="#">Sections:</a>
            <ul>
                <li>
                    <a href="{{ route('profile') }}">Profile Info</a>
                </li>
                <li>
                    <a href="{{ route('accountgallery') }}">Galleries</a>
                </li>
                <li>
                    <a href="{{ route('news') }}">News & Updates</a>
                </li>
                <li>
                    <a href="{{ route('accountgallery') }}">Galleries</a>
                </li>
                <li>
                    <a href="{{ route('private') }}">Private Area</a>
                </li>
                <li>
                    <a href="{{ route('link') }}">Links</a>
                </li>
                <li>
                    <a href="{{ route('wishlist') }}">Wishlist</a>
                </li>
            </ul>
            <a class="" href="{{ route('coming') }}">Your Topics</a>
            <a class="" href="{{ route('coming') }}">Reactions</a>
            <a class="" href="{{ route('coming') }}">Following</a>
            <a class="" href="{{ route('coming') }}">Followers</a>
            <a class="" href="{{ route('coming') }}">Saved ArtWorks</a>
            <a class="" href="{{ route('coming') }}">Settings</a>
            <a class="logout" href="{{ route('logout') }}">Logout</a>
        </div>
    </div>
</div>