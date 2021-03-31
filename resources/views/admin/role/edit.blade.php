@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm"><br>
        <header class="centrado">
          <h4>Role</h4>
        </header>
        <div class="card-body">
          <form action="{{ route('roles.update', ['role' => $role]) }}" method="post">
            @method('PUT')
            @csrf
            <div class="row justify-content-server">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="name">Nombre</label>
                  <input type="text" class="form-control" name="name" value="{{ $role->name }}">
                  <h5 class="mt-2">Lista de Permisos</h5>
                  <div class="form-group">
                    <ul class="list-unstyled">
                      @foreach($permissions as $permission)
                        <li>
                          <label>
                              <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                  @isset($role->id)
                                    @if($role->permissions->contains($permission->id))
                                      checked=checked
                                    @endif
                                  @endisset
                                  >
                            {{ $permission->name }}
                          </label>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 text-right">
                <button class="btn btn-dark text-light" type="submit" name="button">Guardar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
