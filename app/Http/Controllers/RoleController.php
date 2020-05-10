<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;

class RoleController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:roles.index')->only('index');
    $this->middleware('can:roles.show')->only('show');
    $this->middleware('can:roles.destroy')->only('destroy');
    $this->middleware('can:roles.edit')->only(['edit','update']);
    $this->middleware('can:roles.create')->only(['create','store']);
  }

  public function index()
  {
    $roles = Role::paginate();
    return view('admin.role.index',compact("roles"));
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function show(Role $role)
  {
    $permissions = Permission::get();
    return view('admin.role.show', compact("role","permissions"));
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
    $role->create($request->all());

    $role->permissions()->sync($request->input('permissions'));

    return redirect()
      ->route('roles.edit',['role' => $role])
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
    $role->update($request->all());

    $role->permissions()->sync($request->input('permissions'));

    return redirect()
      ->route('roles.edit',['role' => $role])
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
