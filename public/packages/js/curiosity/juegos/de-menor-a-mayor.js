$(document).on("ready",function() {

  var objetivo = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis fugiat soluta, saepe asperiores odio magni eos. Autem repudiandae earum consequatur dolorum molestias odio, laborum veniam voluptate nisi. Sint animi dolore, laborum nisi reiciendis nobis voluptas.";

  $curiosity.menu.setPaginaId("#li-menor-mayor");
  $juego.setTitulo("Menor - Mayor");
  $juego.setObjetivo(objetivo);
  $juego.setNivelUsuarioIMG("/packages/images/cups/medalla1.png");
  $juego.setBackgroundColor("rgb(25, 132, 179)");
  $juego.setBackgroundImg("/packages/images/fondos/fondo.jpg");
  $juego.boton.archivoPDF.setDireccion('packages/docs/pruebaPDF.pdf');
  $juego.boton.archivoPDF.setNombreDescarga('Guia Ordena Numeros');
  $juego.boton.comenzar.setFuncion(funcionComenzar);
  $juego.slider.changeImages({
      img1:"ordena01.png",
      img2:"ordena02.png",
      img3:"ordena03.png"
  });
  $juego.setSrcVideo({
    titulo:"| Menor a Mayor |",
    ruta:"/packages/video/games/instrucciones/menor-mayor.mp4",
    explanation1:"Toca las figuras en orden de Menor a Mayor.",
    explanation2:""
  });

// ---------------------------------------------------------------------------------------------
// DECLARAMOS LAS VARIABLES DE USO GLOBAL
// ---------------------------------------------------------------------------------------------
  // Guardamos el puntaje maximo del usuario en una variable para uso global
  //variable arreglo para almacenar las series
  var numeros = [];
  // Establece la cantidad de segundos de inicio
  // Declaramos la variable de forma globar a utilizar en el setInterval(intervalo de tiempo)
  // Declaramos la variable para uso de puntaje
  // Variable para almacenar la cantidad de aciertos
  // Variable para guardar la cantidad de aciertos
  // Valor que tendran los puntos al iniciar
  //variable gloabla para almacenar los colores de fondo para los contenedores de los numeros
  var colores = ["rgb(60,181,74)","rgb(237,34,36)","rgb(65,198,239)","rgb(138,71,156)","rgb(228,126,60)","rgb(242,221,72)","rgb(239,83,151)","rgb(54,142,184)","rgb(184,191,52)"];
  // variable glabal para que nos permitira determinar cuantos opciones se mostrarán en el area de juego
  var opciones = 3;// se mostraran 3 opciones al inicio
  //funcion para determinar el nivel del juego
  var nivel =0;
  var aciertos=0;
  //la variable de wily
// ---------------------------------------------------------------------------------------------
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
    $juego.setPuntosMaxInicio(puntosMaximos);
  })
  .fail(function(error) {
    console.log(error);
  });
// ---------------------------------------------------------------------------------------------
//	    -----------------Gestion del dom ---------------------------

// ----------------------------------------------------------------------------------------------
// 				Ocultar zona de juego al principio
$("#zona-play").hide();
//		------------------------------------------------------------------------------------------
//--------------Comenzar zona de juego y ocultar zona de objetivo--------------
 function funcionComenzar(){
     numeros=[];
	 createOptions(opciones);//crear opciones de juego de inicio
	 setSeries();
	 $juego.game.start()
	 $juego.cronometro.start(60,false);
	
 }
//funcion auxiliar para contruir las opciones
    function CicleOption(nivel,col)
	{
		$("#game").children().first().append($("<div/>",{class:"col-xs-"+col}));
		for(var i=0; i<nivel;i++)
		{
			$option = $("<div/>");
			$valorResp = $("<div/>",{class:"col-xs-2 valor-resp"});
			$valorResp.append($option);
			$("#game").children().first().append($valorResp);
		}
		$("#game").children().first().append($("<div>",{class:"col-xs-"+col}));
		if(opciones>5)// si hay mas de 5 opciones se creara un nuvo renglon para las nuevas opciones
		{
			$row = $("<div/>",{class:"row"});
			$("#game").prepend($row);//crear fila para las primeras opciones
		}
	}
