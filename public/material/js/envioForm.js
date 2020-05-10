$("#contactForm").submit(function(event){
    // cancels the form submission
    event.preventDefault();
    // submitForm();
    var name = $("#nombre").val();
    var telephone = $("#telefono").val();
    var address = $("#domicilio").val();
    var email = $("#correo").val();
    var message = $("#mensaje").val();

    $.ajax({
        type: "POST",
        url: "contacto.php",
        data: "name=" + name + "&telephone=" + telephone + "&address=" + address + "&email=" + email + "&message=" + message,
        success : function(text){
           alert(text);
        }
    });

});
