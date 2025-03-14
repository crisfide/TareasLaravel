@extends("app")


@section("content")

    <div class="container w-25 border p-4 mt-5">
        <form action="{{ route('todos-update',["id"=>$todo->id])}}" method="POST">
            @csrf
            @method("PATCH")

            @if (session("success"))
                <div class="alert alert-success">{{session("success")}}</div>
            @endif
                
            @error('titulo')
                <div class="alert alert-danger">{{$message}}</div>                
            @enderror

            <div class="mb-3">
                <label for="titulo" class="form-label">Título de la tarea</label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="{{$todo->titulo}}">

                <label for="category" class="form-label">Categoría</label>
                <select name="category_id" id="category" class="form-select">
                    @foreach ($categories as $cat)
                        <option value="{{$cat->id}}" @selected($cat->id === $todo->category_id)>{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">🖋️ Modificar tarea</button>
        </form>


    </div>





@endsection