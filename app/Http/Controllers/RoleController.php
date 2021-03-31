<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:navegar roles')->only('index');
    $this->middleware('can:eliminar roles')->only('destroy');
    $this->middleware('can:editar roles')->only(['edit','update']);
    $this->middleware('can:crear roles')->only(['create','store']);
  }

  public function index()
  {
    $roles = Role::paginate();
    return view('admin.role.index',compact("roles"));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function create(Role $role)
  {
    $permissions = Permission::get();
    return view('admin.role.create', compact("role","permissions"));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Role $role)
  {
    $role = Role::create(['name' => $request->input('name')]);

    $role->syncPermissions($request->input('permissions'));

    return redirect()
      ->route('roles.index',['role' => $role])
      ->with('message','Role Cargado');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function edit(Role $role)
  {
    $permissions = Permission::get();
    return view('admin.role.edit', compact("role","permissions"));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Role $role)
  {
    $role->name = $request->input('name');

    $role->syncPermissions($request->input('permissions'));

    return redirect()
      ->route('roles.index',['role' => $role])
      ->with('message','Role Actualizado');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function destroy(Role $role)
  {
    $role->delete();
    return redirect()
      ->route('roles.index');
  }

}
