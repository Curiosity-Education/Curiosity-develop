$(document).ready(function(){
    //El juego aun no es responsivo y tengo detalles pendientes como el cambiar el color de las cartas a cada click que den
    var respuesta;
    var respuestadouble;
    var limite=0;
    var lados;
    var answer;
    var inicio=false;
    var imagenes = [
        "<img src='/packages/images/games/triangulo.png' class='img img-responsive'>",
        "<img src='/packages/images/games/cuadrado.png' class='img img-responsive'>",
        "<img src='/packages/images/games/pentagono.png' class='img img-responsive'>",
        "<img src='/packages/images/games/hexagono.png' class='img img-responsive'>",
        "<img src='/packages/images/games/heptagono.png' class='img img-responsive'>",
        "<img src='/packages/images/games/octagono.png' class='img img-responsive'>",
        "<img src='/packages/images/games/eneagono.png' class='img img-responsive'>",
        "<img src='/packages/images/games/decagono.png' class='img img-responsive'>"
    ];
    //Zona del estandar de desarrollo de juegos //
      $curiosity.menu.setPaginaId("#li-conteo-basico");
      $juego.setTitulo("Conteo - Basico");
      $juego.setBackgroundColor("rgb(25, 132, 179)");
      $juego.setBackgroundImg("/packages/images/fondos/fondo.jpg");
      $juego.boton.comenzar.setFuncion(function(){
        if(inicio==false){
                inicio=true;
                $juego.game.start(60,false);
                lados=aleatorio();
                answer=lados+6;
                $("#figura1").html(imagenes[lados]);
                $("#simbolo").html("  +");
                lados=aleatorio();
                answer=answer+lados;
                $("#figura2").html(imagenes[lados]);
        }
      });
      $juego.setSrcVideo({
        titulo:"| Conteo basico |",
        ruta:"/packages/video/games/instrucciones/conteo-basico.mp4",
        explanation1:"1. Cuenta los diferentes objetos que se mueven.",
        explanation2:"2. Elige la carta con el numero de objetos que contaste."
      });
       $juego.slider.changeImages({
          img1:"conteo01.png",
          img2:"conteo03.png",
          img3:"conteo02.png"
       });

    //Fin de la zona de estandar //
    var simbolo="  +"
    function aleatorio(){
        var aleatorio=Math.round(Math.random()*7);
        return aleatorio;
    }
    $("#game").on("finish",function(){
        inicio = false;
    });
    $("#game").on("exit",function(){
        inicio= false;
    });
    $("#game").on("restart",function(){
        inicio=false;
    });
    $("#c0").click(function(){
        if(inicio==true)
            {
                if($("#respuesta").text()=="R = ")
                    {
                        $("#respuesta").append("0");
                        respuesta="0";
                        limite++;
                    }
                else if(limite<2)
                    {
                        $("#respuesta").append("0");
                        respuesta=respuesta+"0";
                        limite++;
                    }
            }
    });
    $("#c1").click(function(){
        if(inicio==true)
            {
                if($("#respuesta").text()=="R = ")
                    {
                        $("#respuesta").append("1");
                        respuesta="1";
                        limite++;
                    }
                else if(limite<2)
                    {
                        $("#respuesta").append("1");
                        respuesta=respuesta+"1";
                        limite++;
                    }
            }
    });
    $("#c2").click(function(){
        if(inicio==true)
            {
                if($("#respuesta").text()=="R = ")
                    {
                        $("#respuesta").append("2");
                        respuesta="2";
                        limite++;
                    }
                else if(limite<2)
                    {
                        $("#respuesta").append("2");
                        respuesta=respuesta+"2";
                        limite++;
                    }
            }
    });
    $("#c3").click(function(){
        if(inicio==true)
            {
                if($("#respuesta").text()=="R = ")
                    {
                        $("#respuesta").append("3");
                        respuesta="3";
                        limite++;
                    }
                else if(limite<2)
                    {
                        $("#respuesta").append("3");
                        respuesta=respuesta+"3";
                        limite++;
                    }
            }
    });
    $("#c4").click(function(){
        if(inicio==true)
            {
                if($("#respuesta").text()=="R = ")
                    {
                        $("#respuesta").append("4");
                        respuesta="4";
                        limite++;
                    }
                else if(limite<2)
                    {
                        $("#respuesta").append("4");
                        respuesta=respuesta+"4";
                        limite++;
                    }
            }
    });
    $("#borrar").click(function(){
        if(inicio==true)
            {
                $("#respuesta").html("R = ");
                limite=0;
                respuesta="";
            }
    });
    $("#c5").click(function(){
        if(inicio==true)
            {
                if($("#respuesta").text()=="R = ")
                    {
                        $("#respuesta").append("5");
                        respuesta="5";
                        limite++;
                    }
                else if(limite<2)
                    {
                        $("#respuesta").append("5");
                        respuesta=respuesta+"5";
                        limite++;
                    }
            }
    });
    $("#c6").click(function(){
        if(inicio==true)
            {
                if($("#respuesta").text()=="R = ")
                    {
                        $("#respuesta").append("6");
                        respuesta="6";
                        limite++;
                    }
                else if(limite<2)
                    {
                        $("#respuesta").append("6");
                        respuesta=respuesta+"6";
                        limite++;
                    }
            }
    });
    $("#c7").click(function(){
        if(inicio==true)
            {
                if($("#respuesta").text()=="R = ")
                    {
                        $("#respuesta").append("7");
                        respuesta="7";
                        limite++;
                    }
                else if(limite<2)
                    {
                        $("#respuesta").append("7");
                        respuesta=respuesta+"7";
                        limite++;
                    }
            }
    });
    $("#c8").click(function(){
        if(inicio==true)
            {
                if($("#respuesta").text()=="R = ")
                    {
                        $("#respuesta").append("8");
                        respuesta="8";
                        limite++;
                    }
                else if(limite<2)
                    {
                        $("#respuesta").append("8");
                        respuesta=respuesta+"8";
                        limite++;
                    }
            }
    });
    $("#c9").click(function(){
        if(inicio==true)
            {
                if($("#respuesta").text()=="R = ")
                    {
                        $("#respuesta").append("9");
                        respuesta="9";
                        limite++;
                    }
                else if(limite<2)
                    {
                        $("#respuesta").append("9");
                        respuesta=respuesta+"9";
                        limite++;
                    }
            }
    });
    $("#comprobar").click(function(){
        if(inicio==true)
            {
                respuestadouble=parseFloat(respuesta);
                if(respuestadouble==answer)
                    {
                        $juego.game.setCorrecto();
                        lados=aleatorio();
                        answer=lados+6;
                        limite=0;
                        $("#figura1").html(imagenes[lados]);
                        $("#simbolo").html("  +");
                        lados=aleatorio();
                        answer=answer+lados;
                        $("#figura2").html(imagenes[lados]);
                        $("#respuesta").html("R = ");
                        $("#figurita").html("<img src='/packages/images/games/estrella2.jpg' class='img2'>");
                    }
                else
                    {
                        $juego.game.setError(60);
                        $("#figurita").html("<img src='/packages/images/games/caritatriste.jpg' class='img2'>");
                       
                    }
            }
    });
})