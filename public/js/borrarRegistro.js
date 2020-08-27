function borrarRegistro(id){

  event.preventDefault();
  Swal.fire({
    title: 'Está seguro de borrar el registro?',
    text: "Esta acción no se puede revertir!",
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#FF7F00',
    cancelButtonColor: '#d0aa5b',
    confirmButtonText: 'Si, borrarlo!',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.value) {
      document.getElementById("formEliminar"+id).submit();
      Swal.fire(
        '¡Borrado!',
        'El registro ha sido borrado.',
        'success'
      )
    }})
  }
