<div class="mt-3">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Corporation</th>
                <th scope="col">Entered</th>
                <th scope="col">Days</th>
            </tr>
        </thead>
        <tbody>

        @foreach($character->corporationHistory->reverse() as $entry)
            <tr>
                <td>
                    <img src="https://image.eveonline.com/Corporation/{{$entry->corporation_id}}_32.png" class="rounded-circle">

                    <a href="https://evewho.com/corp/{{str_replace(' ', '+', $entry->corporation_name)}}">
                        {{$entry->corporation_name}}
                    </a>
                </td>
                <td>{{$entry->start_date->toDateTimeString()}}</td>
                <td>
                    @if($loop->first)
                        {{$entry->start_date->diffInDays(\Carbon\Carbon::now())}}
                    @else
                        {{$entry->start_date->diffInDays($date)}}
                    @endif
                </td>
            </tr>

            @php
                $date = $entry->start_date;
            @endphp
        @endforeach

        </tbody>
    </table>
</div>