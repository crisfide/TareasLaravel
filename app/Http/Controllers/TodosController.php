<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    //insert
    public function store(Request $request)  {
        $request->validate([
            "titulo"=>"required|min:3",
            "category_id" => "required|exists:categories,id"

        ]);

        $todo = new Todo();
        $todo->titulo = $request->titulo;
        $todo->category_id = $request->category_id;
        $todo->save();

        return redirect()->route("todos")->with("success","Tarea creada OK"); 

    }


    public function index() {
        return view("todos.index",["todos"=>Todo::all(), "categories"=>Category::all()]);
    }



    public function show($id) {
        return view("todos.show",["todo"=>Todo::find($id), "categories"=>Category::all()]);
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
