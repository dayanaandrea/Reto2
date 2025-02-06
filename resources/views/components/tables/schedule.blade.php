<table class="table table-bordered table-responsive">
    <thead>
        <tr>
            <th></th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
        </tr>
    </thead>
    <tbody>
        @foreach(range(1, 5) as $hour)
            <tr>
                <th>{{ $hour }}</th>

                @foreach(range(1, 5) as $day)
                    <td>
                        @foreach($schedules as $schedule)
                            @if($schedule->day == $day && $schedule->hour == $hour)
                                {{ $schedule->module->code }}
                            @endif
                        @endforeach
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>