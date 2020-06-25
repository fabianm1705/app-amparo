function darkMode(valor){
  var el1 = document.getElementById("navAmparo");
  var el2 = document.getElementById("menuAdmin");
  var el3 = document.getElementById("switchDarkMode");
  var el4 = document.getElementById("dropdownMenuButton");
  var el5 = document.getElementById("menuLogin");
  var el6 = document.getElementById("labelDarkMode");
  var el7 = document.getElementById("misDatos");
  var el8 = document.getElementById("divLogout");
  var el9 = document.getElementById("visorAccesos");
  var el10 = document.getElementById("busquedaSocios");
  var el11 = document.getElementById("actualizacionPadron");
  var el12 = document.getElementById("productos");
  var el13 = document.getElementById("shoppingCarts");
  var el14 = document.getElementById("especialidades");
  var el15 = document.getElementById("profesionales");
  var el16 = document.getElementById("categorias");
  var el18 = document.getElementById("metodosPago");
  var el21 = document.getElementById("carrito");
  var el22 = document.getElementById("iconCarrito");
  var el23 = document.getElementById("cuerpo");
  el3.checked = valor;
  if(valor){
    el1.classList.remove('navbar-light');
    el1.classList.remove('bg-white');
    el1.classList.add('navbar-dark');
    el1.classList.add('bg-dark');
    el2.classList.add('bg-dark');
    el4.classList.add('text-secondary');
    el5.classList.add('bg-dark');
    el6.classList.add('text-secondary');
    el7.classList.add('text-secondary');
    el8.classList.add('text-secondary');
    el9.classList.add('text-secondary');
    el10.classList.add('text-secondary');
    el11.classList.add('text-secondary');
    el12.classList.add('text-secondary');
    el13.classList.add('text-secondary');
    el14.classList.add('text-secondary');
    el15.classList.add('text-secondary');
    el16.classList.add('text-secondary');
    el18.classList.add('text-secondary');
    el21.classList.add('text-white');
    el22.style.color = "white";
    el23.classList.add('bg-dark');
  }else{
    el1.classList.remove('navbar-dark');
    el1.classList.remove('bg-dark');
    el1.classList.add('navbar-light');
    el1.classList.add('bg-white');
    el2.classList.remove('bg-dark');
    el4.classList.remove('text-secondary');
    el5.classList.remove('bg-dark');
    el6.classList.remove('text-secondary');
    el7.classList.remove('text-secondary');
    el8.classList.remove('text-secondary');
    el9.classList.remove('text-secondary');
    el10.classList.remove('text-secondary');
    el11.classList.remove('text-secondary');
    el12.classList.remove('text-secondary');
    el13.classList.remove('text-secondary');
    el14.classList.remove('text-secondary');
    el15.classList.remove('text-secondary');
    el16.classList.remove('text-secondary');
    el18.classList.remove('text-secondary');
    el21.classList.remove('text-white');
    el22.style.color = "black";
    el23.style.backgroundImage = "url('https://amparosrl.com.ar/images/01.webp')";
  }
}
