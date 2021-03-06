<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:navegar categorias')->only('index');
      $this->middleware('can:eliminar categorias')->only('destroy');
      $this->middleware('can:editar categorias')->only(['edit','update']);
      $this->middleware('can:crear categorias')->only(['create','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $categories = Category::orderBy('nombre','asc')->get();

      if($request->ajax()){
        return $categories->toJson();
      }

      return view('admin.category.index',compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $category = new Category();
      $category->nombre = $request->input('nombre');
      $category->activa = $request->input('activa');

      $category->save();

      return redirect()
        ->route('categories.index')
        ->with('message','Categoría Registrada');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
      return view('admin.category.edit', compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
      $category->nombre = $request->input('nombre');
      $category->activa = $request->input('activa');

      $category->save();

      return redirect()
        ->route('categories.index')
        ->with('message','Categoría Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $category = Category::find($id);
      $category->delete();
      return redirect()
        ->route('categories.index');
    }

    public function getCategories(Request $request)
    {
      $categories = Category::where('activa', 1)
        ->get();
      if($request->ajax()){
        return $categories->toJson();
      }
      return view('productsList', compact("categories"));
    }

}
