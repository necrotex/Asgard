<div class="row">
    <div class="col-md-10">
        <h5>Main Character</h5>

        <div class="card">
            <div class="card-body">

                @if(is_null($user->main_character))
                    <div class="alert alert-warning" role="alert">
                        You need to select your main character
                    </div>
                @endif

                <form method="post" action="{{route('profile.update', $user->id)}}">
                    {{csrf_field()}}

                    <select id="main_character" name="mainCharacter" class="form-control">
                        @foreach($user->characters as $character)
                            <option value="{{$character->id}}"
                                    @if($character->id == $user->main_character) selected @endif>
                                {{$character->name}}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $('#main_character').select2();
    </script>
@endpush
