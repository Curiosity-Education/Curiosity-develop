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
  $juego.boton.video.setVideo('/packages/video/Restas.mp4');
  $juego.boton.comenzar.setFuncion(comenzarJuego);
  $("#zona-play").hide();
//------------------------------------------------------------------------------------------------
//--------------------------------Variable globales del sistema-----------------------------------
    var puntosMaximos=0; //variable para almacenar el puntuaje maximo obtenido por el usuario
    var puntajeNow =0; // variable para almacenar el puntuaje actual obtenido por el usuario
    var intervalJuego; // variable para almacenar el intervalo del tiempo para el juego
    var vidad=5;// variable para almacenar la cantidad de intentos que el usuario tiene en el juego, una vez terminados estos intentos el juego termina
    var respuesta;// variable para almacenar la respuesta o incognida oculta en las opciones del juego
    var tiempo=90;// variable de control para llevar el conteo de los segundos trascurridos en el juego
    var $opciones=$(".valor-resp");// arreglo que almacena las opciones del juego
    var $respuestas=$(".options");//arreglo que almacenará las posible respuestas de las opciones
    var maxPtsTemp;// variable auxiliar para almacenar el puntuaje
    var intervalImage; // intervalo de tiempo para cambiar la imagen de fondo de pantalla
    var index;// esta variable representa el indice da la opcion donde se encuentra la respuesta correcta
     // Variab le para almacenar la cantidad de aciertos
    var aciertos = 0;
    // Variable para guardar la cantidad de aciertos
    var continuo = 0;
    // Valor que tendran los puntos al iniciar
    var valorPts = 100;
    //variable gloabla para almacenar los colores de fondo para los contenedores de los numeros
    var colores = ["#00f41c","#f80000","#08e1f4","#9900ff","#fa8700","#eee304"];
    // PETICIONES A BASE DE DATOS
// ---------------------------------------------------------------------------------------------
      $.ajax({
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
      });
// ---------------------------------------------------------------------------------------------
// 				Ocultar zona de juego al principio
$(".zona-play").hide();
//		------------------------------------------------------------------------------------------
// function para cambiar el fondo de pantalla dinamicamente
    function changeBg()
    {
        var index = numeroAleatorio(2)+1;
        $(".zona-juego").css("background-image","url(/packages/images/games/operaciones-aritmeticas/"+index+".jpg)");
    }
//--------------Comenzar zona de juego y ocultar zona de objetivo--------------
    function comenzarJuego(){
         document.getElementById("sound-fondo").play();
         changeBg();
         $("#zona-play").show();
         $("#zona-obj").hide();
         $("#countPuntaje").text(puntajeNow);
         $("html,body").animate({scrollTop:200},'slow');
         intervalImage = setInterval(changeBg,8000);
         createOptions();//crear opciones de juego de inicio
         setSeries();// metodo para establecer valores a las opciones
         intervalJuego = setInterval(cambiarSeg,1000);
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
            console.log($($(".option")[number]).data("valor"));

        }
        else{
            var simboles = ["ope-suma","ope-menos","ope-multi","ope-divi"];
            var datos = ["+","-","*","/"];
            for(var i =0;i<=3;i++){

                $respuestas.children().last().append($("<img  class='img-responsive option' src='packages/images/games/operaciones-aritmeticas/"+simboles[i]+".png'/>"));
                $($(".option")[i]).data("valor",datos[i]);
            }
        }
    }
//------------------------------------function para ocultar opcionel juego------------------------------------------------------------
 function hideOption()
 {
    var opcion = numeroAleatorio(3);// generar numero aleatorio para ocultar una opción aleatoriamente
    if(opcion == $opciones.length-2)// si la opcion fue la 3 la omimtimos
    {   opcion++;}
    index = opcion;
    respuesta = $($opciones[opcion]).data("valor") //antes de ocultarlo obtenemos su texto
    $($opciones[opcion]).children().text("?");
    if(opcion==1)//si ola opcion a ocultar es un signo aritmetico
        setRespuestas(NaN,false);
     else setRespuestas(respuesta,true);
}
$respuestas.on("click",".option",function(){
    console.log($(this));
    if($(this).data("valor") == respuesta)
    {
        setCorrecto();
        $($opciones[index]).children().empty();
        $($opciones[index]).children().append($(this).text());


        setTimeout(function(){
            createOptions();
            setSeries();
        },1100);

    }
    else{
      setError();
    }
});

