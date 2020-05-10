<div class="col-md-4">
  <div class="card card-product card-plain no-shadow" data-colored-shadow="false">
    <div class="card-header card-header-image">
      <a href="#">
        <img src="../assets/img/examples/suit-1.jpg" alt="...">
      </a>
    </div>
    <div class="card-body">
      <a href="#">
        <h4 class="card-title">{{ product.modelo }}</h4>
      </a>
      <p class="description">
        {{ product.descripcion }}
      </p>
    </div>
    <div class="card-footer justify-content-between">
      <div class="price-container">
        <span class="price"> {{ product.montoCuota }} </span>
      </div>
      <button class="btn btn-rose btn-link btn-fab btn-fab-mini btn-round pull-right" rel="tooltip" title="" data-placement="left" data-original-title="Remove from wishlist">
        <i class="material-icons">favorite</i>
      </button>
    </div>
  </div>
  <!-- end card -->
</div>
