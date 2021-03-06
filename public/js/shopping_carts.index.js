function cargarCarrito(id){
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
            monto = Math.round(resp.data[i].costo/resp.data[i].cantidadCuotas*(1+(resp.data[i].percentage/100))/10)*10*resp.data[i].cantidadUnidades;
            total = total + monto;
            tabla.insertAdjacentHTML('afterbegin', '<tr id="borrar"><td>' + resp.data[i].modelo + '</td><td class="text-center">' + resp.data[i].cantidadUnidades + '</td><td class="text-right">' + formatter.format(monto) + '</td></tr>');
        }
        if(resp.data[0].cantidadCuotas==1){
          tabla.insertAdjacentHTML('beforeend', '<tr id="borrar"><td></td><td></td><td><strong>' + resp.data[0].cantidadCuotas + ' pago de ' + formatter.format(total) + '</strong></td></tr>');
        }else{
          tabla.insertAdjacentHTML('beforeend', '<tr id="borrar"><td></td><td></td><td><strong>' + resp.data[0].cantidadCuotas + ' cuotas de ' + formatter.format(total) + '</strong></td></tr>');
        }
    })
    .catch(function (error) {console.log(error);})
}
