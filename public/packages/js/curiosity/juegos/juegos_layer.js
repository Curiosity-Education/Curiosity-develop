var $juego = {
    puntuacion:0,
    modal : {
        puntuacion : {
            mostrar : function(ptsNow){
                $("#modal-puntos-now").html("<b>Puntaje Obtenido : </b>" +ptsNow+" Pts");
                // $(".btnVideo").removeAttr('disabled');
                // $(".btnDownloadPDF").removeAttr('disabled');
                $("#modalPrueba").modal('show');
            }
        }

    },
    setPuntuacion:function(puntuacion){
      $juego.puntuacion=puntuacion;
    },
    getPuntuacion:function(){
      return $juego.puntuacion;
    },
    boton : {
        comenzar : {
            setFuncion : function(funcion){
                $("#btn-comenzar").click(funcion);
            }
        }
    },
    setPuntosMaxInicio : function(puntos){
      $("#num-max-pts").text(puntos + " Pts");
    },
    setEficienciaMaxInicio : function(eficiencia){
      $("#num-max-efic").text(eficiencia + "%");
    },
    setNivelUsuarioIMG : function(){
      $.ajax({
        url:'/getEstandarte',
        method:"POST"
      }).done(function(response){
        if(response == "bronce"){
          $("img#medallaAlerta").attr("src", "/packages/images/cups/winBronce.png");
          $("img#imgNivel").attr("src", "/packages/images/cups/medallaBronce.png");
        }
        else if(response == "plata"){
          $("img#medallaAlerta").attr("src", "/packages/images/cups/winPlata.png");
          $("img#imgNivel").attr("src", "/packages/images/cups/medallaPlata.png");
        }
        else{
          $("img#medallaAlerta").attr("src", "/packages/images/cups/winOro.png");
          $("img#imgNivel").attr("src", "/packages/images/cups/medallaOro.png");
        }
      }).fail(function(error){
        console.log(error);
      });
    },
    setBackgroundImg : function(dirIMG){
      $(".zona-juego").css({
        "background-image" : "url("+dirIMG+")",
        "background-position" : "center",
        "background-repeat" : "no-repeat",
        "background-size" : "cover"
      });
    },
    setBackgroundColor : function(color){
      $(".zona-juego").css({
        "background-color" : color
      });
    },
    setTitulo : function(titulo){
      $("#juego-titulo").text(titulo);
    }
};

$(".btnVideo").click(function(){
    $("#modalPrueba").modal('hide');
    $("#modalVideo").modal('show');
});

$(".btnDownloadPDF").click(function() {
});

$("#btn-comenzar").click(function(){
  // $(".btnVideo").attr("disabled", "disabled");
  // $(".btnDownloadPDF").attr("disabled", "disabled");
});
