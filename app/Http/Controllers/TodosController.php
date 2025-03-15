<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{


    public function index() {
        
        $user_id = auth()->user()->id;
        $todos = Todo::where("user_id","=",$user_id)->get();
        $cats = Category::where("user_id","=",$user_id)->get();

        return view("todos.index",["todos"=>$todos, "categories"=>$cats]);
    }

    //insert
    public function store(Request $request)  {
        $request->validate([
            "titulo"=>"required|min:3",
            "category_id" => "required|exists:categories,id"

        ]);

        $todo = new Todo();
        $todo->titulo = $request->titulo;
        $todo->category_id = $request->category_id;
        $todo->user_id = auth()->user()->id;
        $todo->save();

        return redirect()->route("todos")->with("success","Tarea creada OK"); 

    }





    public function show($id) {

        $todo = Todo::where("id", $id)
                ->where('user_id', auth()->id())
                ->firstOrFail(); // 404 si no existe

        $cats = Category::where("user_id","=",auth()->id())->get();

        return view("todos.show",["todo"=>$todo, "categories"=>$cats]);
    }


    public function update(Request $request, $id) {
        $request->validate([
            "titulo"=>"required|min:3",
            "category_id" => "required|exists:categories,id"

        ]);

        $todo = Todo::find($id);
        $todo->titulo = $request->titulo;
        $todo->category_id = $request->category_id;
        $todo->save();

        //dd($todo);

        return redirect()->route("todos")->with("success","Tarea editada OK"); 
    }

    public function destroy($id) {
        $todo = Todo::find($id);
        $todo->delete();
        
        return redirect()->route("todos")->with("success","Tarea eliminada OK"); 
    }
}