//------------------------------------------------------------------------------------------------
// funcion para crear el numero de opciones segun sea el nivel------------------------------------//
	function createOptions(nivel)
	{
		$("#game").empty();//vaciaar el contenedor para generar las opciones nuevamente con el nuevo nivel establecido
		$row = $("<div/>",{class:"row"});
		$("#game").prepend($row);//crear fila para las primeras opciones
		//------------------------------establecer opciones segun el nivel alcanzado----------//
		if(nivel==3)
			CicleOption(nivel,3);

		else if(nivel==4)
			CicleOption(nivel,2);
		else if(nivel==5)
			CicleOption(nivel,1);
		else if(nivel==6)
		{
			CicleOption(nivel-3,3);
			CicleOption(nivel-3,3);
		}
		else if(nivel==7)
		{
			CicleOption(nivel-4,3);
			CicleOption(nivel-3,2);
		}
		else if(nivel==8)
		{
			CicleOption(nivel-4,2);
			CicleOption(nivel-4,2);
		}
		else if(nivel==9)
		{
			CicleOption(nivel-5,2);
			CicleOption(nivel-4,1);
		}
		else if(nivel==10)
		{
			CicleOption(nivel-5,1);
			CicleOption(nivel-5,1);
		}
		//----------------------------------fin de niveles---------------------------------------//

	}
//------------------------------------------------------------------------------------------------//
//------------------------------funcion para finalizar el juego----------------------------------//

//----------------------------------------------------------------------------------------------//
//funcion para cambiar  de tiempo cada segundo para establecerlo en la variable global y en el dom---------------------------------------

//------------------------------------------------------------------------------------------------
//--------------------------funcion para crear un numero aleatorio menor o igual al establecido de parametro----
function numeroAleatorio(num){
	var numero = Math.round((Math.random()*num));
	return numero;
}
//--------------------------------------------------------------------------------------------------------------
//--------------------------------función para establecer la serio de numeros aleatorios------------------------
	function setSeries(){
		$.each($(".valor-resp"),function(i,v){
            var numero=numeroAleatorio(98)+1;
			$(this).children().text(numero);//establecer el valor en el texto del elemento
			numeros[i]=parseInt(numero);
			$(this).css("animation","");
			$(this).css("animation","").css("amimation","");//eliminar el efecto de entrada de las opciones
			$(this).children().css("background",colores[numeroAleatorio(colores.length)]);//generar un color aleatoriamente
		});

	}
//--------------------------------------------------------------------------------------------------------------
//--------------------------funcion paraq verificar que el numero elegido por el usuario sea el más alto--------
	function isMax(num)
	{
		var pos=0;//variable auxiliar para determinar la posicion en la que se encuantra el numero mayor
		var menor =numeros[pos];//traerme el valor del primer elemento
		for(var i=0;i<numeros.length;i++){//verificar cual de los valores que esta en la serie es el mayor
			if(numeros[i] < menor){
				menor=numeros[i];
				pos=i;
			}
		}
		if(num == menor){// si el elemento es el mayor entonces retornamos afirmativo
			numeros.splice(pos,1);// eliminamos el numero menor encontrado en la serie
			return true;
		}
		else return false;
	}
//--------------------------------------------------------------------------------------------------------------
//--------------------------Evento click del un numero dentro del juego-----------------------------------------
	$("#game").on("click",".valor-resp",function(e){
		if(isMax(parseInt($(this).text()))){//en caso de que presiono el numero mayor
			$(this).css({"animation":"1s goodBy ease 1 forwards"});//desapareser con una pequña animacióm
			aciertos +=1;
			$juego.game.setCorrecto();
			$juego.game.determinarCombo();
		}else $juego.game.setError(20);

		if(aciertos==opciones)//si selecciona los   numeros correctamente se generan una nueva serie de numeros
		{
			nivel += 1;//variable de control al llegar a dos sube de nivel
			if(nivel==2)
			{
				opciones +=1;
				nivel=0;//reiniciar variable de control
				if(opciones==11)
				{
					$juego.game.finishGame();
				}
				else
					createOptions(opciones);//subir de nivel metodo para crear más opciones
			}
			setTimeout(function(){// los números se generan des pues de 7 milesimas de segundo
			setSeries();
			aciertos = 0;//los aciertos se reiniciar para comenzar con la nuva serie de numeros
			},700);
		}
	});

$("#game").on("finish",function(){
	alert('hey soy un eveto personalizado que fui lanzado al finalizar el juego...');
});
//------------------------------------Funcion para crear conbo con efecto------------------------------------//
	
//-----------------------------------------------------------------------------------------------------------//

// -----------------------------------------------------
// FUNCION A REALIZAR EN CADA OPCION SELECCIONADA ERRONEAMENRE


// ---------------------------------------------------------------------------------------------
// FUNCION A REALIZAR EN CADA OPCION SELECCIONADA CORRECTAMENTE
// ---------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------
// FUNCION QUE DETERMINA SI LA OPCION SELECCIONADA ES CONSECUTIVA O BIEN SE CORTA LA
// CONTINUIDAD... SI SE LLEGA A UNA CANTIDAD ESTABLECIDA DE OPCIONES CORRECTAS CONTINUAS
// SE APLICA UN VALOR AGREGADO AL VALOR DEL PUNTAJE POR RESPUESTA CORRECTA
// ---------------------------------------------------------------------------------------------------------------------Fin de gestion del dom--------------------------


});//find del evento ready
