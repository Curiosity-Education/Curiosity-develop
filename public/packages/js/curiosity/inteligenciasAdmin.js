$(document).ready(function() {

  $curiosity.menu.setPaginaId("#menuAdminNivel");

// creamos el objeto general en el que
// se declararan las funciones a utilizar
  var inteligencia = {
    // funcion para limpiar el formulario
    // de administracion
    restablecerForm : function(){
      $("#nombre").val("");
      $("#descripcion").val("");
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
      inteligencia.restablecerForm();
    },
    // creando sub objeto en el cual se declaran
    // las funciones correspondientes al resgistro
    // y manipulacion de la informacion
    registro : {
      // sincroniza el DOM en tiempo de ejecucion agregando
      // un nuevo cuadro con la informacion del objeto
      // recien creado al momento de ser registrado
      sincronizar : function(titulo, color, id, descrip, estatusArg, imagen, idnivel){
        var nuevo = "<div class='col-md-4 objeto' data-id="+id+" data-id-remove="+id+">"+
          "<div class='box box-widget widget-title'>"+
            "<div class='widget-title-header' style='background-color: "+color+"'>"+
              "<h3 class='widget-title-set text-center' data-descrip='"+descrip+"' data-color='"+color+"' data-estatus="+estatusArg+" id="+id+">"+titulo+"</h3>"+
              "<h5 class='widget-title-desc'></h5>"+
            "</div>"+
            "<div class='widget-title-image'>"+
              "<img class='img-circle tooltipShow' title='Cambiar imagen' src='/packages/images/inteligencias/"+imagen+"' data-id-img="+id+">"+
            "</div>"+
            "<div class='box-footer'>"+
              "<div class='row'>"+
                "<div class='col-xs-4 border-right'>"+
                  "<div class='description-block btnUpdate' data-id = "+id+">"+
                    "<span class='fa fa-refresh fa-3x' title='Actualizar'></span>"+
                    "<br>"+
                    "<span class='description-text'>ACTUALIZAR<br></span>"+
                  "</div>"+
                "</div>"+
                "<div class='col-xs-4 border-right'>"+
                  "<div class='description-block btnRemove' data-id = "+id+">"+
                    "<span class='fa fa-remove fa-3x' title='Eliminar'></span>"+
                    "<br>"+
                    "<span class='description-text' >Eliminar</span>"+
                  "</div>"+
                "</div>"+
                "<div class='col-xs-4'>"+
                  "<div class='description-block btnIn' data-id-enter="+id+" data-nivelid="+idnivel+">"+
                    "<span class='fa fa-arrow-right fa-3x'></span>"+
                    "<br>"+
                    "<span class='description-text'>Ingresar</span>"+
                  "</div>"+
                "</div>"+
              "</div>"+
            "</div>"+
          "</div>"+
        "</div>";
        $("#viewSection").append(nuevo);
      },
      // registrar un nuevo objeto enviando como parametros
      // el boton al que se le da clic, la direccion donde
      // hará la funcion de registrar y el nivel al que este
      // pertenece.
      guardarAdd : function(boton, direccion, nivel){
        var $btnEnviar = boton;
        $btnEnviar.attr('disabled', 'disabled');
        $btnEnviar.text('Guardando...');
        var datos = {
          nombre : $("#nombre").val(),
          estatus : "lock",
          active : 1,
          descripcion : $("#descripcion").val(),
          bg_color : $("#color").val(),
          nivel_id : nivel
        };
        $.ajax({
          url: direccion,
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
            console.log(response);
            inteligencia.registro.sincronizar(response[1].nombre, response[1].bg_color, response[1].id, response[1].descripcion, response[1].estatus, response[1].imagen, response[1].nivel_id);
            $curiosity.noty("Registrado Correctamente", "success");
            inteligencia.hideAdmin();
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
      guardarUpdate : function(boton, direccion, id, estatusNow, idProcedencia){
        var $btnEnviar = boton;
        $btnEnviar.attr('disabled', 'disabled');
        $btnEnviar.text('Guardando...');
        var datos = {
          idUpdate : id,
          nombre : $("#nombre").val(),
          estatus : estatusNow,
          descripcion : $("#descripcion").val(),
          procedenciaID : idProcedencia,
          color : $("#color").val()
        };
        $.ajax({
          url: direccion,
          type: 'POST',
          data: {data: datos}
        })
        .done(function(response) {
          console.log(response);
          if($.isPlainObject(response)){
            $.each(response,function(index,value){
              $.each(value,function(i, message){
                $curiosity.noty(message, 'warning');
              });
            });
          }
          else if(response[0] == 'success'){
            $curiosity.noty("Actualizado Correctamente", "success");
            $("#"+id).text($("#nombre").val());
            $("#"+id).data('descrip', $("#descripcion").val());
            $("#"+id).data('estatus', estatusNow);
            $("#"+id).data('color', $("#color").val());
            $("#"+id).parent().css('background',$("#color").val());
            inteligencia.hideAdmin();
          }
          else if(response[0] == 'same'){
            $curiosity.noty("El nombre ya existe", "warning");
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
            url: '/removeInteligencia',
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
              $("[data-id-remove="+miId+"]").hide('slow', function() {
                $(this).remove();
              });
            }
          })
          .fail(function(error) {
            console.log(error);
          });
        }
        $curiosity.notyConfirm(funcionRemover);
      },
      ingresar : function(direccion){
        window.location.href = direccion;
      },
      changeImagen : function(id){
        var formData = new FormData($("#imagenForm")[0]);
        $.ajax({
          url: "/changeImageInteligencia"+id+"",
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false
        })
        .done(function(response) {
          console.log(response);
          if(response[0] == 'success'){
            $(".widget-title-image > [data-id-img="+id+"]").attr('src', "/packages/images/inteligencias/"+response[1]);
            $curiosity.noty("Imagen cambiada Correctamente", "success");
          }
        })
        .fail(function(error) {
          console.log(error);
        });
      }
    }
  };

// -----------------------------------------------------------------

  // variables generales que funcionan para enviar como
  // parametros al momento de registrar o actualizar
  // un objeto
  var titulo = $("#nombre").val();
  var descripcion = $("#descripcion").val();
  var estatus;

  // funcion al dar clic en el boton de enviar en el
  // formulario de administracion
  $("#enviarEnv").click(function(event) {
    // se crea un switch para distinguir si el formulario
    // hace funcion de registro o actualizacion de la
    // informacion dependiendo del data-tipo que tiene
    // este boton
    switch ($(this).data('tipo')) {
      case 'add':
      var id_nivel = $(this).data('nivel');
      inteligencia.registro.guardarAdd($(this), "/adminInteligencia"+id_nivel, id_nivel);
        break;
        case 'update':
        inteligencia.registro.guardarUpdate($(this), '/updateInteligencia', $(this).data('updateId'), estatus, $(this).data('nivel'))
          break;
    }
  });

  // click en el boton de cancelar en el formulario de
  // administracion
  $("#cancelarEnv").click(function(event) {
    inteligencia.hideAdmin();
  });

  // damos clic en el boton de agregar nuevo en la parte
  // donde estan los cuadros.
  // este boton nos permite mostrar el formulario de administracion
  // y establecerle al boton de enviar el data correspondiente en este caso
  // 'add' el cual servira para distingir que dicho boton hará la funcion
  // de registro en caso de ser presionado
  $('#addNew').click(function(event) {
    $("#enviarEnv").data('tipo', 'add');
    $("#color").val("#000000");
    inteligencia.showAdmin();
  });

  // permitir dar clic en el boton de Actualizar ubicado en cada
  // cuadro de la pagina que permite ingresar al crud de actualizacion
  // cambiando el data-tipo del boton enviar a 'update'
  // para que el boton funcione para actualizar en caso de ser presionado
  $("#viewSection").on('click', '.objeto > .box > .box-footer > .row > div > .btnUpdate', function(event) {
    $("#enviarEnv").data('tipo', 'update');
    var idSelected = $(this).data('id');
    // le ponemos la boton de enviar un data con el id del
    // objeto que se ha dado clic esto para saber a cual
    // objeto se le hará la actualizacion del lado del
    // servidor
    $("#enviarEnv").data('updateId', idSelected);
    // se ponde el nombre y la descripcion del cuadro seleccionado
    // en los inputs correspondientes
    $("#nombre").val($("#"+idSelected).text());
    $("#color").val($("#"+idSelected).data('color'));
    $("#descripcion").val($("#"+idSelected).data('descrip'));
    // se pone el icono segun el estatus del objeto seleccionado
    estatus = $("#"+idSelected).data('estatus');
    if(estatus == "lock"){
      $("#btnLock").removeClass('fa-unlock');
      $("#btnLock").addClass('fa-lock');
    }
    else{
      $("#btnLock").removeClass('fa-lock');
      $("#btnLock").addClass('fa-unlock');
    }
    // se musestra el icono del candadito en el
    // formulario de la administracion
    $("#botonEstatus").show();
    // mostramos el formulario de administracion
    inteligencia.showAdmin();
  });

  // variable para determinar el estatus del objeto
  var isBlock = true;
  // damos click en el icono del candadito en el
  // formulario de administracion y guardamos el estatus
  // correspondiente al estado del candadito
  $("#btnLock").click(function(event) {
    if(isBlock){
      isBlock = false;
      $(this).removeClass('fa-lock');
      $(this).addClass('fa-unlock');
      estatus = "unlock";
    }
    else {
      isBlock = true;
      $(this).removeClass('fa-unlock');
      $(this).addClass('fa-lock');
      estatus = "lock";
    }
  });

  // acciones al dar clic en el boton de eliminar ubicado
  // en cada cuadro u objeto
  $("#viewSection").on('click', '.objeto > .box > .box-footer > .row > div > .btnRemove',function(event) {
    // obtenemos el id del objeto seleccionado
    var idSelected = $(this).data('id');
    // enviamos como parametro el id del objeto seleccionado
    // para eliminar dicho objeto en base a su id
    inteligencia.registro.remove(idSelected);
  });

  // asignar funcionalidad de input file a la imagen del objeto
  // para poder cambiarla al dar clic sobre ella
  var idImagenData;
  $("#viewSection").on('click', '.objeto > .box > .widget-title-image > img', function(){
    idImagenData = $(this).data('id-img');
    $("#up-image").trigger("click");
  });

  $("#up-image").change(function(event) {
    inteligencia.registro.changeImagen(idImagenData);
  });

  // Boton ingresar
  $("#viewSection").on('click', '.objeto > .box > .box-footer > .row > div > .btnIn',function(event) {
    var idSelected = $(this).data('id-enter');
    var nivelID = $(this).data('nivelid');
    inteligencia.registro.ingresar("/adminBloque"+idSelected+"_"+nivelID);
  });

});
