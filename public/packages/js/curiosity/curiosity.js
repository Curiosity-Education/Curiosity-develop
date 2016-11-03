var $curiosity = {
  menu : {
    setPaginaId : function(id){
      $(id).addClass('active');
      $(id + " > .arrowAsideActive").show();
      $(id + " > a").attr("href", "javascript:void(0)");
    }
  },
  createNotifications:function(message,titulo,image){
      // Let's check if the browser supports notifications
      if (!("Notification" in window)) {
        alert("This browser does not support desktop notification, please ... you change browser");
      }

      // Let's check whether notification permissions have already been granted
      else if (Notification.permission === "granted") {
        // If it's okay let's create a notification
        titulo = (titulo == undefined) ? "Notification" : titulo;
        var notification = new Notification(titulo,
                                            {body:message,
                                             icon:(image == undefined) ? "/packages/images/Curiosity.png" : image
                                            });
      }

      // Otherwise, we need to ask the user for permission
      else if (Notification.permission !== 'denied') {
        Notification.requestPermission(function (permission) {
          // If the user accepts, let's create a notification
          if (permission === "granted") {
            var notification = new Notification("Hi there!");
          }
        });
      }
  },
  noty:function(mensaje, tipo,titulo,image){
        document.getElementById('notyAudio').play();
        if(notify.permissionLevel() == notify.PERMISSION_DEFAULT)
            notify.requestPermission();
        else if(notify.permissionLevel() == notify.PERMISSION_GRANTED){
            if(tipo == "message")
                this.createNotifications(mensaje,titulo,image);
            else
                switch (tipo) {
                  case "success":
                    $.toast({
                      text : mensaje,
                      heading : "Bien hecho!",
                      showHideTransition : 'slide',
                      hideAfter : 5000,
                      loader : false,
                      position : 'bottom-right',
                      bgColor : '#3cb54a',
                      textColor : '#fff',
                      textAlign : 'left'
                    });
                    break;
                  case "warning":
                    $.toast({
                      text : mensaje,
                      heading : "¡Lo sentimos!!",
                      showHideTransition : 'slide',
                      hideAfter : 5000,
                      loader : false,
                      position : 'bottom-right',
                      bgColor : '#f7b219',
                      textColor : '#fff',
                      textAlign : 'left'
                    });
                    break;
                  case "info":
                    $.toast({
                      text : mensaje,
                      heading : "Informativo",
                      showHideTransition : 'slide',
                      hideAfter : 5000,
                      loader : false,
                      position : 'bottom-right',
                      bgColor : '#2d96ba',
                      textColor : '#fff',
                      textAlign : 'left'
                    });
                    break;
                  case "error":
                    $.toast({
                      text : mensaje,
                      heading : "Error",
                      showHideTransition : 'slide',
                      hideAfter : 5000,
                      loader : false,
                      position : 'bottom-right',
                      bgColor : '#ec2726',
                      textColor : '#fff',
                      textAlign : 'left'
                    });
                    break;
                }
        }
        else{
          switch (tipo) {
            case "success":
              $.toast({
                text : mensaje,
                heading : "Bien hecho!",
                showHideTransition : 'slide',
                hideAfter : 5000,
                loader : false,
                position : 'bottom-right',
                bgColor : '#3cb54a',
                textColor : '#fff',
                textAlign : 'left'
              });
              break;
            case "warning":
              $.toast({
                text : mensaje,
                heading : "¡Lo sentimos!!",
                showHideTransition : 'slide',
                hideAfter : 5000,
                loader : false,
                position : 'bottom-right',
                bgColor : '#f7b219',
                textColor : '#fff',
                textAlign : 'left'
              });
              break;
            case "info":
              $.toast({
                text : mensaje,
                heading : "Informativo",
                showHideTransition : 'slide',
                hideAfter : 5000,
                loader : false,
                position : 'bottom-right',
                bgColor : '#2d96ba',
                textColor : '#fff',
                textAlign : 'left'
              });
              break;
            case "error":
              $.toast({
                text : mensaje,
                heading : "Error",
                showHideTransition : 'slide',
                hideAfter : 5000,
                loader : false,
                position : 'bottom-right',
                bgColor : '#ec2726',
                textColor : '#fff',
                textAlign : 'left'
              });
              break;
          }
        }
  },
  notyPremium : function(){
    $("#modalPremium").modal("show");
  },
  call:{
    setData:{
        juego:function(data){
            if($.isPlainObject(data)){
                $.ajax({
                    url:'/actividad/setdata',
                    method:"POST",
                    data:data
                }).done(function(response){
                    if(response.estado == "200"){
                        // $curiosity.noty(response.message,"success");
                    }
                    else{
                      $curiosity.noty(response.message,"warning");
                    }
                }).fail(function(error,status,statusText){
                    $curiosity.noty(error,"error");
                });
            }
            else{
                throw new Exception("El paramentro data debe ser un Objeto plano");
            }
        }
    },
    getEstandarte : function($idJuego, $idHijo, $selectorIMG, $selectorIMG_alerta){
      var datos = {
        'actividad_id' : $idJuego,
        'hijo_id' : $idHijo
      }

      $.ajax({
        url: "/getEstandarte",
        type: "post",
        data: {data : datos}
      })
      .done(function(response){
        // console.log(response);
        // $selectorIMG.attr('src', '/packages/images/cups/medalla1.png');
        // $selectorIMG_alerta.attr('src', '/packages/images/cups/win1.png');
      })
      .fail(function(error){
        console.log(error);
      });
    }
  },
  notyConfirm : function($funcion){
    document.getElementById('notyAudio').play();
    swal({
      title: "¿Estas seguro que lo deseas eliminar?",
      type: "warning",
      showCancelButton: true,
      cancelButtonText: "Cancelar",
      confirmButtonColor: "#ec2726",
      confirmButtonText: "Eliminar",
      closeOnConfirm: false
    },
    function(){
      $funcion();
      document.getElementById('notyAudio').play();
      swal({
        title: "Removido!",
        text: "Removido Correctamente",
        type: "success",
        showCancelButton: false,
        showConfirmButton: false,
        closeOnConfirm: false
      });
    });
  },
  comprobarFile : function (archivo, tipos) {
   extensiones_permitidas = tipos;
    //recupero la extensión de este nombre de archivo
    extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
    //compruebo si la extensión está entre las permitidas
    permitida = false;
    for (var i = 0; i < extensiones_permitidas.length; i++) {
       if (extensiones_permitidas[i] == extension) {
       permitida = true;
       break;
       }
       //si estoy aqui es que no se ha podido submitir
      //  return false;
    }

    if (!permitida) {
      // Si la extension no se encuentra entre
      // las permitidas se muestra el sig. mensaje
       $curiosity.noty("Comprueba la extensión del archivo a subir. \nSólo se pueden subir archivos con extensiones de tipo: "+extensiones_permitidas.join(), 'info');
    	}else{
       return true;
    	}
     //si estoy aqui es que no se ha podido submitir
     return false;
  },
    validarEmbedYoutube:function(codeEmbed){
        if(/^www\.youtube\.com\/embed\/\S*$/.test(codeEmbed))
            return true;
        else
            return false;
    },
    alertaSistemaError : function(){
      swal({
        title: "Ha ocurrido un error :(",
        type: "error",
        text : "Se recargará la página e inténtalo nuevamente.\nSi el problema continúa por favor repórtalo enviando un correo electrónico detallado del problema a \n willy.ramirez@curiosity.com.mx",
        showCancelButton: false,
        confirmButtonColor: "#2284ad",
        confirmButtonText: "Aceptar y Recargar",
        closeOnConfirm: false
      },
      function(){
        window.location.reload();
      });
    }
};
//
// function nobackbutton(){
//   window.location.hash="no-back-button";
//   window.location.hash="Again-No-back-button";
//   window.onhashchange=function(){
//     window.location.hash="no-back-button";
//   };
// }

// $(window).load(function(){
//   nobackbutton();
// });
