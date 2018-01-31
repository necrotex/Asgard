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
                            <td><a href="{{route('ability.destroy', $role->id)}}" class="btn btn-sm btn-danger">remove</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-2">
        <div class="card">
            <div class="card-header">
                Add Ability
            </div>

            <div class="card-body">
                <form action="{{route('ability.assign', $role)}}" method="post">
                    <div class="form-group">
                        <select id="ability-select" name="abilities[]" class="w-100" multiple="multiple">
                            @foreach($abilities as $ability)
                                <option value="{{$ability->name}}">{{$ability->title}}</option>
                            @endforeach
                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $('#ability-select').select2();
    </script>
@endpush