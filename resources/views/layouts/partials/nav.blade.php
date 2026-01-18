<div class="header-dashboard">
    <div class="wrap">
        <div class="header-left">
            <a href="index-2.html">
                <img class="" id="logo_header_mobile" alt="" src="{{ asset('images/logo/logo.png') }}"
                    data-light="images/logo/logo.png" data-dark="images/logo/logo.png" data-width="154px"
                    data-height="52px" data-retina="images/logo/logo.png">
            </a>
            <div class="button-show-hide">
                <i class="icon-menu-left"></i>
            </div>


            <form class="form-search flex-grow">
                <fieldset class="name">
                    <input type="text" placeholder="Search here..." class="show-search" name="name"
                        id="search-input" tabindex="2" value="" aria-required="true" required=""
                        autocomplete="off">
                </fieldset>
                <div class="button-submit">
                    <button class="" type="submit"><i class="icon-search"></i></button>
                </div>
                <div class="box-content-search">
                    <ul id="box-content-search">

                    </ul>
                </div>
            </form>

        </div>
        <div class="header-grid">

            <x-dashboard.notifications-menu count="6" />

            <div class="popup-wrap user type-header">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="header-user wg-user">
                            <span class="image">
                                <img src="{{ asset('images/avatar/user-1.png') }}" alt="">
                            </span>
                            <span class="flex flex-column">
                                <span class="body-title mb-2">{{ Auth::User()->name }}</span>
                                <span class="text-tiny">{{ Auth::User()->type }}</span>
                            </span>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton3">
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-user"></i>
                                </div>
                                <div class="body-title-2">Account</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-mail"></i>
                                </div>
                                <div class="body-title-2">Inbox</div>
                                <div class="number">27</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-file-text"></i>
                                </div>
                                <div class="body-title-2">Taskboard</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-headphones"></i>
                                </div>
                                <div class="body-title-2">Support</div>
                            </a>
                        </li>
                        <li>
                            <form id="logout-form-nav" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            <a href="#" class="user-item"
                                onclick="event.preventDefault(); document.getElementById('logout-form-nav').submit();">
                                <div class="icon">
                                    <i class="icon-log-out"></i>
                                </div>
                                <div class="body-title-2">Log out</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
