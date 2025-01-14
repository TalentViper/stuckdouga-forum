<!-- ======= Header ======= -->
<header id="header">
    <div id="header_box">

        <a href="{{route('home')}}" class="hover"><img src="{{ static_asset('images/img/stuckdouga_logo.jpg') }}" alt="Stuck Douga" /></a>

        <div class="navigation">
            <ul>
                <li class="header-search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#e30512" class="bi bi-search search-ic hover" viewBox="0 0 16 16" onclick="toggleSearchPopup()">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </li>
                <li><a href="{{ route('latest') }}" class="hover">Galleries</a></li>
                <li><a href="{{route('about')}}" class="hover">About</a></li>
                <li><a href="{{route('threads.index')}}" class="hover">Community</a></li>
                <li><a href="{{route('resource')}}" class="hover">Resources</a></li>
                <li><a href="{{route('contact')}}" class="hover">Contact Us</a></li>
                <li><button class="my_but" onclick="window.location.href='{{ route('latest') }}'">Start Gallery</button></li>
                <li><button class="my_but" onclick="window.location.href='{{ route('account') }}'">Account</button></li>
            </ul>
        </div>

    </div>

    <!-- Search Popup -->
    <div id="search-popup" class="search-popup">
        <div class="search-popup-content">
            <span class="close" onclick="toggleSearchPopup()">&times;</span>
            <h1 class="text-center">SEARCH ON SITE</h1>
            <form>
                <div class="radio-container">
                    <input type="radio" id="search-galleries" name="search-type" value="galleries" checked>
                    <label for="search-galleries">Search Galleries</label>
                    <input type="radio" id="search-users" name="search-type" value="users">
                    <label for="search-users">Search Users</label>
                    <input type="radio" id="search-forum" name="search-type" value="forum">
                    <label for="search-forum">Search Forum</label>
                </div>
                <div class="search-input-container">
                    <input type="text" id="search-input" name="search-input" placeholder="Search keywords">
                    <span class="search-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="grey" class="bi bi-search search-ic hover" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </span>
                </div>
                <button type="submit" class="search-now-button">Search Now</button>
            </form>
        </div>
    </div>
</header><!-- End Header -->

<script>
      function toggleSearchPopup() {
        var popup = document.getElementById("search-popup");
        popup.classList.toggle("show");

        // Set the placeholder text when the popup is shown
        if (popup.classList.contains("show")) {
            setSearchInputPlaceholder("Search keywords");
        }
    }

    // Function to set the placeholder text
    function setSearchInputPlaceholder(text) {
        var searchInput = document.getElementById("search-input");
        searchInput.placeholder = text;
    }
</script>
