<nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">


    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link {{active('home')}}" href="{{route('home')}}">Home</a>
        </li>
    </ul>

    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link {{active('corporation.index')}}" href="{{route('corporation.index')}}">Corporations</a>
        </li>


        <li class="nav-item">
            <a class="nav-link {{active('home')}}" href="{{route('home')}}">Access Management</a>
        </li>
    </ul>

    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link {{active('characters')}}" href="{{route('characters')}}">Characters</a>
        </li>
    </ul>


</nav>