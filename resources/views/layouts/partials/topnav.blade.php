<body>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">

    <a class="navbar-brand col-sm-3 col-md-2 mr-0 brand-text" href="{{route('home')}}">{{config('app.name')}}</a>

    @if(auth()->user()->can('use-search'))
        <form method="POST" action="{{route('search')}}" class="w-100" id="search-form">
            {{csrf_field()}}
            <input class="form-control form-control-dark w-100" type="text" name="term" id="search" placeholder="Character Search" aria-label="Search">
        </form>
    @else
    <div class="w-100"></div>
    @endif

    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="{{route('profile.show', auth()->user())}}">
                @if(!is_null(auth()->user()->main_character))
                    {{auth()->user()->mainCharacter->name}}
                @else
                    My Profile
                @endif
            </a>
        </li>
    </ul>

    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="{{route('logout')}}">Sign out</a>
        </li>
    </ul>
</nav>