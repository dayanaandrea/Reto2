<div class="accordion" id="accordionExample">
    @foreach ($modules as $module)
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$module->id}}" aria-expanded="true" aria-controls="collapse{{$module->id}}">
                {{$module->name}} ({{$module->cycle->code}}{{$module->course}})
            </button>
        </h2>
        <div id="collapse{{$module->id}}" class="accordion-collapse collapse show">
            <div class="accordion-body">
                <ol class="list-group list-group-numbered">
                    @foreach ($module->enrollments as $enrollment)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">{{$enrollment->user->name}} {{$enrollment->user->lastname}}</div>
                            {{$enrollment->user->email}}
                        </div>
                    </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
    @endforeach
</div>