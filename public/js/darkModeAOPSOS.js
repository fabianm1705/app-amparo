function darkMode(valor){
  var el1 = document.getElementById("navAmparo");
  var el3 = document.getElementById("switchDarkMode");
  var el5 = document.getElementById("menuLogin");
  var el6 = document.getElementById("labelDarkMode");
  var el8 = document.getElementById("divLogout");
  var el23 = document.getElementById("cuerpo");
  el3.checked = valor;
  if(valor){
    el1.classList.remove('navbar-light');
    el1.classList.remove('bg-white');
    el1.classList.add('navbar-dark');
    el1.classList.add('bg-dark');
    el5.classList.add('bg-dark');
    el6.classList.add('text-secondary');
    el8.classList.add('text-secondary');
    el23.classList.add('bg-dark');
  }else{
    el1.classList.remove('navbar-dark');
    el1.classList.remove('bg-dark');
    el1.classList.add('navbar-light');
    el1.classList.add('bg-white');
    el5.classList.remove('bg-dark');
    el6.classList.remove('text-secondary');
    el8.classList.remove('text-secondary');
    el23.style.backgroundImage = "url('https://amparosrl.com.ar/images/01.webp')";
  }
}
