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
        },
        archivoPDF : {
            setDireccion : function(dir){
                $("#btnDownloadPDF").attr({
                  'href' : dir
                });
            },
            setNombreDescarga : function(nombre){
                $("#btnDownloadPDF").attr({
                  'download' : nombre
                });
            }
        },
        video : {
            setVideo : function(embedCode){
              $("#videoApoyo").attr('src', embedCode);
            }
        }
    },
    setObjetivo : function(objetivo){
      $("#juego-objetivo").text(objetivo);
    },
    setPuntosMaxInicio : function(puntos){
      $("#num-max-pts").text(puntos + " Pts");
    },
    setEficienciaMaxInicio : function(eficiencia){
      $("#num-max-efic").text(eficiencia + "%");
    },
    setNivelUsuarioIMG : function(dirIMG){
      $("img#imgNivel").attr("src", dirIMG);
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
