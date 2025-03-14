<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {         
        return view("categories.index",["categories"=>Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required|unique:categories|max:255",
            "color"=>"required|max:7"
        ]);

        $cat = new Category();
        $cat->name = $request->name;
        $cat->color = $request->color;
        $cat->save();

        return redirect()->route("categories")->with("success","Categoría creada OK"); 
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todos = Todo::all()->where("category_id","=",$id);
        return view("categories.show",["category"=>Category::find($id), "todos"=>$todos]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    { }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name"=>"required|unique:categories|max:255",
            "color"=>"required|max:7"
        ]);
        
        $cat = Category::find($id);
        $cat->name = $request->name;
        $cat->color = $request->color;
        $cat->save();

        //dd($cat);

        return redirect()->route("categories")->with("success","Categoría editada OK"); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {        
        $cat = Category::find($id);
        $cat->todos()->each( fn ($todo) => $todo->delete() );

        $cat->delete();
        
        return redirect()->route("categories")->with("success","Categoría eliminada OK"); 
    }
}
