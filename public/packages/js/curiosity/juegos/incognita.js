$(document).on("ready",function() {


  var objetivo = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor reiciendis eius inventore placeat facere minima fuga aliquam, cumque numquam aspernatur vel voluptatibus harum natus quo odio est rem repellat rerum nobis libero dolorem totam neque hic quisquam accusamus. Facilis unde libero omnis eligendi tempore repudiandae voluptate eaque ullam explicabo ducimus.";
  $curiosity.menu.setPaginaId("#li-operaciones");
  $juego.setTitulo("incógnita");
  $juego.setObjetivo(objetivo);
  $juego.setBackgroundColor("rgb(25, 132, 179)");
  $juego.setBackgroundImg("/packages/images/fondos/fondo.jpg");
  $juego.setNivelUsuarioIMG("/packages/images/cups/medalla1.png");
  $juego.boton.archivoPDF.setDireccion('/packages/docs/pruebaPDF.pdf');
  $juego.boton.archivoPDF.setNombreDescarga('Guia Sumas Restas');
  $juego.boton.comenzar.setFuncion(comenzarJuego);
  $juego.slider.changeImages({
      img1:"incognita02.png",
      img2:"incognita01.png",
      img3:"incognita03.png"
  });
  $("#zona-play").hide();
  $juego.setSrcVideo({
    titulo:"| Incógnita |",
    ruta:"/packages/video/games/instrucciones/incognita.mp4",
    explanation1:"1. Decide qué signo es el correcto y tócalo.",
    explanation2:"2. En caso de que el resultado sea un numero elige el correcto."
   });

//------------------------------------------------------------------------------------------------
//--------------------------------Variable globales del sistema-----------------------------------
    var vidad=5;// variable para almacenar la cantidad de intentos que el usuario tiene en el juego, una vez terminados estos intentos el juego termina
    var respuesta;// variable para almacenar la respuesta o incognida oculta en las opciones del juego
    var $opciones=$(".valor-resp");// arreglo que almacena las opciones del juego
    var $respuestas=$(".options");//arreglo que almacenará las posible respuestas de las opciones
    var intervalImage; // intervalo de tiempo para cambiar la imagen de fondo de pantalla
    var index;// esta variable representa el indice da la opcion donde se encuentra la respuesta correcta
    // variable auxiliar para hacer bandera dentro del proceso de cuando es divición
    var aumentar = true;
    //variable gloabla para almacenar los colores de fondo para los contenedores de los numeros
    var colores = ["#00f41c","#f80000","#08e1f4","#9900ff","#fa8700","#eee304"];
    //Variable auxiliar para llevar acabo el conteo de las milesimas al transcurrir el juego
    // PETICIONES A BASE DE DATOS
// ---------------------------------------------------------------------------------------------
  /*    $.ajax({
        url: '/puntajeSubtema',
        type: 'POST',
        data: {id: '1'}
      })
      .done(function(response) {
        puntosMaximos = response;
        // Se Coloca la cantidad máxima de puntaje que el usuario tiene en la pantalla principal
        $("#num-max-pts").html(puntosMaximos + " pts");
      })
      .fail(function(error) {
        console.log(error);
      });*/
//		------------------------------------------------------------------------------------------
// function para cambiar el fondo de pantalla dinamicamente
    function changeBg()
    {
        var index = numeroAleatorio(1)+1;
        $(".zona-juego").css("background-image","url(/packages/images/games/"+index+".jpg)");
    }
//--------------Comenzar zona de juego y ocultar zona de objetivo--------------
    function comenzarJuego(){
         document.getElementById("sound-fondo").play();
         changeBg();
         $("html,body").animate({scrollTop:200},'slow');
         intervalImage = setInterval(changeBg,8000);
         createOptions();//crear opciones de juego de inicio
         setSeries();// metodo para establecer valores a las opciones
         $juego.game.start();
         $juego.cronometro.start(120,false);
         $opciones.children().css("animation","");

     }
     //dunction para llenar areglo aleatoriamente sin valores repetidos
     function setArreglo(arreglo,limite){
        for(var i= 0; i<arreglo.length;i++){
            numero = numeroAleatorio(limite);
            arreglo[i]= numero;
            for(var p=0;p<i;p++){
                if(arreglo[i]==arreglo[p]){
                    i--;
                }
            }
        }
        return arreglo;
     }
//-------------------------------------- 	gesTion del documento--------------------------------------------
    function createOptions()
	{
		$(".operaciones").empty();
		for(var i=0; i<5;i++)// el limite de 5 es para solo crear 5 opciones en tiempo de ejecución
		{
            $option = $("<div/>");
            $valorResp = $("<div/>",{class:"col-xs-2 valor-resp"});
            $valorResp.append($option);
            $("#game").children().first().append($valorResp);

		}
		$("#game").children().first().append($("<div>",{class:"col-xs-2"}));
        $opciones =$(".valor-resp");

	}
//--------------------------------------------------------------------------------------------------------------------------
//------------------------------funcion para establecer opciones de respuesta en la pantalla--------------------------------
    function setRespuestas(valor,isNumber)
    {
        $respuestas.children().last().empty();
        if(isNumber)
        {
            var arreglo=[];
            var number = numeroAleatorio(3);// variable que nos permitira almacenar la respuesta en una posición aleatoria
            for(var i=0;i<=3;i++){
                numero  =numeroAleatorio(valor+5);
                arreglo[i]=numero;
                $respuestas.children().last().append($("<h2/>",{class:'option'}));
            }
            arreglo = setArreglo(arreglo,valor+5);
            $.each($(".option"),function(i,o){
                $(this).text(arreglo[i]);
                $(this).data("valor",arreglo[i]);
            });
            $($(".option")[number]).text(valor);
            $($(".option")[number]).data("valor",valor);

        }
        else{
            var simboles = ["ope-suma","ope-menos","ope-multi","ope-divi"];
            var datos = ["+","-","*","/"];
            for(var i =0;i<=3;i++){

                $respuestas.children().last().append($("<img  class='img-responsive option' src='/packages/images/games/"+simboles[i]+".png'/>"));
                $($(".option")[i]).data("valor",datos[i]);
            }
        }
    }
//------------------------------------function para ocultar opcionel juego------------------------------------------------------------
 function hideOption()
 {
    var opcion = numeroAleatorio(3);// generar numero aleatorio para ocultar una opción aleatoriamente
    if(opcion == $opciones.length-2 || opcion == 1)// si la opcion fue la 3 la omimtimos
    {   opcion++;}
    index = opcion;
    respuesta = $($opciones[opcion]).data("valor") //antes de ocultarlo obtenemos su texto
    $($opciones[opcion]).children().text("?");
    if(opcion==1)//si ola opcion a ocultar es un signo aritmetico
        setRespuestas(NaN,false);
     else setRespuestas(respuesta,true);
}
$respuestas.on("click",".option",function(){
    if($(this).data("valor") == respuesta)
    {
        $juego.game.setCorrecto();
        $($opciones[index]).children().empty();
        $($opciones[index]).children().append($(this).text());


        setTimeout(function(){
            createOptions();
            setSeries();
        },1100);

    }
    else{
      $juego.game.setError(40);
    }
    $juego.game.determinarCombo();
});
//------------------------------funcion para finalizar el juego----------------------------------//
 function finishGame(){
    document.getElementById("sound-fondo").pause();
    clearInterval(intervalImage);
    $(".zona-juego").css("background-image","url(/packages/images/fondos/fondo.jpg)");
    
 }
    //funcion para generar una exprecion aritmetica aleatoriamente
    function getExpresion()
    {
        num = numeroAleatorio(3)+1;// generar un numer aleatorio del 1 al 4
        switch(num)
        {
            case 1: return ["+","ope-suma"]; break;
            case 2: return ["-","ope-menos"]; break;
            case 3: return ["*","ope-multi"]; break;
            case 4: return ["/","ope-divi"]; break;
        }
    }
    //------------------------------------------------------------------------------------------------
    //--------------------------funcion para crear un numero aleatorio menor o igual al establecido de parametro----
    function numeroAleatorio(num)
    {
        var numero = Math.round((Math.random()*num));
        return numero;
    }
//--------------------------------------------------------------------------------------------------------------
//--------------------------------función para establecer la serie de numeros aleatorios------------------------
	function setSeries()
	{
		$.each($opciones,function(i,o){
            if(i==$opciones.length-2)
            {
                $(this).data("valor","=");
                $(this).children().text($(this).data("valor"));
            }
            else if(i==$opciones.length-1)
            {
                if($($opciones[1]).data("valor")=="/")// si es una divicion evitamos los numeros impares
                {
                    if($($opciones[$opciones.length-3]).data("valor")>$($opciones[0]).data("valor"))// si el segundo numero fue mayor lo degradamos
                    {
                        
                        var mayor = $($opciones[2]).data("valor");// guardamos el numero mayor en una variable auxiliar para no perder este dato.
                        $($opciones[2]).data("valor",$($opciones[0]).data("valor"));
                        $($opciones[0]).data("valor",mayor);
                        $($opciones[$opciones.length-3]).children().text($($opciones[$opciones.length-3]).data("valor"));
                        $($opciones[0]).children().text($($opciones[0]).data("valor"));
                    }
                    var n1 = $($opciones[0]).data("valor");
                    var n2  =$($opciones[2]).data("valor");

                    var hasResiduo = true;
                    do{// hacer ciclo hasta obtener un numero que no genere una operación con residuo
                        if(n1%n2==0){
                            hasResiduo = false;
                        }else{
                            if(aumentar){
                                n2++;
                            }else{
                                n2--;
                            }
                        }
                        if(!hasResiduo){
                            aumentar = (aumentar == true) ? false : true;
                        }
                    }while(hasResiduo);
                    $($opciones[2]).data("valor",n2);
                    $($opciones[2]).children().text(n2);
                    }

                    //almacenar en una variable la expresion aritmetica a evaluar
                    cadena = $($opciones[0]).data("valor")+$($opciones[1]).data("valor")+$($opciones[$opciones.length-$opciones.length+2]).data("valor");
                    $(this).data("valor",eval(cadena));
                    $(this).children().text($(this).data("valor"));
                
            }
            else if(i==1)
            {
                var expresion = getExpresion();
                $(this).data("valor",expresion[0]);
                $(this).children().html("<img  class='img-responsive img-operacion' src='/packages/images/games/"+expresion[1]+".png'/>");
           
            }
            else{
                $(this).data("valor",numeroAleatorio(10)+1);//establecer el valor en los metadatos del elemento dom
                $(this).children().text($(this).data("valor"));//establecer el valor en el texto del elemento
            }
            $(this).css("animation","");
		});
        hideOption();//ocultamos una opcion
    }
    $("#game").on("finish",function(){
        finishGame();
    });
    $("#game").on("exit",function(){
        finishGame();
    });
});//find del evento ready
