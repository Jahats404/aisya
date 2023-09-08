<nav class="navbar navbar-expand">
    <div class="collapse navbar-collapse justify-content-between">
        <div class="header-left">
            {{-- <div class="search_bar dropdown">
                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                    <i class="mdi mdi-magnify"></i>
                </span>
                <div class="dropdown-menu p-0 m-0">
                    <form>
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                    </form>
                </div>
            </div> --}}
        </div>

        <ul class="navbar-nav header-right">
            {{-- <li class="nav-item dropdown notification_dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                    <i class="mdi mdi-bell"></i>
                    <div class="pulse-css"></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <ul class="list-unstyled">
                        <li class="media dropdown-item">
                            <span class="success"><i class="ti-user"></i></span>
                            <div class="media-body">
                                <a href="#">
                                    <p><strong>Martin</strong> has added a <strong>customer</strong> Successfully
                                    </p>
                                </a>
                            </div>
                            <span class="notify-time">3:20 am</span>
                        </li>
                        <li class="media dropdown-item">
                            <span class="primary"><i class="ti-shopping-cart"></i></span>
                            <div class="media-body">
                                <a href="#">
                                    <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                </a>
                            </div>
                            <span class="notify-time">3:20 am</span>
                        </li>
                        <li class="media dropdown-item">
                            <span class="danger"><i class="ti-bookmark"></i></span>
                            <div class="media-body">
                                <a href="#">
                                    <p><strong>Robin</strong> marked a <strong>ticket</strong> as unsolved.
                                    </p>
                                </a>
                            </div>
                            <span class="notify-time">3:20 am</span>
                        </li>
                        <li class="media dropdown-item">
                            <span class="primary"><i class="ti-heart"></i></span>
                            <div class="media-body">
                                <a href="#">
                                    <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                </a>
                            </div>
                            <span class="notify-time">3:20 am</span>
                        </li>
                        <li class="media dropdown-item">
                            <span class="success"><i class="ti-image"></i></span>
                            <div class="media-body">
                                <a href="#">
                                    <p><strong> James.</strong> has added a<strong>customer</strong> Successfully
                                    </p>
                                </a>
                            </div>
                            <span class="notify-time">3:20 am</span>
                        </li>
                    </ul>
                    <a class="all-notification" href="#">See all notifications <i
                            class="ti-arrow-right"></i></a>
                </div>
            </li> --}}
            <li class="nav-item dropdown header-profile">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                    @if (Auth()->user()->url)
                    <img src="{{ Auth()->user()->url }}" alt="user-avatar" class="d-block mr-3 rounded-circle mb-3" height="100" width="100" id="uploadedAvatar" />
                    @else
                    <img src="http://localhost:8000/storage/img-profile/profile.png" alt="user-avatar" class="d-block mr-3 rounded-circle mb-3" height="100" width="100" id="uploadedAvatar" />
                    @endif
                    
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    @if (auth()->user()->role_id == 2)    
                        <a href="{{ route('m.profile') }}" class="dropdown-item">
                            <i class="icon-user"></i>
                            <span class="ml-2">Profile </span>
                        </a>
                    @endif
                    {{-- <a href="./email-inbox.html" class="dropdown-item">
                        <i class="icon-envelope-open"></i>
                        <span class="ml-2">Inbox </span>
                    </a> --}}
                    <a href="{{ route('actionlogout') }}" class="dropdown-item">
                        <i class="icon-key"></i>
                        <span class="ml-2">Logout </span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>