<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid container-md">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-white">
                <li class="nav-item text-white">
                    <a @class(["nav-link text-white", 'active' => $routeName == 'users.index'])  href="{{route('users.index')}}">Users</a>
                </li>
                <li class="nav-item">
                    <a @class(["nav-link text-white", 'active' => $routeName == 'deleted-user.index']) href="{{route('deleted-user.index')}}?is-trashed-user=yes">Deleted Users</a>
                </li>
            </ul>
            <div class="d-flex" role="search">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-white">
                    <li class="nav-item text-white">
                        <a class="nav-link text-white" href="{{route('users.show',auth()->id())}}">
                            Welcome <strong>{{auth()->user()->name}}</strong>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="{{route('logout')}}" title="logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
