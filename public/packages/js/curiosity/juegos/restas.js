$(document).ready(function() {


  $juego.setBackgroundColor("rgb(25, 132, 179)");
  $juego.setBackgroundImg("/packages/images/fondos/fondo.jpg");
  $juego.setNivelUsuarioIMG();
  $juego.boton.comenzar.setFuncion(funcionComenzar);

// ----------------------------------------------------------------------------
// DECLARAMOS LAS VARIABLES DE USO GLOBAL
// ---------------------------------------------------------------------------
  // Guardamos el puntaje maximo del usuario en una variable para uso global
  var puntosMaximos = $juego.getPuntuacion();
  // Establece la cantidad de segundos de inicio
  var cantTemp = 60;
  // Declaramos la variable de forma globar a utilizar en el setInterval(intervalo de tiempo)
  var $tiempo;
  // Declaramos la variable para uso de puntaje
  var puntajeNow = 0;
  // Declaramos variable para guardar el valor de la primera operacion
  var data1;
  // Declaramos variable para guardar el valor de la segunda operacion
  var data2;
  // Variable para guardar la cantidad de aciertos
  var continuo = 0;
  // Valor que tendran los puntos al iniciar
  var valorPts = 100;
  // Valor de la eficiencia maxima
  var eficienciaMax = 0;
  // Valor de la eficiencia obtenida en la partida jugada
  var eficienciaNow = 0;
  // Cantidad Total de click realizados
  var totClicks = 0;
  // Cantidad total de aciertos
  var totAciertos = 0;
  // Cantidad total de errores
  var totErrores = 0;

// ---------------------------------------------------------------------------
// PETICIONES A BASE DE DATOS
// ---------------------------------------------------------------------------
  // $.ajax({
  //   url: '/puntajeSubtema',
  //   type: 'POST',
  //   data: {id: '1'}
  // }).done(function(response) {
  //   puntosMaximos = response;
  //   // Se Coloca la cantidad máxima de puntaje que el usuario tiene en la pantalla principal
  //   $("#num-max-pts").html(puntosMaximos + " pts");
  //   $("#num-efic").html(eficiencia + " %");
  // }).fail(function(error) {
  //   console.log(error);
  // });

// ---------------------------------------------------------------------------
// MANIPULACION DE DOM
// ----------------------------------------------------------------------------
  // Ocultamos la 'zona de juego de inicio'
  $("#zona-play").attr('class', 'hidden');
  // Mostramos la 'zona objetivo del juego de inicio'
  $("#zona-obj").attr('class', 'show');

// ----------------------------------------------------------------------------
// FUNCION PARA COMENZAR LA ACTIVIDAD
// ----------------------------------------------------------------------------
  // Acciones a realizar al hacer click en el boton de comenzar la actividad
 function funcionComenzar(){
    // Establecemos la primera operacion de inicio
     data1 = calcOperacion_1();
     // Establecemos la segunda operacion de inicio
     data2 = calcOperacion_2();
     // Ocultamos la pantalla del objetivo
     $("#zona-obj").attr('class', 'hidden');
    // Mostramos la pantalla de juego
     $("#zona-play").attr('class', 'show');
    // Establecemos la cantidad inicial en el puntaje
    $("#countPuntaje").text(puntajeNow);
    // declaracion de variable la cual permitie realizar una funcion cada tiempo determinado establecido en milisegundos
    $tiempo = setInterval(restarTiempo, 1000);
  }
// ---------------------------------------------------------------------------
// GENERAMOS EL LOS NUMEROS DE FORMA ALEATORIA
// ---------------------------------------------------------------------------
// funcion para determinar un numero random no mayor a la cantidad establecida como parametro
  function $valorRandom(numMayor){
    var numero =  Math.round((Math.random() * numMayor));
    return numero;
  }

// ---------------------------------------------------------------------------
// MANIPULACION DEL TIMER EN EL DOM
// ---------------------------------------------------------------------------
// Cambia la cantidad de segundos en pantalla. funcion global
  function cambiarSeg(segs){
    $("#temp-count").html(segs + " seg");
  }

// ---------------------------------------------------------------------------
// ESTABLECEMOS EL TIMER AL INICIO DEL JUEGO
// ---------------------------------------------------------------------------
// Establecemos los segundos de inicio para la pantalla de juego al comenzar por primera vez
  cambiarSeg(cantTemp);

// ---------------------------------------------------------------------------
// FUNCION PARA CONTROLAR LAS OPERACIONES MATEMATICA DE LA OPCION UNO (IZQ)
// ---------------------------------------------------------------------------
function calcOperacion_1(){
  // Establecemos el primer numero de la operacion a realizar en la primera opcion
  var num1_1 = $valorRandom(9);
  // Establecemos el segundo numero de la operacion a realizar en la primera opcion
  var num2_1 = $valorRandom(9);
  // Declaramos la variable donde se guardará el resultado de la operacion a realizar en la primera opcion
  var result1;
    if(num2_1 > num1_1){
      var temp = num1_1;
      num1_1 = num2_1;
      num2_1 = temp;
    }
    // Realizamos la operacion resta para calcular el resultado de la operacion
    result1 = (num1_1 - num2_1);
    // Se coloca la operacion a realizar en la primera opcion
    $("#resp-1").text(num1_1 + " - " + num2_1);

  // Retornamos el valor del resultado de la operación
  return result1;
}

// ---------------------------------------------------------------------------
// FUNCION PARA CONTROLAR LAS OPERACIONES MATEMATICA DE LA OPCION DOS (DER)
// ---------------------------------------------------------------------------
function calcOperacion_2(){
  // Establecemos el primer numero de la operacion a realizar en la segunda opcion
  var num1_2 = $valorRandom(9);
  // Establecemos el segundo numero de la operacion a realizar en la segunda opcion
  var num2_2 = $valorRandom(9);
  // Declaramos la variable donde se guardará el resultado de la operacion a realizar en la segunda opcion
  var result2;
    if(num2_2 > num1_2){
      var temp = num1_2;
      num1_2 = num2_2;
      num2_2 = temp;
    }
    // Realizamos la operacion resta para calcular el resultado de la operacion
    result2 = (num1_2 - num2_2);
    // Se coloca la operacion a realizar en la segunda opcion
    $("#resp-2").text(num1_2 + " - " + num2_2);
  // Retornamos el valor del resultado de la operación
  return result2;
}

// ---------------------------------------------------------------------------
// FUNCION QUE RESTA EL TIEMPO EN EL DOM Y EN LA VARIABLE GLOBAL Y DETERMINA CUANDO SE TERMINO EL TIEMPO
// ---------------------------------------------------------------------------
  // declaramos funcion para restar el tiempo
  function restarTiempo(){
    // restamos uno al tiempo establecido
    cantTemp -= 1;
    // se cambia el tiempo en pantalla
    cambiarSeg(cantTemp);
    // comparacion para saber si el tiempo a llegado a cero
    if(cantTemp <= 0){
      // Calculamos la eficiencia
      eficienciaNow = Math.round((totAciertos * 100) / totClicks);
      // Reestablecemos el valor de aciertos continuos a cero
      continuo = 0;
      // Reestablecemos el valor de los puntos a 100
      valorPts = 100;
      // detenemos el intervalo de tiempo
      clearInterval($tiempo);
      // Verificamos si el puntaje obtenido es mayor que el puntaje mayor actual
      data = {"puntaje":puntajeNow,"eficiencia":eficienciaNow,"promedio":(eficienciaNow*puntajeNow)/100};
      console.log(data);
      $curiosity.call.setData.juego(data);
      $juego.setNivelUsuarioIMG();
      if(data.promedio > puntosMaximos){
        // si el puntaje realizado es mayor que el [puntaje maximo], el puntaje maximo pasa a ser el puntaje realizado
        puntosMaximos = data.promedio;
        $juego.setPuntosMaxInicio(data.promedio);
        // Cambiamos el puntaje maximo en pantalla
      }
      $juego.modal.puntuacion.mostrar(data.promedio);
      // // mostramos alerta en pantalla
      // ocultamos la pantalla de juego
      $("#zona-play").attr('class', 'hidden');
      // mostramos la pantalla del objetivo
      $("#zona-obj").attr('class', 'show');
      // Reestablecemos la cantidad inicial de segundos
      cantTemp = 60;
      // Reestablecemos la cantidad inicial de segundos en pantalla
      cambiarSeg(cantTemp);
      // Reestablecemos el puntaje inicial a cero
      puntajeNow = 0;
      eficienciaNow = 0;
      totAciertos = 0;
      totClicks = 0;
      totErrores = 0;
      // Reestablecemos el puntaje en pantalla
      $("#countPuntaje").text(puntajeNow);
    }
  }

// ---------------------------------------------------------------------------
// ACCIONES AL DAR CLIC EN BOTON DE OPCION UNO (IZQ)
// ---------------------------------------------------------------------------
  $("#resp-1").click(function() {
    // Comparamos el resultado de la primera opcion con el resultado de la segunda opcion
    if(data1 > data2){
      // Ejecutamos la funcion para mostrar efectos en pantalla
      setCorrecto();
    }
    else{
      // Funcion Para mostrar en pantalla que se ha seleccionado la opcion equivocada
      setError();
    }
    // Cambiamos los valores de la primera opcion
    data1 = calcOperacion_1();
    // Cambiamos los valores de la segunda opcion
    data2 = calcOperacion_2();
    // Determinar si se asignará un combo de puntaje al alumno
    determinarCombo();
    // sumamos el click realizado
    totClicks += 1;
  });

  // -------------------------------------------------------------------------
  // ACCIONES AL DAR CLIC EN BOTON DE OPCION DOS (DER)
  // -------------------------------------------------------------------------
  $("#resp-2").click(function() {
    // Comparamos el resultado de la segunda opcion con el resultado de la primera opcion
    if(data2 > data1){
      // Ejecutamos la funcion para mostrar efectos en pantalla
      setCorrecto();
    }
    else{
      // Funcion Para mostrar en pantalla que se ha seleccionado la opcion equivocada
      setError();
    }
    // Cambiamos los valores de la primera opcion
    data1 = calcOperacion_1();
    // Cambiamos los valores de la segunda opcion
    data2 = calcOperacion_2();
    // Determinar si se asignará un combo de puntaje al alumno
    determinarCombo();
    // sumamos el click realizado
    totClicks += 1;
  });

  // -------------------------------------------------------------------------
  // ACCIONES AL DAR CLIC EN BOTON DE OPCION DE IGUALES (CENT)
  // -------------------------------------------------------------------------
  $("#resp-igual").click(function() {
    // Comparamos el resultado de la primera opcion con el resultado de la segunda opcion para ver si son iguales
    if(data1 == data2){
      // Ejecutamos la funcion para mostrar efectos en pantalla
      setCorrecto();
    }
    else{
      // Funcion Para mostrar en pantalla que se ha seleccionado la opcion equivocada
      setError();
    }
    // Cambiamos los valores de la primera opcion
    data1 = calcOperacion_1();
    // Cambiamos los valores de la segunda opcion
    data2 = calcOperacion_2();
    // Determinar si se asignará un combo de puntaje al alumno
    determinarCombo();
    // sumamos el click realizado
    totClicks += 1;
  });

// -----------------------------------------------------
// FUNCION A REALIZAR EN CADA OPCION SELECCIONADA ERRONEAMENRE
// -----------------------------------------------------
  function setError(){
    cantTemp-=2;
    // regresamos la cantidad de aciertos continuos a cero
    continuo = 0;
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
      // Sumamos el error
      totErrores += 1;
      // Establecemos en cuantos milisegundos se realizará la funcion
    }, 600);
  }

