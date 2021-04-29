function darkMode(valor){
  var el1 = document.getElementById("iconBack");
  var el2 = document.getElementById("cuerpo");
  var el3 = document.getElementById("iconHome");
  if(valor){
    el1.style.color = "white";
    el2.classList.add('bg-dark');
    el3.style.color = "white";
  }else{
    el1.style.color = "black";
    el2.style.backgroundImage = "url('https://amparosrl.com.ar/images/01.webp')";
    el3.style.color = "black";
  }
}

function activeDarkMode(valor){
  event.preventDefault();
  document.getElementById('darkmode-form').submit();
}
