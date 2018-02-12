<div class="row">
    <div class="col-md-10">


        <div class="card mb-3">
            <div class="card-header">
                Main Character
            </div>
            <div class="card-body">

                @if(is_null($user->main_character))
                    <div class="alert alert-warning" role="alert">
                        You need to select your main character
                    </div>
                @endif

                <form method="post" action="{{route('profile.update', $user->id)}}">
                    {{csrf_field()}}

                    <select id="main_character" name="mainCharacter" class="w-100">
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
