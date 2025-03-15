<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Iniciar Sesión</title>
</head>
<body>
    
    <div class="container w-25 border p-4 mt-5">
        <form action="/login" method="POST">
            @csrf

            @error('auth.fail') <div class="text-danger mt-3">{{ $message }}</div> @enderror

            @error('name') <div class="text-danger mt-3">{{ $message }}</div> @enderror
            <input class="form-control" type="text" name="name" id="name" placeholder="Nombre o E-mail">
            
            @error('password') <div class="text-danger mt-3">{{ $message }}</div> @enderror
            <input class="form-control" type="password" name="password" id="password" placeholder="Contraseña">

            <br>
            <div class="d-flex justify-content-between">
                <input type="submit" value="Iniciar Sesión">
                <a href="{{route("register")}}">Registrarse</a>
            </div>

        </form>
    </div>









    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>