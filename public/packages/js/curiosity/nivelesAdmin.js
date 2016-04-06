$(document).ready(function() {

  $curiosity.menu.setPaginaId("#menuAdminNivel");

  var colores = Array(
    'bg-blue',
    'bg-green',
    'bg-red',
    'bg-purple',
    'bg-maroon',
    'bg-teal-active',
    'bg-yellow-active'
  );

  var nivel = {
    restablecerForm : function(){
      $("#nombre").val("");
      $("#descripcion").val("");
    },
    showAdmin : function(){
      $("#viewSection").hide('slow');
      $("#adminSection").show('slow');
    },
    hideAdmin : function(){
      $("#viewSection").show('slow');
      $("#adminSection").hide('slow');
      $("#botonEstatus").hide();
      nivel.restablecerForm();
    },
    registro : {
      sincronizar : function(titulo, color, id, descrip, estatusArg, imagen){
        var nuevo = "<div class='col-md-4 objeto' data-id="+id+">"+
          "<div class='box box-widget widget-title'>"+
            "<div class='widget-title-header "+color+"'>"+
              "<h3 class='widget-title-set text-center' data-descrip='"+descrip+"' data-estatus="+estatusArg+" id="+id+">"+titulo+"</h3>"+
              "<h5 class='widget-title-desc'></h5>"+
            "</div>"+
            "<div class='widget-title-image'>"+
              "<img class='img-circle' src='/packages/images/niveles/"+imagen+"' data-id = "+id+">"+
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
                  "<div class='description-block btnIn' data-id = "+id+">"+
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
      guardarAdd : function(boton, direccion){
        var $btnEnviar = boton;
        $btnEnviar.attr('disabled', 'disabled');
        $btnEnviar.text('Guardando...');
        var color = Math.floor(Math.random()*7);
        var datos = {
          nombre : $("#nombre").val(),
          estatus : "lock",
          active : 1,
          descripcion : $("#descripcion").val(),
          bg_color : colores[Math.floor(Math.random()*7)]
        };
        $.ajax({
          url: direccion,
          type: 'POST',
          data: {data: datos}
        })
        .done(function(response) {
          $btnEnviar.removeAttr('disabled');
          $btnEnviar.html("<i class='fa fa-check'></i> Guardar");
          if($.isPlainObject(response)){
            $.each(response,function(index,value){
              $.each(value,function(i, message){
                $curiosity.noty(message, 'warning');
              });
            });
          }
          else if(response[0] == 'success'){
            nivel.registro.sincronizar(response[1].nombre, response[1].bg_color, response[1].id, response[1].descripcion, response[1].estatus, response[1].imagen);
            $curiosity.noty("Registrado Correctamente", "success");
            nivel.hideAdmin();
          }
          else if(response[0] == 'same'){
            $curiosity.noty("El nombre ya existe", "warning");
          }
        })
        .fail(function(error) {
          console.log(error);
        });
      },
      guardarUpdate : function(boton, direccion, id, estatusNow){
        var $btnEnviar = boton;
        $btnEnviar.attr('disabled', 'disabled');
        $btnEnviar.text('Guardando...');
        var color = Math.floor(Math.random()*7);
        var datos = {
          idUpdate : id,
          nombre : $("#nombre").val(),
          estatus : estatusNow,
          descripcion : $("#descripcion").val(),
        };
        $.ajax({
          url: direccion,
          type: 'POST',
          data: {data: datos}
        })
        .done(function(response) {
          $btnEnviar.removeAttr('disabled');
          $btnEnviar.html("<i class='fa fa-check'></i> Guardar");
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
            nivel.hideAdmin();
          }
          else if(response[0] == 'same'){
            $curiosity.noty("El nombre ya existe", "warning");
          }
        })
        .fail(function(error) {
          console.log(error);
        });
      },
      remove : function(miId){
        var funcionRemover = function(){
          var datos = {
            id : miId
          };
          $.ajax({
            url: '/removeNivel',
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
              $("[data-id="+miId+"]").hide('slow', function() {
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
          url: "/changeImageNivel"+id+"",
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false
        })
        .done(function(response) {
          if(response[0] == 'success'){
            $(".widget-title-image > [data-id="+id+"]").attr('src', "/packages/images/niveles/"+response[1]);
            $curiosity.noty("Imagen cambiada Correctamente", "success");
          }
        })
        .fail(function(error) {
          console.log(error);
        });
      }
    }
  };

  /* Asignacion de Funciones a los botones */

  var tituloNivel = $("#nombre").val();
  var descripcionNivel = $("#descripcion").val();
  var estatus;

  $("#enviarEnv").click(function(event) {
    switch ($(this).data('tipo')) {
      case 'add':
      nivel.registro.guardarAdd($(this), "/adminNivel");
        break;
        case 'update':
        nivel.registro.guardarUpdate($(this), "/updateNivel", $(this).data('updateId'), estatus);
          break;
      default:

    }
  });

  $("#cancelarEnv").click(function(event) {
    nivel.hideAdmin();
  });

  $('#addNew').click(function(event) {
    $("#enviarEnv").data('tipo', 'add');
    nivel.showAdmin();
  });

  $("#viewSection").on('click', '.objeto > .box > .box-footer > .row > div > .btnUpdate',function(event) {
    $("#enviarEnv").data('tipo', 'update');
    var idSelected = $(this).data('id');
    $("#enviarEnv").data('updateId', idSelected);
    $("#nombre").val($("#"+idSelected).text());
    estatus = $("#"+idSelected).data('estatus');
    $("#descripcion").val($("#"+idSelected).data('descrip'));
    if(estatus == "lock"){
      $("#btnLock").removeClass('fa-unlock');
      $("#btnLock").addClass('fa-lock');
    }
    else{
      $("#btnLock").removeClass('fa-lock');
      $("#btnLock").addClass('fa-unlock');
    }
    $("#botonEstatus").show();
    nivel.showAdmin();
  });

  var isBlock = true;
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

  $("#viewSection").on('click', '.objeto > .box > .box-footer > .row > div > .btnRemove',function(event) {
    var idSelected = $(this).data('id');
    nivel.registro.remove(idSelected);
  });

  $("#viewSection").on('click', '.objeto > .box > .box-footer > .row > div > .btnIn',function(event) {
    var idSelected = $(this).data('id');
    nivel.registro.ingresar("/adminInteligencia"+idSelected);
  });

  // asignar funcionalidad de input file a la imagen del objeto
  // para poder cambiarla al dar clic sobre ella
  var idImagenData;
  $("#viewSection").on('click', '.objeto > .box > .widget-title-image > img', function(){
    idImagenData = $(this).data('id');
    $("#up-image").trigger("click");
  });

  $("#up-image").change(function(event) {
    nivel.registro.changeImagen(idImagenData);
  });

});
