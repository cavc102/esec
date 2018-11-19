function load(page){
  var parametros = {"action":"ajax","page":page};
  $("#loader").fadeIn('slow');
  $.ajax({
    url:'usuario.php',
    data: parametros,
     beforeSend: function(objeto){
    $("#loader").html("<img src='loader.gif'>");
    },
    success:function(data){
      $(".outer_div").html(data).fadeIn('slow');
      $("#loader").html("");
    }
  })
}

  $('#dataUpdate').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botón que activó el modal
    var email = button.data('email') // Extraer la información de atributos de datos
    var id_usuario = button.data('id_usuario') // Extraer la información de atributos de datos
    var nombre = button.data('nombre') // Extraer la información de atributos de datos
    var contrasena = button.data('contrasena') // Extraer la información de atributos de datos
    var id_rol = button.data('id_rol') // Extraer la información de atributos de datos
    var telefono = button.data('telefono') // Extraer la información de atributos de datos
    var direccion = button.data('direccion') // Extraer la información de atributos de datos
    var identificacion = button.data('identificacion') // Extraer la información de atributos de datos
    
    var modal = $(this)
    modal.find('.modal-title').text('Modificar usuario: '+nombre)
    modal.find('.modal-body #id_usuario').val(id_usuario)
    modal.find('.modal-body #email').val(email)
    modal.find('.modal-body #nombre').val(nombre)
    modal.find('.modal-body #contrasena').val(contrasena)
    modal.find('.modal-body #id_rol').val(id_rol)
    modal.find('.modal-body #telefono').val(telefono)
    modal.find('.modal-body #direccion').val(direccion)
    modal.find('.modal-body #identificacion').val(identificacion)
    $('.alert').hide();//Oculto alert
  })
  
  $('#dataDelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botón que activó el modal
    var id_usuario = button.data('id_usuario') // Extraer la información de atributos de datos
    var modal = $(this)
    modal.find('#id_usuario').val(id_usuario)
  })

$( "#actualidarDatos" ).submit(function( event ) {
  var parametros = $(this).serialize();
     $.ajax({
        type: "POST",
        url: "modificar.php",
        data: parametros,
         beforeSend: function(objeto){
          $("#datos_ajax").html("Mensaje: Cargando...");
          },
        success: function(datos){
        $("#datos_ajax").html(datos);
        
        load(1);
        }
    });
    event.preventDefault();
  });
  
  $( "#guardarDatos" ).submit(function( event ) {
  var parametros = $(this).serialize();
     $.ajax({
        type: "POST",
        url: "agregar.php",
        data: parametros,
         beforeSend: function(objeto){
          $("#datos_ajax_register").html("Mensaje: Cargando...");
          },
        success: function(datos){
        $("#datos_ajax_register").html(datos);
        
        load(1);
        }
    });
    event.preventDefault();
  });
  
  $( "#eliminarDatos" ).submit(function( event ) {
  var parametros = $(this).serialize();
     $.ajax({
        type: "POST",
        url: "eliminar.php",
        data: parametros,
         beforeSend: function(objeto){
          $(".datos_ajax_delete").html("Mensaje: Cargando...");
          },
        success: function(datos){
        $(".datos_ajax_delete").html(datos);
        
        $('#dataDelete').modal('hide');
        load(1);
        }
    });
    event.preventDefault();
  });