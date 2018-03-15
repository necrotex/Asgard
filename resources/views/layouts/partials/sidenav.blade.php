<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">

        <ul class="nav flex-column">


            <li class="nav-item">
                <a class="nav-link {{active('home')}}" href="{{route('home')}}">
                    <i class="fas fa-home" aria-hidden="true"></i> Home
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{active('characters.index')}}" href="{{route('characters.index')}}">
                    <i class="fas fa-user" aria-hidden="true"></i> Characters
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-clock" aria-hidden="true"></i> Timerboard
                </a>
            </li>


            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Admin</span>
            </h6>

            @can('index', \Asgard\Models\Setting::class)
                <li class="nav-item">
                    <a class="nav-link {{active('settings.index')}}" href="{{route('settings.index')}}">
                        <i class="fas fa-cog" aria-hidden="true"></i> Settings
                    </a>
                </li>
            @endcan

            @can('index', \Silber\Bouncer\Database\Role::class)
                <li class="nav-item">
                    <a class="nav-link {{active('roles.index')}}" href="{{route('roles.index')}}">
                        <i class="fas fa-list" aria-hidden="true"></i> Roles
                    </a>
                </li>
            @endcan

            @can('index', \Asgard\Models\Corporation::class)
                <li class="nav-item">
                    <a class="nav-link {{active('corporation.index')}}" href="{{route('corporation.index')}}">
                        <i class="fas fa-users" aria-hidden="true"></i> Corporations
                    </a>
                </li>
            @endcan


            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>External Services</span>
            </h6>

            @can('index', \Asgard\Models\DiscordUser::class)
                <li class="nav-item">
                    <a class="nav-link" href="https://discord.gg/rJmM22D">
                        <i class="fab fa-discord" aria-hidden="true"></i> Discord
                    </a>
                </li>
            @endcan

            <li class="nav-item">
                <a class="nav-link {{active('services.reddit.index')}}"
                   href="{{route('services.reddit.index')}}">
                    <i class="fab fa-reddit-alien" aria-hidden="true"></i> Reddit
                </a>
            </li>

        </ul>


    </div>
</nav>

