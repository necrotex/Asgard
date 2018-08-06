<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">

        <ul class="nav flex-column">

            <li class="nav-item">
                <a class="nav-link {{active('home')}}" href="{{route('home')}}">
                    <i class="fas fa-home" aria-hidden="true"></i> Home
                </a>
            </li>

            @can('create', \Asgard\Models\Character::class)
                <li class="nav-item">
                    <a class="nav-link {{active('characters.index')}}" href="{{route('characters.index')}}">
                        <i class="fas fa-user" aria-hidden="true"></i> Characters
                    </a>
                </li>
            @endcan

            @can('create', \Asgard\Models\Timer::class)
                <li class="nav-item">
                    <a class="nav-link" href="{{route('timerboard.index')}}">
                        <i class="fas fa-clock" aria-hidden="true"></i> Timerboard
                    </a>
                </li>
            @endcan

            @if(auth()->user()->can('view', \Asgard\Models\Setting::class)
            || auth()->user()->can('create', \Silber\Bouncer\Database\Role::class)
            || auth()->user()->can('create', \Asgard\Models\Corporation::class)
            || auth()->user()->can('view-job-monitoring')
            || auth()->user()->can('see-profiles')
            )
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Admin</span>
            </h6>
            @endif

            @can('see-profiles')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('users.overview')}}">
                        <i class="fas fa-users" aria-hidden="true"></i> Users
                    </a>
                </li>
            @endcan

            @can('view', \Asgard\Models\Setting::class)
                <li class="nav-item">
                    <a class="nav-link {{active('settings.index')}}" href="{{route('settings.index')}}">
                        <i class="fas fa-cog" aria-hidden="true"></i> Settings
                    </a>
                </li>
            @endcan

            @can('create', \Silber\Bouncer\Database\Role::class)
                <li class="nav-item">
                    <a class="nav-link {{active('roles.index')}}" href="{{route('roles.index')}}">
                        <i class="fas fa-list" aria-hidden="true"></i> Roles
                    </a>
                </li>
            @endcan

            @can('create', \Asgard\Models\Corporation::class)
                <li class="nav-item">
                    <a class="nav-link {{active('corporation.index')}}" href="{{route('corporation.index')}}">
                        <i class="fas fa-users" aria-hidden="true"></i> Corporations
                    </a>
                </li>
            @endcan

            @can('view-job-monitoring')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('horizon.index')}}">
                        <i class="fas fa-wrench" aria-hidden="true"></i> Job Monitoring
                    </a>
                </li>
            @endcan

            @if(auth()->user()->can('create', \Asgard\Models\ApplicationForm::class)
            || auth()->user()->can('view-application')
            || auth()->user()->can('create', \Asgard\Models\Application::class)
            || auth()->user()->can('view-knowledgebase')
            )
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Recruitment</span>
            </h6>
            @endif

            @can('create', \Asgard\Models\ApplicationForm::class)
                <li class="nav-item">
                    <a class="nav-link {{active('forms.index')}}" href="{{route('forms.index')}}">
                        <i class="fab fa-wpforms" aria-hidden="true"></i> Application Forms
                    </a>
                </li>
            @endcan

            @can('view-application')
                <li class="nav-item">
                    <a class="nav-link {{active('applications.index')}}" href="{{route('applications.index')}}">
                        <i class="fas fa-user-plus" aria-hidden="true"></i> Applications
                    </a>
                </li>
            @endcan

            @can('create', \Asgard\Models\Application::class)
                <li class="nav-item">
                    <a class="nav-link {{active('applications.create')}}" href="{{route('applications.create')}}">
                        <i class="fas fa-user-plus" aria-hidden="true"></i> Apply
                    </a>
                </li>
            @endif

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>External Services</span>
            </h6>


            <li class="nav-item">
                <a class="nav-link" href="https://discord.gg/rJmM22D">
                    <i class="fab fa-discord" aria-hidden="true"></i> Discord
                </a>
            </li>

            @can('access-subreddit')
                <li class="nav-item">
                    <a class="nav-link {{active('services.reddit.index')}}"
                       href="{{route('services.reddit.index')}}">
                        <i class="fab fa-reddit-alien" aria-hidden="true"></i> Reddit
                    </a>
                </li>
            @endcan

        </ul>

        <div class="text-center w-100 position-absolute" style="bottom: 0">
            <small class="text-muted">{{config('app.version')}} - {{config('app.hash')}}</small>
        </div>

    </div>
</nav>

