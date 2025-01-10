<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')

<body>
    <div class="container-fluid d-flex flex-column justify-content-center align-items-center" style="height: 100vh; width: 100vw;">
        <!-- Imagen que ocupa el 60% de la altura -->
        <div class="d-flex justify-content-center" style="height: 70%;">
            <img src="{{Storage::url('public/images/404.png')}}" alt="Imagen de error" class="img-fluid"
                style="max-width: 100%; max-height: 100%;">
        </div>

        <!-- Texto que ocupa el 40% restante -->
        <div class="text-center" style="height: 30%; width: 100%;">
            <h3 class="mb-4">Lo sentimos, no podemos encontrar la página que estás buscando.</h3>
            <a class="btn btn-primary" href="{{ url('/') }}">Volver a la página principal</a>
        </div>

    </div>
</body>

</html>