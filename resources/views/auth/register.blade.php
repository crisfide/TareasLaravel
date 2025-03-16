<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite(['resources/js/app.js'])

    <title>Registrarse</title>
</head>
<body>
    
    <div class="container w-25 border p-4 mt-5">
        <form action="/register" method="POST">
            @csrf

            @error('name') <div class="text-danger mt-3">{{ $message }}</div> @enderror
            <input class="form-control" type="text" name="name" id="name" placeholder="Nombre">

            @error('email') <div class="text-danger mt-3">{{ $message }}</div> @enderror
            <input class="form-control" type="email" name="email" id="email" placeholder="E-mail">
            
            @error('password') <div class="text-danger mt-3">{{ $message }}</div> @enderror
            <input class="form-control" type="password" name="password" id="password" placeholder="Contraseña">

            @error('password_confirmation') <div class="text-danger mt-3">{{ $message }}</div> @enderror
            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Repetir contraseña">

            <br>
            <input type="submit" class="btn btn-outline-light" value="Registrarse">
        </form>

        <br>
        @include("auth.google")
        <br>
        <br>
        @include("auth.fb")
    </div>









    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>