@extends("app")


@section("content")

    <div class="container w-25 border p-4 mt-5">
        <form action="{{ route('categories')}}" method="POST">
            @csrf

            @if (session("success"))
                <div class="alert alert-success">{{session("success")}}</div>
            @endif
                
            @error('name')
                <div class="alert alert-danger">{{$message}}</div>                
            @enderror                
            @error('color')
                <div class="alert alert-danger">{{$message}}</div>                
            @enderror

            <div class="mb-3">
                <label for="name" class="form-label">Nombre de la categoría</label>
                <input type="text" name="name" id="name" class="form-control">

                <label for="color" class="form-label">Color de la categoría</label>
                <input type="color" name="color" id="color" class="form-control">

            </div>
            <button type="submit" class="btn btn-primary">Crear nueva categoría</button>
        </form>

        <div>
            <ul class="list-group mt-3">
                @foreach ($categories as $cat)
                <li class="list-group-item d-flex ">
                    <span class="px-3" style="background-color: {{$cat->color}}">  </span>
                    <span class="ms-3 my-auto me-auto">{{$cat->name}}</span>
                    
                    <div>
                        <a href="{{route("categories-show",["id"=>$cat->id])}}" class="btn">🖋️</a>
                    
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#{{$cat->id}}">❌</button>
                    </div>
                </li>
                
                <!-- Modal -->
                <div class="modal fade" id="{{$cat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar categoría {{$cat->name}}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Seguro desea eliminar la categoría {{$cat->name}}? <br>
                                Se perderán todas las tareas asociadas a ella.<br><br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="{{route("categories-destroy",["id"=>$cat->id])}}" method="POST">                                
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                @endforeach
            </ul>
        </div>

    </div>





@endsection