//------------------------------funcion para finalizar el juego----------------------------------//
 function finishGame()
 {
        document.getElementById("sound-fondo").pause();
        clearInterval(intervalImage);
        $(".zona-juego").css("background-image","url(packages/images/fondos/fondo.jpg)");
		clearInterval(intervalJuego);
		aciertos=0;
		tiempo=91;//reiniciar tiempo
		continuo=0;//reiniciar continuos
		$("#temp-count").text(tiempo + "seg");
	    // Guardamos el puntaje mayor actual en variable temporal para no perder la catidad de puntos maximos en caso de que este puntaje sea superado
        maxPtsTemp = puntajeNow;
		//reiniciar puntuaje

        // Verificamos si el puntaje obtenido es mayor que el puntaje mayor actual
        if(puntajeNow > puntosMaximos){
        // si el puntaje realizado es mayor que el [puntaje maximo], el puntaje maximo pasa a ser el puntaje realizado
        puntosMaximos = puntajeNow;
        // Cambiamos el puntaje maximo en pantalla
        $("#num-max-pts").html(puntosMaximos + " pts");
        }
	 	$("#zona-play").toggle();//desaparecer zona juego
		$("#zona-obj").toggle();//aparecer zona del objetivo
 }
//----------------------------------------------------------------------------------------------//
    //funcion para cambiar  de tiempo cada segundo para establecerlo en la variable global y en el dom---------------------------------------
    function cambiarSeg()
    {
        tiempo--;
        if(tiempo == 0)
        {
            finishGame();
            $juego.modal.puntuacion.mostrar(puntosMaximos, puntajeNow);
           puntajeNow=0;
        }else $("#temp-count").text(tiempo + "seg");
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
                //almacenar en una variable la expresion aritmetica a evaluar
                cadena = $($opciones[0]).data("valor")+$($opciones[1]).data("valor")+$($opciones[$opciones.length-$opciones.length+2]).data("valor");
                $(this).data("valor",eval(cadena));
                $(this).children().text($(this).data("valor"));
            }
            else if(i==1)
            {
                var expresion = getExpresion();
                $(this).data("valor",expresion[0]);
                $(this).children().html("<img  class='img-responsive img-operacion' src='packages/images/games/operaciones-aritmeticas/"+expresion[1]+".png'/>");
            }
            else{
                $(this).data("valor",numeroAleatorio(10)+1);//establecer el valor en los metadatos del elemento dom
                $(this).children().text($(this).data("valor"));//establecer el valor en el texto del elemento
            }
            if($($opciones[$opciones.length-3]).data("valor")>$($opciones[0]).data("valor"))// si el segundo numero fue mayor lo degradamos
            {
                $($opciones[$opciones.length-3]).data("valor",numeroAleatorio($($opciones[0]).data("valor")-1)+1);
                $($opciones[$opciones.length-3]).children().text($($opciones[$opciones.length-3]).data("valor"));
            }
            if($($opciones[1]).data("valor")=="/")// si es una divicion evitamos los numeros impares
            {
                if($($opciones[2]).data("valor")%2!==0 && $($opciones[2]).data("valor")!=$($opciones[0]).data("valor"))//si es impar le restamos uno para hacerlo impar
                    $($opciones[2]).data("valor",$($opciones[2]).data("valor")+1);
                $($opciones[2]).children().text($($opciones[2]).data("valor"));
                $($($opciones[2]).children().text($($opciones[0]).data("valor")))//intercambiamos los textos de los elementos cuando jueguen veran por que lo hice, mas que nada lo hago por que la divicion se interpreta mal a vista
                $($opciones[0]).children().text($($opciones[2]).data("valor"));
            }
            $(this).css("animation","");
		});
        hideOption();//ocultamos una opcion
	}
