$(document).ready(function(){

  $curiosity.menu.setPaginaId("#menuAdminProfesor");

  $.ajax({
   url:'/getProfeInfo',
   method:'POST'
  })
  .done(function(response){
    if(response.length != 0){
      var datos = [];
      $.each(response, function(index, obj){
        datos.push({
          'profesor' : response[index].nombre+" "+response[index].apellido_paterno+" "+response[index].apellido_materno,
          'email' : response[index].email,
          'escuela' : response[index].escuela_nombre,
          'id' : response[index].id,
          'nombre' : response[index].nombre,
          'apellido_paterno' : response[index].apellido_paterno,
          'apellido_materno' : response[index].apellido_materno,
          'escuela_id' : response[index].escuela_id,
          'foto' : response[index].foto,
          'gustos': response[index].gustos
        });
      });
      $('#tabla-profesores').bootstrapTable({
        data : datos
      });

    }
  });

  var profesor = {
    showAdmin : function(){
      $("#adminSection").show('slow');
      $("#zonaData").hide('slow');
    },
    hideAdmin : function(){
      $("#adminSection").hide('slow');
      $("#nombre").val('');
      $("#ape_p").val('');
      $("#ape_m").val('');
      $("#email").val('');
      $("#gustos").val('');
      $("#foto").val('');
      $("#escuela").val($("#escuela").children().first().val());
      $("#zonaData").show('slow');
      $("#prevFotoProfesor").attr('src', '/packages/images/profesores/prof-default.jpg');
    },
    registro : {
      guardarAdd : function(){
        $("#enviarEnv").attr('disabled', 'disabled');
        $("#enviarEnv").text('Guardando...');
        var formData = new FormData($("#foto_profe")[0]);
        formData.append('nombre', $("#nombre").val());
        formData.append('apellido_paterno', $("#ape_p").val());
        formData.append('apellido_materno', $("#ape_m").val());
        formData.append('email', $("#email").val());
        formData.append('gustos', $("#gustos").val());
        formData.append('escuela_id', $("#escuela").val());
        formData.append('active', 1);
        $.ajax({
          url: '/adminProfesor',
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
            $("#cancelarEnv").removeAttr('disabled');
            $curiosity.noty("Registrado Correctamente", "success");
            window.location.href='/adminProfesor';
          }
        })
        .always(function(){
          $("#enviarEnv").removeAttr('disabled');
          $("#enviarEnv").html("<i class='fa fa-check'></i> Guardar");
        })
        .fail(function(error) {
          console.log(error);
        });
      },
      guardarUpdate : function($id){
        $("#enviarEnv").attr('disabled', 'disabled');
        $("#enviarEnv").text('Guardando...');
        var formData = new FormData($("#foto_profe")[0]);
        formData.append('nombre', $("#nombre").val());
        formData.append('apellido_paterno', $("#ape_p").val());
        formData.append('apellido_materno', $("#ape_m").val());
        formData.append('email', $("#email").val());
        formData.append('gustos', $("#gustos").val());
        formData.append('escuela_id', $("#escuela").val());
        formData.append('id', $id);
        $.ajax({
          url: '/updateProfesor',
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
            $curiosity.noty("Modificado Exitosamente", "success");
            window.location.href='/adminProfesor';
          }
        })
        .always(function(){
          $("#enviarEnv").removeAttr('disabled');
          $("#enviarEnv").html("<i class='fa fa-check'></i> Guardar");
        })
        .fail(function(error) {
            var messageServer = jQuery.parseJSON(error.responseText);
            var messageError = messageServer.error;
            console.log(messageError);
            var message = messageError.message;
            $curiosity.noty(message,"error");
        });
      },
      remove : function($id){
        var funcionRemover = function(){
          var datos = {
            id : $id
          }
          $.ajax({
            url: '/removeProfesor',
            type: 'POST',
            data: {data: datos}
          })
          .done(function(response) {
            window.location.href = "/adminProfesor";
          })
          .fail(function(error) {
            console.log(error);
          });
        }
        $curiosity.notyConfirm(funcionRemover);
      }
    }
  }

  $("#agregar").click(function(){
    $("#enviarEnv").data('tipo', 'add');
    $("#enviarEnv").data('id_profesor_update', '');
    $("#enviarEnv").data('id_escuela_update', '');
    profesor.showAdmin();
  });

  $("#cancelarEnv").click(function(){
    profesor.hideAdmin();
  });

  $("#actualizar").click(function(){
    var $tabla = $('#tabla-profesores');
    if($tabla.bootstrapTable('getSelections').length != 0){
      $("#enviarEnv").data('tipo', 'update');
      $("#enviarEnv").data('id_profesor_update', $tabla.bootstrapTable('getSelections')[0].id);
      $("#prevFotoProfesor").attr('src', '/packages/images/profesores/'+$tabla.bootstrapTable('getSelections')[0].foto);
      $("#nombre").val($tabla.bootstrapTable('getSelections')[0].nombre);
      $("#ape_p").val($tabla.bootstrapTable('getSelections')[0].apellido_paterno);
      $("#ape_m").val($tabla.bootstrapTable('getSelections')[0].apellido_materno);
      $("#email").val($tabla.bootstrapTable('getSelections')[0].email);
      $("#gustos").val($tabla.bootstrapTable('getSelections')[0].gustos);
      $("#escuela").val($tabla.bootstrapTable('getSelections')[0].escuela_id);
      profesor.showAdmin();
    }
  });

  $("#eliminar").click(function(){
    var $tabla = $('#tabla-profesores');
    if($tabla.bootstrapTable('getSelections').length != 0){
      profesor.registro.remove($tabla.bootstrapTable('getSelections')[0].id);
    }
  });

  $("#enviarEnv").click(function(){
    switch($(this).data('tipo')){
      case 'add':
        $("#formProf").validate({
          rules:{
            email : {email:true}
          }
        });
        if($("#formProf").valid()){
          profesor.registro.guardarAdd();
        }
        break;
      case 'update':
        profesor.registro.guardarUpdate($(this).data('id_profesor_update'));
        break
    }
  });

  $(".prevFotoProfesor").click(function() {
    $("#foto").trigger("click");
  });

  $("#foto").on('change', function(){
    var pesoMaximo = 2048000;
    var extensiones = new Array(".png", ".jpg", ".jpeg", '.gif');
    var $archivo = $(this);
    if($curiosity.comprobarFile($archivo.val(), extensiones)){
      var archivos = document.getElementById("foto").files;
      if(archivos[0].size > 2048000){
        $archivo.val("");
        $("#prevFotoProfesor").attr("src", "/packages/images/profesores/prof-default.jpg");
        $curiosity.noty("La imagen seleccionada excede el peso máximo (2 MB)", 'warning');
      }
      else{
        var navegador = window.URL || window.webkitURL;
        var objeto_url = navegador.createObjectURL(archivos[0]);
        $("#prevFotoProfesor").attr("src", objeto_url);
      }
    }
    else{
      $archivo.val("");
      $("#prevFotoProfesor").attr("src", "/packages/images/profesores/prof-default.jpg");
    }
  });


});
