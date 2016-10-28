$(document).ready(function(){

  //$curiosity.menu.setPaginaId("#menuAdminProfesor");

  $.ajax({
   url:'/leer-planes',
   method:'POST'
  })
  .done(function(response){
    if(response.length != 0){
      var datos = [];
      $.each(response, function(index, obj){
        datos.push({
          'id' : response[index].id,
          'name' : response[index].name,
          'interval' : response[index].escuela_nombre,
          'amount' : response[index].amount,
          'currency' : response[index].currency,
          'type' : response[index].type
        });
      });
      $('#tabla-planes').bootstrapTable({
        data : datos
      });

    }
  });

  var planes = {
    showAdmin : function(){
      $("#adminSection").show('slow');
      $("#zonaData").hide('slow');
    },
    hideAdmin : function(){
      $("#adminSection").hide('slow');
      $("frm_planes").trigger('reset');
      $("#zonaData").show('slow');
    },
    registro : {
      guardarAdd : function(){
        $("#enviarEnv").attr('disabled', 'disabled');
        $("#enviarEnv").text('Guardando...');
        $.ajax({
          url: '/crear-plan',
          type: 'POST',
          data: $("frm_planes").serialize()
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
            window.location.href='/gestion-de-planes';
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
            window.location.href = "/gestion-de-planes";
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
    $("#enviarEnv").data('id_plan_update', '');
    planes.showAdmin();
  });

  $("#cancelarEnv").click(function(){
    planes.hideAdmin();
  });

  $("#actualizar").click(function(){
    var $tabla = $('#tabla-planes');
    if($tabla.bootstrapTable('getSelections').length != 0){
      $("#enviarEnv").data('tipo', 'update');
      $("#enviarEnv").data('id_planes_update', $tabla.bootstrapTable('getSelections')[0].id);
      $("#name").val($tabla.bootstrapTable('getSelections')[0].name);
      $("#interval").val($tabla.bootstrapTable('getSelections')[0].interval);
      $("#amount").val($tabla.bootstrapTable('getSelections')[0].amount);
      $("#currency").val($tabla.bootstrapTable('getSelections')[0].currency);
      $("#type").val($tabla.bootstrapTable('getSelections')[0].type);
      planes.showAdmin();
    }
  });

  $("#eliminar").click(function(){
    var $tabla = $('#tabla-planes');
    if($tabla.bootstrapTable('getSelections').length != 0){
      planes.registro.remove($tabla.bootstrapTable('getSelections')[0].id);
    }
  });

  $("#enviarEnv").click(function(){
    switch($(this).data('tipo')){
      case 'add':
        $("#frm_planes").validate({
          rules:{
            name : {required:true},
            interval : {required:true},
            ammount : {number:true,required:true},
            currency: {required:true},
            type: {required:true}
          }
        });
        if($("#frm_planes").valid()){
          planes.registro.guardarAdd();
        }
        break;
      case 'update':
        planes.registro.guardarUpdate($(this).data('id_profesor_update'));
        break
    }
  });



});
