

var $estructura = {
  flag : 0,
  isEmpty : function(){
    var code = "<div class='container-fluid'><div class='col-xs-12 isEmpty text-center'>No se encontraron resultados</div></div>";
    return code;
  },
  avatar : function(datos){
    var imagen = JSON.parse(datos);
    var code = "<div class='col-sm-3'>"+
      "<div class='avatarFace' style='background:url(/packages/images/avatars_curiosity/estilos/"+imagen['preview']+");background-position: center;background-repeat: no-repeat;background-size: cover;'>"+
        "<div class='botonesAvatarFace'>"+
          "<button type='button' class='btn btn-info btn-fab tooltipShow gestionarAv' title='Gestionar'"+
          "data-dat='"+datos+"'>"+
            "<span class='fa fa-gears'></span>"+
          "</button>"+
          "<button type='button' class='btn btn-danger btn-fab tooltipShow eliminarAv' title='Eliminar' data-dat='"+datos+"'>"+
            "<span class='fa fa-times'></span>"+
          "</button>"+
        "</div>"+
      "</div>"+
    "</div>";
    $("#viewSection").append(code);
    return;
  },
  estilo : function($estilo){
    var obj = $estilo;
    var estilo = JSON.parse(obj);
    var code;
    if(estilo['is_default'] != 1){
      code = "<div class='col-sm-3'>"+
        "<div class='avatarFace' style='background:url(/packages/images/avatars_curiosity/estilos/"+estilo['preview']+");background-position: center;background-repeat: no-repeat;background-size: cover;'>"+
          "<div class='botonesAvatarFace'>"+
            "<button type='button' class='btn btn-info btn-fab tooltipShow gestionarEst' title='Gestionar' data-dat='"+obj+"'>"+
              "<span class='fa fa-gears'></span>"+
            "</button>"+
            "<button type='button' class='btn btn-danger btn-fab tooltipShow eliminarEst' title='Eliminar' data-dat='"+obj+"'>"+
              "<span class='fa fa-times'></span>"+
            "</button>"+
          "</div>"+
        "</div>"+
      "</div>";
    }
    else{
      code = "<div class='col-sm-3'>"+
        "<div class='avatarFace' style='background:url(/packages/images/avatars_curiosity/estilos/"+estilo['preview']+");background-position: center;background-repeat: no-repeat;background-size: cover;'>"+
          "<div class='botonesAvatarFace'>"+
            "<center><button type='button' class='btn btn-default btn-fab tooltipShow' id='secDef' title='Secuencias avatar default' data-dat='"+obj+"'>"+
              "<span class='fa fa-male'></span>"+
            "</button></center>"+
          "</div>"+
        "</div>"+
      "</div>";
    }
    return code;
  },
  secuencia : function($secuencia){
    var obj = $secuencia;
    var secuencia = JSON.parse(obj);
    var code = "<div class='col-sm-3'>"+
      "<div class='avatarFace' style='background:url(/packages/images/avatars_curiosity/secuencias/"+secuencia['sprite']+");background-position: center;background-repeat: no-repeat;background-size: cover;'>"+
        "<div class='botonesAvatarFace'>"+
          "<button type='button' class='btn btn-danger btn-fab tooltipShow eliminarSec' title='Eliminar' data-dat='"+obj+"'>"+
            "<span class='fa fa-times'></span>"+
          "</button>"+
        "</div>"+
      "</div>"+
    "</div>";
    return code;
  }
}
