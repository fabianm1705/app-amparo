function cargarOrdenes(){
  var id = document.getElementById('doctor').value;
  axios.post('/getOrdenes/'+id)
    .then((resp)=>{
      var tabla = document.getElementById('tablaordenes');
      var cont = tabla.rows.length;
      for (i = 0; i < (cont); i++) {
          document.getElementById("borrar").remove();
      }
      for (i = 0; i < Object.keys(resp.data).length; i++) {
        let suma = resp.data[i].id + 5000;
        tabla.insertAdjacentHTML('afterbegin', '<tr id="borrar"><td>' + suma + '</td><td>' + resp.data[i].fechaImpresion + '</td><td>' + resp.data[i].numeroSocio + '</td><td>' + resp.data[i].user.name + '</td><td>' + resp.data[i].nombreDoctor + '</td><td>' + resp.data[i].monto_s + '</td><td>' + resp.data[i].monto_a + '</td><td>' + resp.data[i].lugarEmision + '</td><td>' + resp.data[i].estado + '</td><td>' + resp.data[i].fechaPago + '</td><td>' + resp.data[i].obs + '</td></tr>');
      }
      document.getElementById('paginador').style.display = "none";
    })
    .catch(function (error) {console.log(error);})
};

function pagarOrden(id){

  event.preventDefault();
  Swal.fire({
    title: 'Pagar a la fecha actual?',
    text: "Esta acción no se puede revertir!",
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#FF7F00',
    cancelButtonColor: '#d0aa5b',
    confirmButtonText: 'Si, pagar!',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.value) {
      document.getElementById("formPagar"+id).submit();
      Swal.fire(
        '¡Pagado!',
        'La órden ha sido pagada.',
        'success'
      )
    }})
  };
