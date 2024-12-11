<ul>
  @foreach ($users as $user)
    <li>
      {{$user->apellidos}}, {{$user->nombre}}
    </li>
  @endforeach
</ul>