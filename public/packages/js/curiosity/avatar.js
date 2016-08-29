var $avatar = {
  helperHide : function(){
    $(".seccionAdmin").hide('slow');
    $("#viewEstilos").hide('slow');
    $("#viewSecuencias").hide('slow');
    $("#viewSection").show("slow");
    $(".btn-gestion-avatar").hide('slow');
    $("#addNew").show('slow');
    $("#back").hide('slow');
    $(".form-control").val("");
    $("#sexoAvatar").val($("#sexoAvatar").children().first().val());
    $(".btnUploadImg").css({
      'padding-top': "25px",
      'height' : '150px'
    });
    $(".btnUploadImg").html("<span class='fa fa-file-image-o fa-3x'></span><br><br>click para seleccionar");
  },
  avatar : {
    guardar : function($boton, formData){
      $boton.html("<span class='fa fa-spinner fa-pulse fa-fw'></span>&nbsp;Guardando");
      $.ajax({
        url: '/registrarAvatar',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
      })
      .done(function(response) {
        if($.isPlainObject(response)){
          $.each(response,function(index,value){
            $.each(value,function(i, message){
              $curiosity.noty(message, 'warning');
            });
          });
        }
        else if (response[0] == "fileEmpty") {
          $curiosity.noty("No se reconoce ninguna imagen valida. Por favor intentelo nuevamente", 'info');
        }
        else if (response[0] == "success") {
          $estructura.avatar(response[1]);
          $avatar.helperHide();
          $curiosity.noty("Se ha registrado un nuevo avatar.", "success");
        }
      })
      .fail(function(error) {
        console.log(error);
      })
      .always(function(){
        $boton.html("<span class='fa fa-upload'></span>&nbsp;Guardar");
      });
    },
    actualizar : function($boton, $selector, $elemento, formData){
      $boton.html("<span class='fa fa-spinner fa-pulse fa-fw'></span>&nbsp;Actualizando");
      $.ajax({
        url: '/actualizarAvatar',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
      })
      .done(function(response) {
        if($.isPlainObject(response)){
          $.each(response,function(index,value){
            $.each(value,function(i, message){
              $curiosity.noty(message, 'warning');
            });
          });
        }
        else if (response[0] == "success") {
          var $resp = JSON.parse(response[1]);
          $selector.data('dat', $resp);
          $elemento.attr('style', "background:url(/packages/images/avatars_curiosity/estilos/"+$resp['preview']+");background-position: center;background-repeat: no-repeat;background-size: cover;");
          $avatar.helperHide();
          $curiosity.noty("Se ha actualizado el avatar seleccionado.", "success");
        }
      })
      .fail(function(error) {
        console.log(error);
      })
      .always(function(){
        $boton.html("<span class='fa fa-upload'></span>&nbsp;Guardar");
      });
    },
    eliminar : function(miId, $selector){
      var remover = function(){
        var datos = {
          id : miId
        };
        $.ajax({
          url: '/eliminarAvatar',
          type: 'POST',
          data: {data: datos}
        })
        .done(function(response) {
          if(response[0] == 'success'){
            $selector.hide('slow', function() {
              $(this).remove();
            });
          }
          else{
            console.log(response);
          }
        })
        .fail(function(error) {
          console.log(error);
        });
      }
      $curiosity.notyConfirm(remover);
    }
  },
  estilo : {
    helperCleanStyle : function(){
      $("#newEstilo").show('slow');
      $("#estilos").hide('slow');;
      $("#viewEstilos").show('slow');
      $("#addSecuencias").hide('slow');
      $("#back").data('go', 'avatar');
      $("#nombreEstilo").val("");
      $("#valorEstilo").val("");
      $("#descripcionEstilo").val("");
      $(".btnUploadImg").css({
        'padding-top': "25px",
        'height' : '150px'
      });
      $(".btnUploadImg").html("<span class='fa fa-file-image-o fa-3x'></span><br><br>click para seleccionar");
    },
    getById : function($id, $sel){
      $.ajax({
        url: '/getEstilos',
        type: 'POST',
        data: {data: $id}
      })
      .done(function(response) {
        $sel.html("");
        $.each(response, function(index, obj) {
          $sel.append($estructura.estilo(obj));
        });
        $sel.show('slow');
      })
      .fail(function(error) {
        console.log(error);
      })
      .always(function() {
      });
    },
    guardar : function($boton, formData){
      $boton.html("<span class='fa fa-spinner fa-pulse fa-fw'></span>&nbsp;Guardando");
      $.ajax({
        url: '/registrarEstilo',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
      })
      .done(function(response) {
        if($.isPlainObject(response)){
          $.each(response,function(index,value){
            $.each(value,function(i, message){
              $curiosity.noty(message, 'warning');
            });
          });
        }
        else if (response[0] == "fileEmpty") {
          $curiosity.noty("No se reconoce ninguna imagen valida. Por favor intentelo nuevamente", 'info');
        }
        else if (response[0] == "success") {
          $("#viewEstilos").append($estructura.estilo(response[1]));
          $avatar.estilo.helperCleanStyle();
          $curiosity.noty("Se ha registrado un nuevo estilo para el avatar seleccionado.", 'success');
        }
      })
      .fail(function(error) {
        console.log(error);
      })
      .always(function(){
        $boton.html("<span class='fa fa-upload'></span>&nbsp;Guardar Estilo");
      });
    },
    actualizar : function($boton, $selector, $elemento, formData){
      $boton.html("<span class='fa fa-spinner fa-pulse fa-fw'></span>&nbsp;Actualizando");
      $.ajax({
        url: '/actualizarEstilo',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
      })
      .done(function(response) {
        if($.isPlainObject(response)){
          $.each(response,function(index,value){
            $.each(value,function(i, message){
              $curiosity.noty(message, 'warning');
            });
          });
        }
        else if (response[0] == "success") {
          var $resp = JSON.parse(response[1]);
          $selector.data('dat', $resp);
          $elemento.attr('style', "background:url(/packages/images/avatars_curiosity/estilos/"+$resp['preview']+");background-position: center;background-repeat: no-repeat;background-size: cover;");
          $avatar.estilo.helperCleanStyle();
          $curiosity.noty("Se ha actualizado el estilo de avatar seleccionado", 'success');
        }
      })
      .fail(function(error) {
        console.log(error);
      })
      .always(function(){
        $boton.html("<span class='fa fa-upload'></span>&nbsp;Guardar Estilo");
      });
    },
    eliminar : function($id, $selector){
      var remover = function(){
        $.ajax({
          url: '/eliminarEstilo',
          type: 'POST',
          data: {data: $id}
        })
        .done(function(response) {
          if(response[0] == 'success'){
            $selector.hide('slow', function() {
              $(this).remove();
            });
          }
          else{
            console.log(response);
          }
        })
        .fail(function(error) {
          console.log(error);
        });
      }
      $curiosity.notyConfirm(remover);
    }
  },
  secuencia : {
    getById : function($id, $sel){
      $.ajax({
        url: '/getSecuencias',
        type: 'POST',
        data: {data: $id}
      })
      .done(function(response) {
        console.log(response);
        if(response.length > 0){
          $sel.html("");
          $.each(response, function(index, obj) {
            $sel.append($estructura.secuencia(obj));
          });
          $sel.show('slow');
        }
        else{
          $sel.append($estructura.isEmpty());
          $estructura.flag = 1;
          $sel.show('slow');
        }
      })
      .fail(function(error) {
        console.log(error);
      })
      .always(function() {
      });
    },
    helperClean : function(){
      $("#secuencias").hide('slow');
      $("#viewSecuencias").show('slow');
      $("#newSecuencia").show('slow');
      $("#back").data('go', 'estilos');
      $("#tipoSecuencia").html('');
      $(".btnUploadImg").css({
        'padding-top': "25px",
        'height' : '150px'
      });
      $(".btnUploadImg").html("<span class='fa fa-file-image-o fa-3x'></span><br><br>click para seleccionar");
    },
    guardar : function($boton, formData){
      $boton.html("<span class='fa fa-spinner fa-pulse fa-fw'></span>&nbsp;Guardando");
      $.ajax({
        url: '/resgistrarSecuencia',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
      })
      .done(function(response) {
        if($.isPlainObject(response)){
          $.each(response,function(index,value){
            $.each(value,function(i, message){
              $curiosity.noty(message, 'warning');
            });
          });
        }
        else if (response[0] == "fileEmpty") {
          $curiosity.noty("No se reconoce ninguna imagen valida. Por favor intentelo nuevamente", 'info');
        }
        else if (response[0] == "success") {
          if($estructura.flag != 0){
            $("#viewSecuencias").html('');
            $estructura.flag = 0;
          }
          $("#viewSecuencias").append($estructura.secuencia(response[1]));
          $avatar.secuencia.helperClean();
          $curiosity.noty("Se ha registrado una nueva secuencia para el estilo de avatar seleccioando", 'success');
        }
      })
      .fail(function(error) {
        console.log(error);
      })
      .always(function(){
        $boton.html("<span class='fa fa-upload'></span>&nbsp;Guardar Secuencia");
      });
    },
    eliminar : function($dat, $selector){
      var remover = function(){
        $.ajax({
          url: '/eliminarSecuencia',
          type: 'POST',
          data: {data: $dat}
        })
        .done(function(response) {
          if(response[0] == 'success'){
            $selector.hide('slow', function() {
              $(this).remove();
            });
          }
          else{
            console.log(response);
          }
        })
        .fail(function(error) {
          console.log(error);
        });
      }
      $curiosity.notyConfirm(remover);
    }
  }
}
