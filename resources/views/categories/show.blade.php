@extends("app")


@section("content")

    <div class="container w-25 border p-4 mt-5">
        <form action="{{ route('categories-update',["id"=>$category->id])}}" method="POST">
            @csrf
            @method("PATCH")

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
                <input type="text" name="name" id="name" class="form-control" value="{{$category->name}}">

                <label for="color" class="form-label">Color de la categoría</label>
                <input type="color" name="color" id="color" class="form-control" value="{{$category->color}}">
            </div>
            <button type="submit" class="btn btn-primary">🖋️ Modificar categoría</button>
        </form>

        <div>
            <ul class="list-group mt-3">
                @foreach ($todos as $todo)
                <li class="list-group-item d-flex ">
                    <span class="me-auto">
                        {{$todo->titulo}}<br>
                        
                        <small style="color: gray; font-size:0.75rem">
                            <span class="px-1" style="background-color: {{$category->color}}"></span>
                              {{$category->name}}
                        </small>

                    </span>




                    <form action="{{route("todos-destroy",["id"=>$todo->id])}}" method="POST">
                        <a href="{{route("todos-show",["id"=>$todo->id])}}" class="btn">🖋️</a>
                    
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn">❌</button>
                    </form>
                </li>
                @endforeach

                @if (count($todos)===0)      
                <li class="list-group-item d-flex ">No hay tareas en esta categoría</li>
                @endif
            </ul>
        </div>

    </div>





@endsection