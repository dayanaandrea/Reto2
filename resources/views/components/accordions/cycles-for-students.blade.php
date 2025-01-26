<div class="accordion" id="accordionExample">
    @foreach ($cycles as $cycle)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button fs-5" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse{{$cycle->id}}" aria-expanded="true" aria-controls="collapse{{$cycle->id}}">
                        {{$cycle->name}} ({{$cycle->code}})
                    </button>
                </h2>
                <div id="collapse{{$cycle->id}}" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <div class="container mb-4">
                            <ol class="list-group list-group-numbered">
                                @foreach ($modules as $module)
                                    @if($module->cycle_id==$cycle->id)
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="container me-auto">
                                                <div class="row g-0 ms-2"> <!-- 'g-0' para eliminar los márgenes entre las columnas -->
                                                    <div class="col-md-6 fw-bold">{{$module->name}} ({{$module->code}})</div>
                                                    <div class="col-md-6">{{$module->user->name}} {{$module->user->lastname}} -
                                                        {{$module->user->email}}</div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
</div>