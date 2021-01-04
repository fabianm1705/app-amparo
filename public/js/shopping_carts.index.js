function cargarCarrito(id,porccuotas,cantcuotas){
  const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 0
      })
  axios.post('/getProducts/'+id)
    .then((resp)=>{
        var tabla = document.getElementById('tablaproductos');
        var cont = document.getElementById("tablaproductos").rows.length;
        for (i = 0; i < (cont); i++) {
            document.getElementById("borrar").remove();
        }
        var monto = 0;
        var total = 0;
        for (i = 0; i < Object.keys(resp.data).length; i++) {
            monto = Math.round(resp.data[i].costo/cantcuotas*(1+(porccuotas/100))/10)*10;
            total = total + monto;
            tabla.insertAdjacentHTML('afterbegin', '<tr id="borrar"><td>' + resp.data[i].modelo + '</td><td class="text-center">1</td><td class="text-right">' + formatter.format(monto) + '</td></tr>');
        }
        tabla.insertAdjacentHTML('beforeend', '<tr id="borrar"><td></td><td></td><td><strong>' + cantcuotas + ' cuotas de ' + formatter.format(total) + '</strong></td></tr>');
    })
    .catch(function (error) {console.log(error);})
}
