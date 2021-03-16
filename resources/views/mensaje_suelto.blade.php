@extends('layouts.app')

<div class="container mt-2">
  @if(Auth::user()->darkMode)
    <div class="text-center text-white">
  @else
    <div class="text-center">
  @endif
      <div class="container alert alert-success">
        Momentáneamente la emisión de órdenes se realiza sólo en oficina o solicitándolas por whatsapp al 155-508247.
      </div>
    </div>
</div>
@endsection
