function cargarProfesionales(){
  var id = document.getElementById('specialty').value;
  axios.post('/getProfesionales/'+id)
    .then((resp)=>{
        var cont = document.getElementById("tablaprofesionales").rows.length;
        for (i = 0; i < (cont); i++) {
            document.getElementById("borrar").remove();
        }
        for (i = 0; i < Object.keys(resp.data).length; i++) {
            $('<tr id="borrar"><td>' + resp.data[i].apeynom + '</td><td>' + resp.data[i].direccion + '</td><td>' + resp.data[i].telefono + '</td></tr>').appendTo('#tablaprofesionales');
        }
    })
    .catch(function (error) {console.log(error);})
};