//--------------------------------------------------------------------------------------------------------------
//------------------------------------Funcion para crear conbo con efecto------------------------------------//
	function setCombo(combo)//parametro para establecer si el combo sera de 10 , 15 o 20
	{
		$cbo = $("<div/>",{class:"combo"}).text("+"+combo+"");
		$("#combo").append($cbo);
		$cbo.css({"animation":"2s combo 1 forwards",});
		setTimeout(function(){$("#combo").empty()},2000);//eliminar el elemento dom que genera el combo cuando este termine
	}
//-----------------------------------------------------------------------------------------------------------//

// -----------------------------------------------------
// FUNCION A REALIZAR EN CADA OPCION SELECCIONADA ERRONEAMENRE
// -----------------------------------------------------
  function setError(){
    // regresamos la cantidad de aciertos continuos a cero
    continuo = 0;
      tiempo -=3;
    // Regresamos el valor de los puntos por acirto a 100
    valorPts = 100;
    // añadimos la clase creada en css para poner una sombra roja fuera del contenedor del juego
    $(".zona-juego").addClass('error-shadow');
    // colocamos una equis en la esquina inferior derecha dentro del div con la clase verific indicando que el usuario se ha equivocado
    $(".verific").html("<i class='fa fa-close fa-4x'></i>").css('color', 'rgb(215, 36, 36)');
    // establecemos que despues de 600 milisegundos la clase de error se eliminara del contenedor del juego
    setTimeout(function(){
      // removemos la clase de error-shadow
      $(".zona-juego").removeClass('error-shadow');
      // eliminamos el contenido del div con la clase verific el cual contenia una equis
      $(".verific").empty();
      // Establecemos en cuantos milisegundos se realizará la funcion
    }, 600);
  }

// ---------------------------------------------------------------------------------------------
// FUNCION A REALIZAR EN CADA OPCION SELECCIONADA CORRECTAMENTE
// ---------------------------------------------------------------------------------------------
  function setCorrecto(){
    // sumamos el puntaje
    $("#countPuntaje").text(puntajeNow += valorPts);
    // Sumamos +1 a los aciertos continuos que llevamos
    continuo += 1;
    // colocamos una palomita en la esquina inferior derecha dentro del div con la clase verific indicando que el usuario ha seleccionado la opcion correcta
    $(".verific").html("<i class='fa fa-check fa-4x'></i>").css('color', 'rgb(255, 255, 255)');
    // establecemos que despues de 600 milisegundos la clase de error se eliminara del contenedor del juego
    setTimeout(function(){
      // eliminamos el contenido del div con la clase verific el cual contenia una palomita
    $(".verific").empty();
    // Establecemos en cuantos milisegundos se realizará la funcion
    }, 600);
  }
// ---------------------------------------------------------------------------------------------
// FUNCION QUE DETERMINA SI LA OPCION SELECCIONADA ES CONSECUTIVA O BIEN SE CORTA LA
// CONTINUIDAD... SI SE LLEGA A UNA CANTIDAD ESTABLECIDA DE OPCIONES CORRECTAS CONTINUAS
// SE APLICA UN VALOR AGREGADO AL VALOR DEL PUNTAJE POR RESPUESTA CORRECTA
// ---------------------------------------------------------------------------------------------
function determinarCombo(){
  // Verificamos que la cantidad de aciertos continuos sea diferente que cero
  // esto nos indica que efectivamente se tienen aciertos seguidos
  if(continuo !== 0){
    // si la cantidad de aciertos continuos es igual a 5 se asigna un nuevo valor a los puntos por acierto
    if(continuo == 5){
      valorPts = 150;
	  setCombo(150);
    }
    // si la cantidad de aciertos continuos es igual a 10 se asigna un nuevo valor a los puntos por acierto
    if(continuo == 10){
      valorPts = 250;
	  setCombo(250);
    }
    // si la cantidad de aciertos continuos es igual a 15 se asigna un nuevo valor a los puntos por acierto
    if(continuo == 15){
      valorPts = 500;
	  setCombo(500);
    }
	if(continuo == 20){
		valorPts =1000;
		setCombo(1000);
		continuo=0;//Reiniciar la variable continuos para poder generar más combos
	}
  }
}
});//find del evento ready
