<style>
    .profile_picture {
        margin-bottom: 0 !important;
        width: 30px;
        height: 30px;
        background: #ddd;
        color: #000;
        text-align: center;
        border-radius: 50%;
        font-size: 21px;
        margin-top: 5px;
        cursor: pointer;
    }

    .dropdown-toggle::after {
        display: none;
    }

    .dropdown-menu {
        left: -123px !important;
    }
</style>
<nav class="navbar navbar-expand-lg text-light bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img height="30" src="{{ URL::asset('image/team1-consultancy1.png') }}" alt="Team1">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto ">
                <li class="nav-item">
                    <a class="nav-link active text-light" aria-current="page"
                        href="{{ route('catalog.home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Services</a>
                </li>
                <li class="nav-item">
                    @if (session('isUser'))
                    {{-- {{ dd(session('isUser')); }} --}}
                        <div class="dropdown">
                            @if (null != session('userImage'))
                                <img height="30" class="profile_picture dropdown-toggle" width="30"
                                    data-bs-toggle="dropdown" aria-expanded="false"
                                    src="{{ session('userImage') ?? URL::asset('image/team1-consultancy1.png') }}"
                                    alt="">
                            @else
                                <p class="mb-0 profile_picture ms-2 dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">{{ substr(session('userName'), 0, 1) }}</p>
                            @endif

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('catalog.logout') }}">Logout</a></li>
                            </ul>
                        </div>
                    @elseif (session('isAdmin'))
                        <div class="dropdown">
                            @if (null != session('userImage'))
                                <img height="30" class="profile_picture dropdown-toggle" width="30"
                                    data-bs-toggle="dropdown" aria-expanded="false"
                                    src="{{ session('userImage') ?? URL::asset('image/team1-consultancy1.png') }}"
                                    alt="">
                            @else
                                <p class="mb-0 profile_picture ms-2 dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">{{ substr(session('userName'), 0, 1) }}</p>
                            @endif

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
                            </ul>
                        </div>
                    @else
                        <a class="nav-link text-light" href="{{ route('catalog.login') }}">Login</a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
