$(document).ready(function() {

  var $padre = {
    validar : {
      roleFree : function(rol){
        if (rol == 'padre_free'){
          return true;
        }
        else {
          return false;
        }
      },
      hijosCount : function(){
        $.ajax({
          url: '/cotarhijos',
          type: 'POST',
          dataType: 'JSON'
        })
        .done(function(response) {
          if(response >= 1){
            $padre.denegar.regHijos($("#reg-hijos"));
          }
        })
        .fail(function(error) {
          console.log(error);
        });
      }
    },
    denegar :{
      regHijos : function($seccion){
        var code = "<div class='row'>"+
          "<div class='col-md-12'>"+
            "<div id='negated'>"+
              "<h4>Esto es una pena.</h4>"+
              "<p>"+
                "Actualmente usted cuenta con una cuenta gratuita, si desea obtener los beneficios completos que ofrece Curiosity es tiempo de cambiarte a PREMIUM ahora!!."+
              "</p>"+
              "<p>"+
                "Para mayores informes sigue el enlace dando click sobre el Boton de abajo."+
              "</p>"+
              "<br>"+
              "<center>"+
                "<button type='button' class='btn btn-info btn-lg getInfoPremium'>"+
                  "¿Qué es Premium?"+
                "</button>"+
              "</center>"+
            "</div>"+
          "</div>"+
        "</div>";
        $seccion.html(code);
      }
    }
  }

  if($padre.validar.roleFree($("#tabRegHijos").data('dad'))){
    $padre.validar.hijosCount();
  }

});
