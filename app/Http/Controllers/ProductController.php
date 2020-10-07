<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:products.index')->only('index');
      $this->middleware('can:products.show')->only('show');
      $this->middleware('can:products.destroy')->only('destroy');
      $this->middleware('can:products.edit')->only(['edit','update']);
      $this->middleware('can:products.create')->only(['create','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories = Category::orderBy('nombre','asc')->get();
      $products = Product::all();
      return view('admin.product.index',compact("products","categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::orderBy('nombre','asc')->where('activa',1)->get();
      return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if($request->hasFile('image_url')){
        $image_file=$request->file('image_url');
        $image_name=time().$image_file->getClientOriginalName();
        $image_file->move(public_path().'/images/products',$image_name);
      }
      if($request->hasFile('image_url2')){
        $image_file=$request->file('image_url2');
        $image_name2=time().$image_file->getClientOriginalName();
        $image_file->move(public_path().'/images/products',$image_name2);
      }
      if($request->hasFile('image_url3')){
        $image_file=$request->file('image_url3');
        $image_name3=time().$image_file->getClientOriginalName();
        $image_file->move(public_path().'/images/products',$image_name3);
      }

      $product = new Product;
      $product->modelo = $request->input('modelo');
      $product->empresa = $request->input('empresa');
      $product->descripcion = $request->input('descripcion');
      $product->costo = $request->input('costo');
      $product->montoCuota = 1; //irrelevante
      $product->cantidadCuotas = 1; //irrelevante
      $product->vigente = $request->input('vigente');
      $product->category_id = $request->input('category_id');
      $product->longDescription = $request->input('longDescription');
      $product->image_url = $image_name;
      $product->image_url2 = $image_name2;
      $product->image_url3 = $image_name3;

      $product->save();

      return redirect()
        ->route('products.index')
        ->with('message','Producto Registrado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($productId)
    {
      $product = Product::find($productId);
      registro_acceso(7,$product->modelo);
      $payment_methods = PaymentMethod::where('activo',1)->get();
      $categories = Category::orderBy('nombre','asc')->where('activa',1)->get();
      return view('admin.product.show', compact("product","categories","payment_methods"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
      $categories = Category::orderBy('nombre','asc')->get();
      return view('admin.product.edit', compact("product","categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
      if($request->hasFile('image_url')){
        $image_file=$request->file('image_url');
        $image_name=time().$image_file->getClientOriginalName();
        $image_file->move(public_path().'/images/products',$image_name);
        $product->image_url = $image_name;
      }
      if($request->hasFile('image_url2')){
        $image_file=$request->file('image_url2');
        $image_name2=time().$image_file->getClientOriginalName();
        $image_file->move(public_path().'/images/products',$image_name2);
        $product->image_url2 = $image_name2;
      }
      if($request->hasFile('image_url3')){
        $image_file=$request->file('image_url3');
        $image_name3=time().$image_file->getClientOriginalName();
        $image_file->move(public_path().'/images/products',$image_name3);
        $product->image_url3 = $image_name3;
      }

      $product->modelo = $request->input('modelo');
      $product->empresa = $request->input('empresa');
      $product->descripcion = $request->input('descripcion');
      $product->costo = $request->input('costo');
      $product->montoCuota = 1; //irrelevante
      $product->cantidadCuotas = 1; //irrelevante
      $product->category_id = $request->input('category_id');
      $product->vigente = $request->input('vigente');
      $product->longDescription = $request->input('longDescription');

      $product->save();

      return redirect()
        ->route('products.index',['product' => $product])
        ->with('message','Producto Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
      $product->delete();
      return redirect()
        ->route('products.index');
    }

    public function shopping()
    {
      registro_acceso(5,'');
      $payment_methods = DB::table('payment_methods')->where('activo',1)->orderBy('cant_cuotas')->get();
      $categories = Category::inRandomOrder()->where('activa',1)->get();
      return view('admin.product.shopping', compact("categories","payment_methods"));
    }

    public function getProductsXCategory($id)
    {
      if($id==0){
        $products = DB::table('products')->where('vigente', '=', 1)->orderBy('costo')->get();
      }else{
        $category = Category::find($id);
        registro_acceso(6,$category->nombre);
        $products = DB::table('products')
              ->where([
                        ['category_id', '=', $id],
                        ['vigente', '=', 1],
                      ])->orderBy('costo')->get();
      }
      return $products;
    }
}
