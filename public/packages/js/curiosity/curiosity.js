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
                    url:'actividad/setdata',
                    method:"POST",
                    dataType:"JSON",
                    data:data
                }).done(function(response){
                    if(response.estado == "200")
                        $curiosity.noty(response.message,"success");
                    else
                        $curiosity.noty(response.message,"warning");
                }).fail(function(error,status,statusText){
                    $curiosity.noty(error,"error");
                });
            }
            else{
                throw new Exception("El paramentro data debe ser un Objeto plano");
            }
        }
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
