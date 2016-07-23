$(document).ready(function(){

  var objetivo = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor reiciendis eius inventore placeat facere minima fuga aliquam, cumque numquam aspernatur vel voluptatibus harum natus quo odio est rem repellat rerum nobis libero dolorem totam neque hic quisquam accusamus. Facilis unde libero omnis eligendi tempore repudiandae voluptate eaque ullam explicabo ducimus.";
  $curiosity.menu.setPaginaId("#li-tablas");
  $juego.setTitulo("Tablas de multiplicar");
  $juego.setObjetivo(objetivo);
  $juego.setBackgroundColor("rgb(25, 132, 179)");
  $juego.setBackgroundImg("/packages/images/fondos/fondo.jpg");
  $juego.setNivelUsuarioIMG("/packages/images/cups/medalla1.png");
  $juego.boton.archivoPDF.setDireccion('/packages/docs/pruebaPDF.pdf');
  $juego.boton.archivoPDF.setNombreDescarga('Guia Sumas Restas');
  $juego.boton.video.setVideo('/packages/video/Restas.mp4');
  $juego.slider.changeImages({
      img1:"tablas01.png",
      img2:"tablas02.png",
      img3:"tablas03.png"
  });
  $juego.setSrcVideo({
    titulo:"| Tablas de multiplicar |",
    ruta:"/packages/video/games/instrucciones/tablas.mp4",
    explanation1:"1. Arrastra los números dentro de los recuadros para fomar la respuesta correcta.",
    explanation2:""
  });

 /*---------------------------------------------------------------
 objeto para gestionar todo lo relevanta a la tabla de multiplicar
 propiedades de tabla y funciones
 ----------------------------------------------------------------*/
  var tabla = {
     nivel:1,//representa el numero de la tabla por ejemplo la tabla del uno, la tabla del dos, etc
     res:"",//variable que captura la respuesta seleccionada por el usuario
     pos:0,//variable de control para saber en que posicion o en que renglon  del la tabla de multiplicar nos encontramos
     $n1:$(),//numero uno de la tabla de multiplicar
     $n2:$(),//numero dos de la tablade multiplicar
     $niveles:$(),//Elemento del Dom donde se encuentran los niveles(estrellas) al llegar al diez o tabla del 10 el juego termina
     $zonaRes:$(),//Zona donde el usuario arrastra las opciones seleccionadas
     $res:$(),//Elemento del Dom donde se encuentra el resultado de la tabla este numero se genera de la multiplicación de los numeros ya menciondao $n1 y $n2
     capturado:false,//variable de auxiliar para saber si la respuesta arrastrada fue capturada en la zona de respuestas
    // cantidad de elementos a mostrar
     listElements:4,
     generarTabla : function(dificult){// se genera la tabla de multiplicar segun su nivel
      var numeros=[1,2,3,4,5,6,7,8,9,10];
        for(var i=0;i<this.$n1.length;i++){
            this.$n1.text(this.nivel);
            if(dificult){
                var n_random = this.valorRandom(numeros.length-1);
                numero = numeros[n_random];
                console.log(numeros[n_random]+" "+n_random);
                numeros.splice(n_random,1);
                $(this.$n2[i]).data("valor",numero);
                $(this.$n2[i]).text(numero);
                $(this.$res[i]).data("valor",this.nivel*(numero));
            }else{
                $(this.$n2[i]).data("valor",i+1);
                $(this.$n2[i]).text(i+1);
                $(this.$res[i]).data("valor",this.nivel*(i+1));
            }
        }
    },
    hideOptions:function(){
        limite =tabla.pos+4;
        if(limite>10){
          $(".tb").hide();
          for(var i=tabla.pos-2;i<limite;i++){
            $($(".tb")[i]).show();
          }
        }else{

           $(".tb").hide();
          for(var i=tabla.pos;i<limite;i++){
            $($(".tb")[i]).show();
          }
        }

    },
    verificar:function($n){//funcion que verifica si el resultado seleccionado por el usuario es correcto
        if($n==$(this.$res[this.pos]).data("valor")){// si el numero que selecciono es correcto regresamos true  si no false

            $(this.$res[this.pos]).parent().parent().removeClass("activ");
            $(this.$res[this.pos]).parent().parent().find("i").removeClass("fa-square-o");
            $(this.$res[this.pos]).parent().parent().find("i").addClass("fa-check");
            $(this.$res[this.pos]).text($(this.$res[this.pos]).data("valor"));
            $(this.$niveles[this.pos]).css("color","yellow");
            this.pos++;
            if(tabla.pos===tabla.listElements){
                tabla.hideOptions();
                tabla.listElements+=tabla.listElements;
            }
            var nivelTem=10;
            document.getElementById('sound-correct1').play();
            if(this.pos>9){
              game.finishGame();
              /*  $(this.$niveles[this.nivel-1]).css("color","yellow")
                nivelTem= this.nivel;
                this.nivel++;
                this.pos=0;
                this.clearRes();
                this.generarTabla();
            }
            if(this.nivel>this.nivelTem)
            {
                game.finishGame();
            }*/
            }
            $(this.$res[this.pos]).parent().parent().addClass("activ");

            this.lenghtRes();
            return true;
        }
        else{
            document.getElementById('sound-error').play();
            return false;
        }
    },
    valorRandom: function (numMayor){
      var numero =  Math.round((Math.random() * numMayor));
      return numero;
    },
    lenghtRes:function()//funciton auxiliar que nos ayuda a saber la lonjtud de la respuesta
    {
        if($(this.$res[this.pos]).data("valor")>9){
            $(this.$res[this.pos]).text("??");
            $(this.$zonaRes).removeClass("center-cont");
            $(this.$zonaRes).removeClass('hidden');
            return 2;
        }
        else if($(this.$res[this.pos]).data("valor")>99)
            return 3;
        else{
             this.$zonaRes.last().addClass("hidden");
             this.$zonaRes.first().addClass("center-cont");
             $(this.$res[this.pos]).text("?");
             return 1;
        }

    },
    restorePlay:function(){
        this.clearRes();
        this.pos=0;
        this.nivel=1;
        tabla.listElements=4;
        this.$res.parent().parent().removeClass("activ");
        this.$res.parent().parent().first().addClass("activ");
        this.$niveles.css("color","#fff");
    },
    clearRes:function(){//funcion auxiliar para reinciar las respuestas una vez completada la tabla de multiplicar
        this.$res.text("");
        $(".check").addClass("fa-square-o");
        $(".check").removeClass("fa-check");

    }
 }
 //objeto para controlar los numeros y respuestas


// ---------------------------------------------------------------------------
// Objeto para gestionar todo lo relevante al juego como puntuaje, eficiencia
// tiempo, etc
// ----------------------------------------------------------------------------


    var game={  
        startGame: function(dificult){//funcion displarada al comenzar el juego aquí se iniciar el tiempo y se mustra la zona del juego
            //establecemos propiedades al objeto tabla
            tabla.$n1=$(".n1");
            tabla.$n2=$(".n2");
            tabla.$res=$(".res");
            tabla.$zonaRes =$(".zona-respuestas>h1");
            tabla.$zonaRes.empty();
            tabla.$niveles=$("#niveles>i");
            tabla.generarTabla(dificult);
            tabla.capturado=false;
            $(".n-res2").hide();
            $("html,body").animate({scrollTop:100},'slow');
            if(!dificult){
              $(".temp").hide();
            }else{
               $(".temp").show();
               $juego.cronometro.start(90,false);
            }
            tabla.$zonaRes.hide();
            tabla.$zonaRes.droppable('option','disabled',false);
            tabla.res="";
            tabla.lenghtRes();
            tabla.hideOptions();
            //interval = setInterval(changeTime,1000);
        },
        finishGame:function(){
             tabla.restorePlay();
             $juego.game.finish();
        },
        hideResponse: function(speed)
        {
            $(".zona-respuestas>h1").hide(speed);
            $("div.advice").show(speed);
        },
        showResponse:function(speed){
             $("div.advice").hide(speed);
             $(".zona-respuestas>h1").show(speed);
        },
        fadeOutResponse: function(slow,speed)
        {
             $("div.advice").show('slow');
             $(".zona-respuestas>h1").fadeOut(speed);
        },
        setEffect: function($element,efect)
        {
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
  /*--------------------------------------------------------------------*/
      $juego.boton.comenzar.setFuncion(function(){
        $juego.game.start();
        $("button[data-target='#nivel-tablas']").trigger("click");
      });
 /*----------------------------------------------------------------------*/
    $(".zona-numeros>h2").draggable({
        helper:'clone',
        start:function(){
           game.showResponse('fast');
           game.intentos++;
        },
        stop:function(){
            if(tabla.lenghtRes()>1){
                //el resultado es mayor que 9
                if(tabla.capturado){
                  tabla.res+=$(this).text();
                  if(tabla.res.length>1)
                  {
                      if(tabla.verificar(tabla.res)){
                          game.setEffect($(".img-start"),'good');
                          $juego.game.setCorrecto();

                      }
                      else{
                          $juego.game.setError();
                      }
                      $(".zona-respuestas>h1").droppable('option','disabled',false);
                      game.fadeOutResponse(2000,function(){$(".zona-respuestas>h1").empty()});
                      tabla.res="";
                  }
                  tabla.capturado=false;
                }

            }else{

                //el resultado es menor que 10
                if(tabla.capturado){
                    if(tabla.verificar($(this).text())){
                        game.setEffect($(".img-start"),"good");
                        $juego.game.setCorrecto();

                    }
                    else{
                        game.setEffect($(".img-incorrect"),"bad");
                        $juego.game.setError();
                    }
                    game.fadeOutResponse(2000,function(){$(".zona-respuestas>h1").empty()});
                    tabla.capturado=false;
                }
            game.fadeOutResponse(800);
            }
        }
    });
  /*-------------------------------------------------------------------*/
  /*Establecer el metodo a los contenedores de respuestas pera que estos capturen las opciones arrastradas por el usua*/
    $(".zona-respuestas>h1").droppable({
        drop:function(ev,ui){
            tabla.capturado=true;
            var dropped = ui.draggable.clone();//clonamos el elemento arrastrado
            $(this).append(dropped);// y este elemento arrastrado se lo aplicamos al contenido
            if(tabla.lenghtRes()>1){
                $(this).droppable('option','disabled',true);
            }else{
                $(this).droppable('option','disabled',false);
            }
        }

    });


  $("#jugar").click(function(){
    $.each($(".niveles"),function(i,v){
      if($(this).hasClass("active")){
        tabla.nivel=i+1;
      }
    });
    if($("#actividad").is(":checked")){
      game.startGame(true);
    }else{
     game.startGame(false);
   }
  });
  $(".dificult-list>li").click(function(){
    $(".dificult-list>li").removeClass("active");
    $(".dificult-list>li").find("i").removeClass("fa-check-square-o fa-square-o");
    $(this).addClass("active");
    $(this).children().first().addClass("fa-check-square-o");
  });
  $(".niveles").click(function(){
    $(".niveles").removeClass("active");
    $(this).addClass("active");
  });

  //funcion que se utiliza para pantalas tactiles con el objetivo de prevenir el efecto de desplazamiento con el tacto a la hora de estar en la zona de juego
   $(".zona-numeros").on('touchmove', function(event) {
      event.preventDefault();
    });


});