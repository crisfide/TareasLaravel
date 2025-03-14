@extends("app")


@section("content")

    <div class="container w-25 border p-4 mt-5">
        <form action="{{ route('todos')}}" method="POST">
            @csrf

            @if (session("success"))
                <div class="alert alert-success">{{session("success")}}</div>
            @endif
                
            @error('titulo')
                <div class="alert alert-danger">{{$message}}</div>                
            @enderror
            
            @error('category_id')            
                <div class="alert alert-danger">{{$message}}</div>      
            @enderror

            <div class="mb-3">
                <label for="titulo" class="form-label">Título de la tarea</label>
                <input type="text" name="titulo" id="titulo" class="form-control">
                
                <label for="category" class="form-label">Categoría</label>
                <select name="category_id" id="category" class="form-select">
                    <option selected disabled>--</option>
                    @foreach ($categories as $cat)
                        <option style="background-color: {{$cat->color}};" value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Crear nueva tarea</button>
        </form>

        <div>
            <ul class="list-group mt-3">
                @foreach ($todos as $todo)
                <li class="list-group-item d-flex ">
                    <span class="me-auto">
                        {{$todo->titulo}}<br>
                        @php
                        $catDelTodo = $categories->first( fn ($c) => $c->id===$todo->category_id)
                        @endphp
                        <small style="color: gray; font-size:0.75rem">
                            <span class="px-1" style="background-color: {{$catDelTodo->color}}"></span>
                              {{$catDelTodo->name}}
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
            </ul>
        </div>

    </div>





@endsection