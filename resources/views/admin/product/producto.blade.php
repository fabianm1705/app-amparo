@extends('layouts.app')

@section('content')
  <html lang="en">

  <head>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/material-kit.css?v=2.1.0" rel="stylesheet" />
  </head>

  <body class="product-page sidebar-collapse">
    <div class="page-header header-filter" data-parallax="true" filter-color="rose" style="background-image: url('../assets/img/bg6.jpg');">
      <div class="container">
        <div class="row title-row">
          <div class="col-md-4 ml-auto">
            <button class="btn btn-white float-right"><i class="material-icons">shopping_cart</i> 0 Items</button>
          </div>
        </div>
      </div>
    </div>
    <div class="section section-gray">
      <div class="container">
        <div class="main main-raised main-product">
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="tab-content">
                <div class="tab-pane" id="product-page1">
                  <img src="../assets/img/examples/product1.jpg">
                </div>
                <div class="tab-pane active" id="product-page2">
                  <img src="../assets/img/examples/product2.jpg">
                </div>
                <div class="tab-pane" id="product-page3">
                  <img src="../assets/img/examples/product3.jpg">
                </div>
                <div class="tab-pane" id="product-page4">
                  <img src="../assets/img/examples/product4.jpg">
                </div>
              </div>
              <ul class="nav flexi-nav" data-tabs="tabs" id="flexiselDemo1">
                <li class="nav-item">
                  <a href="#product-page1" class="nav-link" data-toggle="tab">
                    <img src="../assets/img/examples/product1.jpg">
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#product-page2" class="nav-link" data-toggle="tab">
                    <img src="../assets/img/examples/product2.jpg">
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#product-page3" class="nav-link" data-toggle="tab">
                    <img src="../assets/img/examples/product3.jpg">
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#product-page4" class="nav-link" data-toggle="tab">
                    <img src="../assets/img/examples/product4.jpg">
                  </a>
                </li>
              </ul>
            </div>
            <div class="col-md-6 col-sm-6">
              <h2 class="title"> Becky Silk Blazer </h2>
              <h3 class="main-price">$335</h3>
              <div id="accordion" role="tablist">
                <div class="card card-collapse">
                  <div class="card-header" role="tab" id="headingOne">
                    <h5 class="mb-0">
                      <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Description
                        <i class="material-icons">keyboard_arrow_down</i>
                      </a>
                    </h5>
                  </div>
                  <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                      <p>Eres&apos; daring &apos;Grigri Fortune&apos; swimsuit has the fit and coverage of a bikini in a one-piece silhouette. This fuchsia style is crafted from the label&apos;s sculpting peau douce fabric and has flattering cutouts through the torso and back. Wear yours with mirrored sunglasses on vacation.</p>
                    </div>
                  </div>
                </div>
                <div class="card card-collapse">
                  <div class="card-header" role="tab" id="headingTwo">
                    <h5 class="mb-0">
                      <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Designer Information
                        <i class="material-icons">keyboard_arrow_down</i>
                      </a>
                    </h5>
                  </div>
                  <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                      An infusion of West Coast cool and New York attitude, Rebecca Minkoff is synonymous with It girl style. Minkoff burst on the fashion scene with her best-selling &apos;Morning After Bag&apos; and later expanded her offering with the Rebecca Minkoff Collection - a range of luxe city staples with a &quot;downtown romantic&quot; theme.
                    </div>
                  </div>
                </div>
                <div class="card card-collapse">
                  <div class="card-header" role="tab" id="headingThree">
                    <h5 class="mb-0">
                      <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Details and Care
                        <i class="material-icons">keyboard_arrow_down</i>
                      </a>
                    </h5>
                  </div>
                  <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                      <ul>
                        <li>Storm and midnight-blue stretch cotton-blend</li>
                        <li>Notch lapels, functioning buttoned cuffs, two front flap pockets, single vent, internal pocket</li>
                        <li>Two button fastening</li>
                        <li>84% cotton, 14% nylon, 2% elastane</li>
                        <li>Dry clean</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row pick-size">
                <div class="col-md-6 col-sm-6">
                  <label>Select color</label>
                  <select class="selectpicker" data-style="select-with-transition" data-size="7">
                    <option value="1">Rose </option>
                    <option value="2">Gray</option>
                    <option value="3">White</option>
                  </select>
                </div>
                <div class="col-md-6 col-sm-6">
                  <label>Select size</label>
                  <select class="selectpicker" data-style="select-with-transition" data-size="7">
                    <option value="1">Small </option>
                    <option value="2">Medium</option>
                    <option value="3">Large</option>
                  </select>
                </div>
              </div>
              <div class="row pull-right">
                <button class="btn btn-rose btn-round">Add to Cart &#xA0;<i class="material-icons">shopping_cart</i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="features text-center">
          <div class="row">
            <div class="col-md-4">
              <div class="info">
                <div class="icon icon-info">
                  <i class="material-icons">local_shipping</i>
                </div>
                <h4 class="info-title">2 Days Delivery </h4>
                <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="info">
                <div class="icon icon-success">
                  <i class="material-icons">verified_user</i>
                </div>
                <h4 class="info-title">Refundable Policy</h4>
                <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="info">
                <div class="icon icon-rose">
                  <i class="material-icons">favorite</i>
                </div>
                <h4 class="info-title">Popular Item</h4>
                <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="../assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
    <script src="../assets/js/plugins/moment.min.js"></script>
    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <!--  Google Maps Plugin  -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="../assets/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>
    <!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="../assets/js/plugins/jasny-bootstrap.min.js" type="text/javascript"></script>
    <!--	Plugin for Small Gallery in Product Page -->
    <script src="../assets/js/plugins/jquery.flexisel.js" type="text/javascript"></script>
    <!-- Plugins for presentation and navigation  -->
    <script src="../assets/demo/modernizr.js" type="text/javascript"></script>
    <script src="../assets/demo/vertical-nav.js" type="text/javascript"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Js With initialisations For Demo Purpose, Don't Include it in Your Project -->
    <script src="../assets/demo/demo.js" type="text/javascript"></script>
    <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-kit.js?v=2.1.0" type="text/javascript"></script>
    <script>
      $(document).ready(function() {
        $("#flexiselDemo1").flexisel({
          visibleItems: 4,
          itemsToScroll: 1,
          animationSpeed: 400,
          enableResponsiveBreakpoints: true,
          responsiveBreakpoints: {
            portrait: {
              changePoint: 480,
              visibleItems: 3
            },
            landscape: {
              changePoint: 640,
              visibleItems: 3
            },
            tablet: {
              changePoint: 768,
              visibleItems: 3
            }
          }
        });
      });
    </script>
  </body>

  </html>
@endsection
