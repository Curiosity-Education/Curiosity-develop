var $curiosity = {
  menu : {
    setPaginaId : function(id){
      $(id).addClass('active');
    }
  },
  noty : function(mensaje, tipo){
    var n = noty({
        text        : mensaje,
        type        : tipo,
        dismissQueue: true,
        timeout     : 3000,
        closeWith   : ['click'],
        layout      : 'bottomRight',
        theme       : 'defaultTheme',
        maxVisible  : 10
     });
     document.getElementById('notyAudio').play();
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
        console.log(response);
        $selectorIMG.attr('src', '/packages/images/cups/medalla1.png');
        $selectorIMG_alerta.attr('src', '/packages/images/cups/win1.png');
      })
      .fail(function(error){
        console.log(error);
      });
    }
  },
  notyConfirm : function($funcion){
    swal({
      title: "¿Seguro que desea remover?",
      text: "¡El elemento puede ser recuperado al registrarse con el mismo nombre!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c9371a",
      confirmButtonText: "Sí, Remover!",
      closeOnConfirm: false
    },
    function(){
      $funcion();
      swal("Removido!", "Removido Correctamente", "success");
      document.getElementById('notyAudio').play();
    });
  },
  comprobarFile : function (archivo, tipos) {
   extensiones_permitidas = tipos;
   mierror = "";
   if (!archivo) {
      //Si no tengo archivo, es que no se ha seleccionado un archivo en el formulario
        $curiosity.noty('No se ha seleccionado ningun archivo', 'warning');
   }else{
      //recupero la extensión de este nombre de archivo
      extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
      //compruebo si la extensión está entre las permitidas
      permitida = false;
      for (var i = 0; i < extensiones_permitidas.length; i++) {
         if (extensiones_permitidas[i] == extension) {
         permitida = true;
         break;
         }
      }
      if (!permitida) {
        // Si la extension no se encuentra entre
        // las permitidas se muestra el sig. mensaje
         $curiosity.noty("Comprueba la extensión del archivo a subir. \nSólo se pueden subir archivos con extensiones de tipo: "+extensiones_permitidas.join(), 'warning');
      	}else{
         return true;
      	}
       }
       //si estoy aqui es que no se ha podido submitir
       return false;
    }

};
 $("form").submit(function(e){
   e.preventDefault();
  });
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
