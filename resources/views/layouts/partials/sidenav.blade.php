<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">

        <ul class="nav flex-column">


            <li class="nav-item">
                <a class="nav-link {{active('home')}}" href="{{route('home')}}">
                    <i class="fa fa-home" aria-hidden="true"></i> Home
                </a>
            </li>

            @can('access', \Asgard\Models\Corporation::class)
            <li class="nav-item">
                <a class="nav-link {{active('corporation.index')}}" href="{{route('corporation.index')}}">
                    <i class="fa fa-users" aria-hidden="true"></i> Corporations
                </a>
            </li>
            @endcan

            <li class="nav-item">
                <a class="nav-link {{active('roles.index')}}" href="{{route('roles.index')}}">
                    <i class="fa fa-list" aria-hidden="true"></i> Roles
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{active('settings.index')}}" href="{{route('settings.index')}}">
                    <i class="fa fa-cog" aria-hidden="true"></i> Settings
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{active('characters.index')}}" href="{{route('characters.index')}}">
                    <i class="fa fa-user" aria-hidden="true"></i> Characters
                </a>
            </li>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>External Services</span>
            </h6>

            <li class="nav-item">
                <a class="nav-link {{active('services.discord.index')}}" href="">
                    <i class="fa fa-comment" aria-hidden="true"></i> Discord
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{active('services.reddit.index')}}"
                   href="{{route('services.reddit.index')}}">
                    <i class="fa fa-reddit" aria-hidden="true"></i> Reddit
                </a>
            </li>

        </ul>


    </div>
</nav>

