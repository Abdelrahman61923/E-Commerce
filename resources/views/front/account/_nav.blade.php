<div class="col-lg-2">
    <ul class="account-nav">
        <li><a href="{{ route('home') }}" class="menu-link menu-link_us-s">Dashboard</a></li>
        <li><a href="{{ route('user.orders') }}" class="menu-link menu-link_us-s {{ request()->routeIs('user.orders.*') ? 'menu-link_active' : '' }}">Orders</a></li>
        <li><a href="account-address.html" class="menu-link menu-link_us-s">Addresses</a></li>
        <li><a href="account-details.html" class="menu-link menu-link_us-s">Account Details</a></li>
        <li><a href="account-wishlist.html" class="menu-link menu-link_us-s">Wishlist</a></li>
        <li>
            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                @csrf
                <a href="#" class="menu-link menu-link_us-s" onclick="event.preventDefault(); this.closest('form').submit();">
                    Logout
                </a>
            </form>
        </li>
    </ul>
</div>
