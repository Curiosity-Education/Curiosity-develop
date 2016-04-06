$(document).ready(function() {

  $curiosity.menu.setPaginaId("#menuAdminEscuela");

// creamos el objeto general en el que
// se declararan las funciones a utilizar
  var escuela = {
    // funcion para limpiar el formulario
    // de administracion
    restablecerForm : function(){
      $("#nombre").val("");
      $("#web").val("");
      $("#logotipo").val("");
    },
    // funcion para mostrar el formulario
    // de administracion y ocultar los cuadros
    showAdmin : function(){
      $("#viewSection").hide('slow');
      $("#adminSection").show('slow');
    },
    // funcion para mostrar nuevamente los cuadros
    // y ocultar el formulario de administracion
    hideAdmin : function(){
      $("#viewSection").show('slow');
      $("#adminSection").hide('slow');
      $("#botonEstatus").hide();
      escuela.restablecerForm();
    },
    // creando sub objeto en el cual se declaran
    // las funciones correspondientes al resgistro
    // y manipulacion de la informacion
    registro : {
      // sincroniza el DOM en tiempo de ejecucion agregando
      // un nuevo cuadro con la informacion del objeto
      // recien creado al momento de ser registrado
      sincronizar : function(id, nombre, web, logotipo){
        var nuevo = "<div class='col-xs-4 col-sm-3 col-md-2' id='"+id+"'>"+
          "<div class='boxEscuela boxEscuelaLog' data-escuela-id='"+id+"'"+
          "data-escuela-web='"+web+"' data-escuela-nombre='"+nombre+"'>"+
            "<img src='/packages/images/escuelas/"+logotipo+"' class='img-responsive'>"+
          "</div>"+
        "</div>";
        $("#viewSection").append(nuevo);
      },
      // registrar un nuevo objeto enviando como parametros
      // el boton al que se le da clic, la direccion donde
      // hará la funcion de registrar y la inteligencia al que este
      // pertenece.
      guardarAdd : function(boton){
        var $btnEnviar = boton;
        $btnEnviar.attr('disabled', 'disabled');
        $btnEnviar.text('Guardando...');
        var formData = new FormData($("#formLogo")[0]);
        formData.append('nombre', $("#nombre").val());
        formData.append('web', $("#web").val());
        formData.append('active', 1);
        $.ajax({
          url: '/adminEscuela',
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false
        })
        .done(function(response) {
          if($.isPlainObject(response)){
            $.each(response,function(index,value){
              $.each(value,function(i, message){
                $curiosity.noty(message, 'warning');
              });
            });
          }
          else if(response[0] == 'success'){
            escuela.registro.sincronizar(response[1].id, response[1].nombre, response[1].web, response[1].logotipo);
            $curiosity.noty("Registrado Correctamente", "success");
            escuela.hideAdmin();
          }
          else if(response[0] == 'success_exist'){
            escuela.registro.sincronizar(response[1].id, response[1].nombre, response[1].web, response[1].logotipo);
            $curiosity.noty("Se ha habilitado nuevamente", "success");
            escuela.hideAdmin();
          }
          else if(response[0] == 'same'){
            $curiosity.noty("El nombre ingresado ya existe", "warning");
          }
        })
        .fail(function(error) {
          console.log(error);
        })
        .always(function(){
          $btnEnviar.removeAttr('disabled');
          $btnEnviar.html("<i class='fa fa-check'></i> Guardar");
        });
      },
      // actualiza un objeto enviando como parametros
      // el boton al que se le da clic, la direccion donde
      // hará la funcion de actualizar, el id del cuadro
      // al que se le ha dado clic y el estatus es decir
      // si se encuentra bloqueado o desbloqueado
      guardarUpdate : function(boton, id){
        var $btnEnviar = boton;
        $btnEnviar.attr('disabled', 'disabled');
        $btnEnviar.text('Guardando...');
        var formData = new FormData($("#formLogo")[0]);
        formData.append('nombre', $("#nombre").val());
        formData.append('web', $("#web").val());
        formData.append('idUpdate', id);
        $.ajax({
          url: '/updateEscuela',
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false
        })
        .done(function(response) {
          if($.isPlainObject(response)){
            $.each(response,function(index,value){
              $.each(value,function(i, message){
                $curiosity.noty(message, 'warning');
              });
            });
          }
          else if(response[0] == 'success'){
            $curiosity.noty("Actualizado Correctamente", "success");
            $("[data-escuela-id='"+id+"']").data('escuela-nombre', $("#nombre").val());
            $("[data-escuela-id='"+id+"']").data('escuela-web', $("#web").val());
            $("[data-escuela-id='"+id+"'] > img").attr('src', '/packages/images/escuelas/'+response[1]);
            escuela.hideAdmin();
          }
          else if(response[0] == 'same'){
            $curiosity.noty("El nombre ya existe", "warning");
          }
          else if(response[0] == 'same_exist'){
            $curiosity.noty("El nombre existe pero se encuentra deshabilitado", "warning");
          }
        })
        .fail(function(error) {
          console.log(error);
        })
        .always(function(){
          $btnEnviar.removeAttr('disabled');
          $btnEnviar.html("<i class='fa fa-check'></i> Guardar");
        });
      },
      // elimina el objeto seleccionado enviando el id del
      // cuadro al que se le ha dado clic
      remove : function(miId){
        var funcionRemover = function(){
          var datos = {
            id : miId
          };
          $.ajax({
            url: '/removeEscuela',
            type: 'POST',
            data: {data: datos}
          })
          .done(function(response) {
            if($.isPlainObject(response)){
              $.each(response,function(index,value){
                $.each(value,function(i, message){
                  $curiosity.noty(message, 'warning');
                });
              });
            }
            else if(response[0] == 'success'){
              $("#"+miId).hide('slow', function() {
                $(this).remove();
              });
              escuela.hideAdmin();
            }
          })
          .fail(function(error) {
            console.log(error);
          });
        }
        $curiosity.notyConfirm(funcionRemover);
      }
    }
  };





  // funcion al dar clic en el boton de enviar en el
  // formulario de administracion
  $("#enviarEnv").click(function(event) {
    // se crea un switch para distinguir si el formulario
    // hace funcion de registro o actualizacion de la
    // informacion dependiendo del data-tipo que tiene
    // este boton
    switch ($(this).data('tipo')) {
      case 'add':
      escuela.registro.guardarAdd($(this));
        break;
        case 'update':
        escuela.registro.guardarUpdate($(this), $(this).data('updateId'));
          break;
    }
  });

  // click en el boton de cancelar en el formulario de
  // administracion
  $("#cancelarEnv").click(function(event) {
    escuela.hideAdmin();
  });

  // damos clic en el boton de agregar nuevo en la parte
  // donde estan los cuadros.
  // este boton nos permite mostrar el formulario de administracion
  // y establecerle al boton de enviar el data correspondiente en este caso
  // 'add' el cual servira para distingir que dicho boton hará la funcion
  // de registro en caso de ser presionado
  $('#addNew').click(function(event) {
    $("#enviarEnv").data('tipo', 'add');
    $("#eliminarEnv").hide();
    escuela.showAdmin();
  });

  // permitir dar clic en el boton de Actualizar ubicado en cada
  // cuadro de la pagina que permite ingresar al crud de actualizacion
  // cambiando el data-tipo del boton enviar a 'update'
  // para que el boton funcione para actualizar en caso de ser presionado
  $("#viewSection").on('click', 'div > .boxEscuelaLog', function(event) {
    $("#enviarEnv").data('tipo', 'update');
    $("#eliminarEnv").show();
    var idSelected = $(this).data('escuela-id');
    // le ponemos la boton de enviar un data con el id del
    // objeto que se ha dado clic esto para saber a cual
    // objeto se le hará la actualizacion del lado del
    // servidor
    $("#enviarEnv").data('updateId', idSelected);
    // se ponde el nombre y la descripcion del cuadro seleccionado
    // en los inputs correspondientes
    $("#nombre").val($("[data-escuela-id='"+idSelected+"']").data('escuela-nombre'));
    $("#web").val($("[data-escuela-id='"+idSelected+"']").data('escuela-web'));
    // Asignamos el id al boton de eliminar
    $('#eliminarEnv').data('eliminar-escuela-id', idSelected);
    // mostramos el formulario de administracion
    escuela.showAdmin();
  });


  // Click al boton eliminar
  $("#eliminarEnv").click(function(){
    escuela.registro.remove($(this).data('eliminar-escuela-id'));
  });


});
