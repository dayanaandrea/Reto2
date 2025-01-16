<div class="accordion" id="accordionExample">
    @foreach ($cycles as $cycle)
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$cycle->id}}" aria-expanded="true" aria-controls="collapse{{$cycle->id}}">
                {{$cycle->name}} ({{$cycle->code}})
            </button>
        </h2>
        <div id="collapse{{$cycle->id}}" class="accordion-collapse collapse show">
            <div class="accordion-body">
                <div class="container mb-4">
                    <h5>Primer Curso</h5>
                    
                    <ol class="list-group list-group-numbered">
                        @foreach ($cycle->modules as $module)
                        @if($module->course==1)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                
                                <div class="fw-bold">{{$module->name}} ({{$module->code}})</div>
                                
                            </div>
                        </li>
                        @endif
                        @endforeach
                    </ol>
                </div>
                <div class="container">
                    <h5>Segundo Curso</h5>
                    <ol class="list-group list-group-numbered">
                        @foreach ($cycle->modules as $module)
                        @if($module->course==2)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">{{$module->name}} ({{$module->code}})</div>
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