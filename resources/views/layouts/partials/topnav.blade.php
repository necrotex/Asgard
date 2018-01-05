<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
    <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand" href="#">{{config('app.name')}}</a>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">

        </ul>

        <form class="form-inline mt-2 mt-md-0" method="post" action="{{route('logout')}}">
            {{csrf_field()}}
            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Logout</button>
        </form>
    </div>
</nav>