// ---------------------------------------------------------------------------
// FUNCION A REALIZAR EN CADA OPCION SELECCIONADA CORRECTAMENTE
// ---------------------------------------------------------------------------
  function setCorrecto(){
    cantTemp+=4;
    setCombo(valorPts);
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
    // Sumamos el acierto
    totAciertos += 1;
    // Establecemos en cuantos milisegundos se realizará la funcion
    }, 600);
  }

  /* ---------------------------------------------------------------------------    FUNCION QUE DETERMINA SI LA OPCION SELECCIONADA ES CONSECUTIVA O BIEN SE CORTA LA CONTINUIDAD... SI SE LLEGA A UNA CANTIDAD ESTABLECIDA DE OPCIONES CORRECTAS CONTINUAS SE APLICA UN VALOR AGREGADO AL VALOR DEL PUNTAJE POR RESPUESTA CORRECTA
    ---------------------------------------------------------------------------*/
    function determinarCombo(){
      // Verificamos que la cantidad de aciertos continuos sea diferente que cero
      // esto nos indica que efectivamente se tienen aciertos seguidos
      if(continuo !== 0){
        // si la cantidad de aciertos continuos es igual a 5 se asigna un nuevo valor a los puntos por acierto
        if(continuo == 5){
          valorPts = 150;
        }
        // si la cantidad de aciertos continuos es igual a 10 se asigna un nuevo valor a los puntos por acierto
        if(continuo == 10){
          valorPts = 250;
        }
        // si la cantidad de aciertos continuos es igual a 15 se asigna un nuevo valor a los puntos por acierto
        if(continuo == 15){
          valorPts = 500;
        }
      }
    }

    function setCombo(puntos)
    {
      $cbo = $("<div/>",{class:"combo"}).text("+"+puntos+"");
      $("#combo").append($cbo);
      $cbo.css({"animation":"2s combo 1 forwards",});
      setTimeout(function(){$("#combo").empty();},2000);
      //eliminar el elemento dom que genera el combo cuando este termine
    }

});
//Fin del Document Ready
