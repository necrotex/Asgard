<div class="mt-3">
    <div class="row">
        <div class="col-3">
            <div class="nav flex-column nav-pills" id="pills-tab" role="tablist" aria-orientation="vertical">
                @foreach($category->groups as $group)
                        <a class="nav-link" id="pills-{{$group->groupName}}-tab" data-toggle="pill" href="#pills-{{$group->groupName}}" role="tab" aria-controls="{{$group->groupName}}" aria-selected="true">{{$group->groupName}}</a>
                 @endforeach

            </div>
        </div>
        <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">

                @foreach($category->groups as $group)
                    <div class="tab-pane fade" id="pills-{{$group->groupName}}" role="tabpanel" aria-labelledby="pills-{{$group->groupName}}-tab">
                        <ul class="list-group">
                            @foreach($character->skills()->byGroup($group->groupID)->get() as $skill)
                                <li class="list-group-item">
                                    {{$skill->typeName}} - {{$skill->trained_skill_level}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>