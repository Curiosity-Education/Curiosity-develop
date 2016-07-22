$(document).on("ready",function() {


  $curiosity.menu.setPaginaId("#li-conteo-basico");
  $juego.setTitulo("Conteo - Basico");
  //$juego.setBackgroundColor("rgb(25, 132, 179)");
  $juego.setBackgroundImg("/packages/images/fondos/fondo.jpg");
  $juego.boton.comenzar.setFuncion(function(){
     $juego.game.start(60,true);
  });
  $juego.setSrcVideo({
    titulo:"| Conteo basico |",
    ruta:"/packages/video/games/instrucciones/ahorcado.mp4",
    explanation1:"1. Decide cuál es la respuesta correcta.",
    explanation2:"2. Presiona el numero correcto y coincide una buena puntuación."
  });
   $juego.slider.changeImages({
      img1:"conteo01.png",
      img2:"conteo02.png",
      img3:"conteo03.png"
   });
    //SE DECLARAN VARIABLES DE MANERA GLOBAL
    //en esta zona se declaron los arrglos usados en el juego
    var num_randoms=[];
    var array_imagenes=[];
    //Se almacenan imagenes en el array de imagenes
    array_imagenes=[];
    array_imagenes[0]="/packages/images/games/imagen1.png";
    array_imagenes[1]="/packages/images/games/imagen2.png";
    array_imagenes[2]="/packages/images/games/imagen3.png";
    array_imagenes[3]="/packages/images/games/imagen4.png";
    array_imagenes[4]="/packages/images/games/imagen5.png";
    array_imagenes[5]="/packages/images/games/imagen6.png";
    array_imagenes[6]="/packages/images/games/imagen7.png";
    array_imagenes[7]="/packages/images/games/imagen8.png";
    array_imagenes[8]="/packages/images/games/imagen9.png";
    array_imagenes[9]="/packages/images/games/imagen10.png";
    animaciones = ["pulso","latidos","rotacion"];
    
    //almacen de colores para arreglo coloresBarajas
    var coloresBarajas=[];
    
    
    BarajasIconos();
     /* para obtener barajas e iconos*/
    function BarajasIconos(){
    num_randoms=[];
     for(var j=0; j<=4; j++){
         num_randoms[j]= Math.floor((Math.random() * 9) + 1);
         m = Math.floor((Math.random() * 9) + 1);
         var repetida = 0;
         $("#cartas").children("h3").each(function(index,elemento){
             if($(this).text()==num_randoms[j]){
                repetida=1;
             }
         });
         if(repetida==0){
             var x=$("<h3/>");
             x.html(num_randoms[j]+"<br>");
             x.data("valor",num_randoms[j])     
             $("#cartas").append(x);
         }
         else{
             j--;
         }
         repetida=0;
      }
        

        
        c=Math.floor((Math.random()*4)+1);
        n_animacion = Math.floor((Math.random()*3));
        for(var i=0; i<num_randoms[c]; i++){
            var l =$("<img src='"+array_imagenes[m]+"' class='imgTamano "+animaciones[n_animacion]+"' style='width:75px!important;height:75px!important;'>");
            $(".iconos").append(l);
        }
        $.each($("#cartas>h3"),function(i,o){
          for(var i=0;i<$(this).text();i++){
            $(this).append("<i class='fa fa-star'/>")
          }  
        });
    }
    
    /*para obtener numero de iconos y valor de barajas*/
    
    
      $("#cartas").on("click","h3",function(){
           var valorBaraja=$(this).data("valor");
           var iconosNum=$(".iconos>img").length;
          if(valorBaraja==iconosNum){
              $(".iconos").empty();
              $("#cartas").empty();
              BarajasIconos();
              $juego.game.setCorrecto();
          }else{
              $juego.game.setError(50);
          }
     });

    
    


}) 