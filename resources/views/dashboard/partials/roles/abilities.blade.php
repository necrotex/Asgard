<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                Abilities
            </div>

            <div class="card-body">
                <table class="table table-striped table-sm">
                    <tbody>
                    @foreach($role->abilities as $ability)
                        <tr>
                            <td>{{$ability->title}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>