<div>
  @if(Auth::user()->darkMode)
    <div class="d-flex text-white">
      <div style="vertical-align: top">Carrito</div>
      <i class="material-icons" style="color: white">shopping_cart</i>{{ $count }}
    </div>
  @else
    <div class="d-flex">
      <div style="vertical-align: top">Carrito</div>
      <i class="material-icons">shopping_cart</i>{{ $count }}
    </div>
  @endif
</div>
