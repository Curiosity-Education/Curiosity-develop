$(document).ready(function(){
  $juego.setBackgroundColor("rgb(25, 132, 179)");
  $juego.setBackgroundImg("/packages/images/fondos/fondo.jpg");
  $juego.setNivelUsuarioIMG();
  $juego.boton.comenzar.setFuncion(function(){
      $("#zona-play").show();
      $("#zona-obj").hide();
      game.startGame();
  });


 /*---------------------------------------------------------------
 objeto para gestionar todo lo relevanta a la tabla de multiplicar
 propiedades de tabla y funciones
 ----------------------------------------------------------------*/

 //objeto para controlar los numeros y respuestas


// ---------------------------------------------------------------------------
// Objeto para gestionar todo lo relevante al juego como puntuaje, eficiencia
// tiempo, etc
// ----------------------------------------------------------------------------


    var game={
          // Guardamos el puntaje maximo del usuario en una variable para uso global
          puntosMaximos: $juego.getPuntuacion(),
          // Establece la cantidad de segundos de inicio
          cantTemp: 90,
          // Declaramos la variable de forma globar a utilizar en el setInterval(intervalo de tiempo)
          interval:0,
          // Declaramos la variable para uso de puntaje
          puntajeNow:0,
          // Variable de control para llecar el conteo de las veces que el usuario arrastra una opcion
          intentos:0,
          // Variable para guardar la cantidad de aciertos
          continuo:0,
          // Valor que tendran los puntos al iniciar
          valorPts:100,
          // Valor de la eficiencia inicial
          eficiencia: 0,
          // Cantidad Total de click realizados
          totClicks : 0,
          // Cantidad total de aciertos
          totAciertos : 0,
          // Cantidad total de errores
          totErrores : 0,
          $temp:$("#temp-count"),
          setError: function(){
            game.cantTemp-=3;
            game.setEffect($(".img-incorrect"),'good');
            $($(".temp>i")[ahorcado.errores-1]).css("color","#ddd");
            ahorcado.setError();
            // regresamos la cantidad de aciertos continuos a cero
            this.continuo = 0;
            // Regresamos el valor de los puntos por acirto a 100
            this.valorPts = 100;
            // añadimos la clase creada en css para poner una sombra roja fuera del contenedor del juego
            $(".zona-juego").addClass('error-shadow');
            // colocamos una equis en la esquina inferior derecha dentro del div con la clase verific indicando que el usuario se ha equivocado
            $(".verific").html("<i class='fa fa-erase fa-4x'></i>").css('color', 'rgb(215, 36, 36)');
            // establecemos que despues de 600 milisegundos la clase de error se eliminara del contenedor del juego
            setTimeout(function(){
              // removemos la clase de error-shadow
              $(".zona-juego").removeClass('error-shadow');
              // eliminamos el contenido del div con la clase verific el cual contenia una equis
              $(".verific").empty();
              // Sumamos el error
              this.totErrores += 1;
              // Establecemos en cuantos milisegundos se realizará la funcion
            }, 600);
        },
        startGame: function(dificult){//funcion displarada al comenzar el juego aquí se iniciar el tiempo y se mustra la zona del juego
            //establecemos propiedades al objeto tablaW
            $("html,body").animate({scrollTop:90},'slow');
            game.setOperationNew();
            ahorcado.dibujoBase();
            $(".temp>i").css("color","red");
            $(".result-operation>td").text("_");
            game.interval = setInterval(game.restarTiempo, 1000);
        },
        setOperationNew:function(){
          operacion.num1=operacion.numeroAleatorio(500);
          operacion.num2=operacion.numeroAleatorio(500);
          if(operacion.num1>operacion.num2){
            var auxiliar = operacion.num1;
            operacion.num1=operacion.num2;
            operacion.num2=auxiliar;
          }
          var numero1= ""+operacion.num1;
          var numero2= ""+operacion.num2;
          var length = $(".operation tr.first-operation>td").length;
          $.each($(".operation tr.first-operation>td"),function(i,o){
            $($(".operation tr.first-operation>td")[(length-1)-i]).text(numero1.charAt((numero1.length-1)-i));
          });
          $.each($(".operation tr.second-operation>td"),function(i,o){
            $($(".operation tr.second-operation>td")[(length-1)-i]).text(numero2.charAt((numero2.length-1)-i));
          });

          $(".resp-operation").text("");
        },
        restarTiempo:function()
        {
            game.cantTemp--;
            game.$temp.text(game.cantTemp+" Seg");
            if(game.cantTemp<=0){
               game.finishGame();
            }
        },
        finishGame:function(){
             clearInterval(game.interval);
             game.cantTemp=90;
             operacion.posRes=2;
            // Store the current transformation matrix
            ahorcado.eliminarCirculo();
            // Use the identity matrix while clearing the canvas
            ahorcado.cntx.clearRect(0, 0, canvas.width, canvas.height);
            // Restore the transform
             ahorcado.cntx.restore();
             game.eficiencia= Math.round((game.totAciertos*100)/game.intentos);
             var data = {"puntaje":game.puntajeNow,
                        "eficiencia":game.eficiencia,
                        "promedio":(game.puntajeNow*game.eficiencia)/100};
            if(data.promedio>game.puntosMaximos){
              game.puntosMaximos=data.promedio;
              $juego.setPuntosMaxInicio(data.promedio);
            }
            $curiosity.call.setData.juego(data);
            $juego.setNivelUsuarioIMG();
            $juego.modal.puntuacion.mostrar(data.promedio);
            // console.log(data);
             $("#zona-play").hide();
             $("#zona-obj").show();
             game.intentos=0;
             game.totAciertos=0;
        },
        setCorrecto: function (){
            game.cantTemp+=4;
            game.totAciertos+1;
            game.setEffect($(".img-start"),'good');
            // sumamos el puntaje
            $("#countPuntaje").text(game.puntajeNow += game.valorPts);
            // Sumamos +1 a los aciertos continuos que llevamos
            // colocamos una palomita en la esquina inferior derecha dentro del div con la clase verific indicando que el usuario ha seleccionado             la opcion correcta
            $(".verific").html("<i class='fa fa-check fa-4x'></i>").css('color', 'rgb(255, 255, 255)');
            // establecemos que despues de 600 milisegundos la clase de error se eliminara del contenedor del juego
            setTimeout(function(){
              // eliminamos el contenido del div con la clase verific el cual contenia una palomita
            $(".verific").empty();
            // Sumamos el acierto
            game.totAciertos += 1;
            // Establecemos en cuantos milisegundos se realizará la funcion
            }, 600);
        },
        setEffect: function($element,efect){
             $element.show('fast');
             $element.css({"animation":"1.9s "+efect+" 1"});
             $element.fadeOut(1900);
        },

        // funcion que obtiene como paramentro un numer y en base a ese numero baja
        scrollMove: function(num)
        {
            num+=$(window).scrollTop();
            $("html,body").animate({scrollTop:num},'slow');
        }

    };
    var canvas= document.getElementById("can");

    var ahorcado={
      cntx:canvas.getContext("2d"),
      interval:0,
      limCY:60,
      dibujarLinea:
      //funcion para dibujar lineas en nuestra cambas :las primeras dos variables
      //nos indican en donde comienza el trazo a dibujar y el las ultimas dos
      //variables nos indican donde termina nuestro trazo
        function(mX,mY,lX,lY){
          ahorcado.cntx.beginPath();
          ahorcado.cntx.moveTo(mX,mY);
          ahorcado.cntx.lineTo(lX,lY);

          ahorcado.cntx.stroke();
          ahorcado.cntx.closePath();
        },
      dibujoBase:
      //primer linea: vertical para el dibujo del ahorcado
      function(){
          ahorcado.cntx.lineWidth=5;
          ahorcado.cntx.lineCap="round";
          ahorcado.cntx.strokeStyle="rgb(225, 220, 222)";
          ahorcado.dibujarLinea(100,30,100,130);
          //seguna linea: horizontal
          ahorcado.dibujarLinea(100,30,160,30);
          //tercer linea:horizontal para la base del dibujo del ahorcado
          ahorcado.dibujarLinea(70,130,140,130);
          //cuarta linea:vertica para la bade superior del dibujo del ahorcado
          ahorcado.dibujarLinea(160,30,160,40);
      },
      errores:1,
      dibujarCara:function(){
          ahorcado.cntx.beginPath();
          ahorcado.cntx.arc(160,50,10,0,(Math.PI/180)*360,true);
          ahorcado.cntx.stroke();
          ahorcado.cntx.closePath();
      },
      eliminarCirculo:function(){
          ahorcado.cntx.beginPath();
          ahorcado.cntx.strokeStyle="rgba(45, 63, 208, 0)";
          ahorcado.cntx.arc(160,50,10,0,(Math.PI/180)*360,true);
          ahorcado.cntx.stroke();
          ahorcado.cntx.closePath();
      },
      dibujarCuerpo:function(){
          ahorcado.dibujarLinea(160,60,160,90)
          ahorcado.limCY++;
      },
      dibujarManos:function(right){
          if(right){
             ahorcado.dibujarLinea(160,70,150,80);
          }else{
            ahorcado.dibujarLinea(160,70,170,80);
          }
      },
      setError:function(){
        switch(ahorcado.errores){
          case 1:
            ahorcado.cntx.strokeStyle="rgb(225, 220, 222)";
            ahorcado.dibujarCara();
            ahorcado.errores++;
          break;
          case 2:
            ahorcado.dibujarCuerpo();
            ahorcado.errores+=1;
          break;
          case 3:
            ahorcado.dibujarManos(true);
            ahorcado.errores++;
          break;
          case 4:
            ahorcado.dibujarManos(false);
            ahorcado.errores++;
          break;
          case 5:
            ahorcado.dibujarPies(true);
            ahorcado.errores++;
          break;
          case 6:

            ahorcado.dibujarPies(false),
            ahorcado.errores= 1;
            ahorcado.limCY=60;
            var intervalo = setInterval(function(){
              clearInterval(intervalo);
              game.cantTemp=0;
            },1000)

          break;
        }
      },

      dibujarPies:function(right){
         if(right){
            ahorcado.dibujarLinea(160,90,150,100);
          }else{
            ahorcado.dibujarLinea(160,90,170,100);
          }
      }

    };
    var operacion ={
      num1:0,
      num2:0,
      posRes:2,
      numeroAleatorio: function(num){
        var numero = Math.round((Math.random()*num));
        return numero;
      },
      check:function(res){
        if(res==(operacion.num1+operacion.num2)){
          return true;
        }else return false;
      }
    }
    $(".num").click(function(){
      text = $(this).text();
      if(operacion.posRes>=0){
        $($(".result-operation>td")[operacion.posRes]).text(text);
          operacion.posRes--;
      }
    });
    $("#delete").click(function(){
      if(operacion.posRes>=-1 && operacion.posRes<2){//if para verificar que aún haya celdas disponibles para escribír
        operacion.posRes++;
        $($(".result-operation>td")[operacion.posRes]).text("_");
      }
    });
    $("#check").click(function(){
      var text=$(".result-operation>td").text();
      text = text.substring(operacion.posRes+1,$(".result-operation>td").length);
      if(text.length>0){
        game.intentos++;
        if(operacion.check(parseInt(text))){
          game.setCorrecto();
          game.setOperationNew();
        }else{
          game.setError();
          ahorcado.dibujarCara();
        }
        $(".result-operation>td").text("_");
        operacion.posRes=2;
      }

    });

});

