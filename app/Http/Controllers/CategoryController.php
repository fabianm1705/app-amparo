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
      $this->middleware('can:categories.index')->only('index');
      $this->middleware('can:categories.show')->only('show');
      $this->middleware('can:categories.destroy')->only('destroy');
      $this->middleware('can:categories.edit')->only(['edit','update']);
      $this->middleware('can:categories.create')->only(['create','store']);
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
        ->route('categories.show',['category' => $category])
        ->with('message','Categoría Registrada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
      return view('admin.category.show', compact("category"));
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
        ->route('categories.show',['category' => $category])
        ->with('message','Categoría Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
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
