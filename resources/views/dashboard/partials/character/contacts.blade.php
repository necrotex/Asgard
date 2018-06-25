<div class="mt-3">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Contact</th>
            <th scope="col">Standing</th>
            <th scope="col">Label</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>

        @foreach($character->contacts()->orderBy('label')->get() as $contact)
            @php
                $class = 'light';

                if($contact->standing == 10) $class = 'primary';
                if($contact->standing >= 5 && $contact->standing < 10) $class = 'info';
                if($contact->standing >= -5 && $contact->standing < 5) $class = 'light';
                if($contact->standing >= -5 && $contact->standing < -10) $class = 'warning';
                if($contact->standing == -10) $class = 'danger';
            @endphp

            <tr class="table-{{$class}}">
                <td>
                    @switch($contact->contact_type)

                        @case('character')
                            <img src="https://image.eveonline.com/Character/{{$contact->contact_id}}_32.jpg" class="rounded-circle">
                        @break

                        @case('corporation')
                            <img src="https://image.eveonline.com/Corporation/{{$contact->contact_id}}_32.png" class="rounded-circle">
                        @break

                        @case('alliance')
                            <img src="https://image.eveonline.com/Alliance/{{$contact->contact_id}}_32.png" class="rounded-circle">
                        @break

                    @endswitch

                        {{$contact->name}}
                </td>


                <td>{{ number_format($contact->standing, 1)}}</td>
                <td>{{$contact->label}}</td>
                <td>
                    @switch($contact->contact_type)

                        @case('character')
                            <a href="https://zkillboard.com/character/{{$contact->contact_id}}/" title="zKillboard">
                                <i class="asgard-icon asgard-icon-zkill"></i>
                            </a>
                            <a href="https://evewho.com/pilot/{{str_replace(' ', '+', $contact->name)}}" title="EveWho">
                                <i class="asgard-icon asgard-icon-evewho"></i>
                            </a>
                        @break

                        @case('corporation')
                            <a href="https://zkillboard.com/corporation/{{$contact->contact_id}}/" title="zKillboard">
                                <i class="asgard-icon asgard-icon-zkill"></i>
                            </a>
                            <a href="https://evewho.com/corporation/{{str_replace(' ', '+', $contact->name)}}" title="EveWho">
                                <i class="asgard-icon asgard-icon-evewho"></i>
                            </a>
                        @break

                        @case('alliance')
                            <a href="https://zkillboard.com/alliance/{{$contact->contact_id}}/" title="zKillboard">
                                <i class="asgard-icon asgard-icon-zkill"></i>
                            </a>
                            <a href="https://evewho.com/alliance/{{str_replace(' ', '+', $contact->name)}}" title="EveWho">
                                <i class="asgard-icon asgard-icon-evewho"></i>
                            </a>
                        @break

                    @endswitch

                </td>
            </tr>

        @endforeach

        </tbody>
    </table>
</div>