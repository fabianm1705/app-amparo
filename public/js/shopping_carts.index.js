function cargarCarrito(id){
  const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 0
      })
  axios.post('/getProducts/'+id)
    .then((resp)=>{
        var cont = document.getElementById("tablaproductos").rows.length;
        for (i = 0; i < (cont); i++) {
            document.getElementById("borrar").remove();
        }
        var monto = 0;
        var total = 0;
        var cuotas = 1;
        for (i = 0; i < Object.keys(resp.data).length; i++) {
            monto = Math.round(resp.data[i].costo/resp.data[i].cantidadCuotas*(1+({{ $porccuotas/100 }}))/10)*10;
            total = total + monto;
            cuotas = resp.data[i].cantidadCuotas;
            $('<tr id="borrar"><td>' + resp.data[i].modelo + '</td><td class="text-center">1</td><td class="text-right">' + formatter.format(monto) + '</td></tr>').appendTo('#tablaproductos');
        }
        $('<tr id="borrar"><td></td><td class="text-center"></td><td>' + cuotas + ' cuotas de ' + formatter.format(total) + '</td></tr>').appendTo('#tablaproductos');
    })
    .catch(function (error) {console.log(error);})
}
