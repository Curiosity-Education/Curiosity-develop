$(document).ready(function() {

  var objetivo = "Sin definir";

  $curiosity.menu.setPaginaId("#li-restas");
  $juego.setTitulo("La resta de mayor valor");
  $juego.setObjetivo(objetivo);
  $juego.setBackgroundColor("rgb(25, 132, 179)");
  $juego.setBackgroundImg("/packages/images/fondos/fondo.jpg");
  $juego.setNivelUsuarioIMG("/packages/images/cups/medalla1.png");
  $juego.boton.archivoPDF.setDireccion('/packages/docs/pruebaPDF.pdf');
  $juego.boton.archivoPDF.setNombreDescarga('Guia Sumas Restas');
  $juego.boton.video.setVideo('/packages/video/Restas.mp4');
  $juego.boton.comenzar.setFuncion(funcionComenzar);
  $juego.slider.changeImages({
      img1:"resta01.png",
      img2:"resta02.png",
      img3:"resta03.png"
  });
  $juego.setSrcVideo({
    titulo:"| Restas |",
    ruta:"/packages/video/games/instrucciones/restas.mp4",
    explanation1:"1. Decide qué circulo tiene el resultado más alto y tócala.",
    explanation2:"2. Si los resultados son iguales, toca el botón iguales."
   });

  // Declaramos variable para guardar el valor de la primera operacion
  var data1;
  // Declaramos variable para guardar el valor de la segunda operacion
  var data2;


// FUNCION PARA COMENZAR LA ACTIVIDAD
// ----------------------------------------------------------------------------
  // Acciones a realizar al hacer click en el boton de comenzar la actividad
 function funcionComenzar(){
    // Establecemos la primera operacion de inicio
     data1 = calcOperacion_1();
     // Establecemos la segunda operacion de inicio
     data2 = calcOperacion_2();
     $juego.game.start();
     $juego.cronometro.start(60,false);
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
// ACCIONES AL DAR CLIC EN BOTON DE OPCION UNO (IZQ)
// ---------------------------------------------------------------------------
  $("#resp-1").click(function() {
    // Comparamos el resultado de la primera opcion con el resultado de la segunda opcion
    if(data1 > data2){
      // Ejecutamos la funcion para mostrar efectos en pantalla
      $juego.game.setCorrecto();
    }
    else{
      // Funcion Para mostrar en pantalla que se ha seleccionado la opcion equivocada
      $juego.game.setError(30);
    }
    // Cambiamos los valores de la primera opcion
    data1 = calcOperacion_1();
    // Cambiamos los valores de la segunda opcion
    data2 = calcOperacion_2();
    // Determinar si se asignará un combo de puntaje al alumno
  });

  // -------------------------------------------------------------------------
  // ACCIONES AL DAR CLIC EN BOTON DE OPCION DOS (DER)
  // -------------------------------------------------------------------------
  $("#resp-2").click(function() {
    // Comparamos el resultado de la segunda opcion con el resultado de la primera opcion
    if(data2 > data1){
      // Ejecutamos la funcion para mostrar efectos en pantalla
     $juego.game.setCorrecto();
    }
    else{
      // Funcion Para mostrar en pantalla que se ha seleccionado la opcion equivocada
      $juego.game.setError(30);
    }
    // Cambiamos los valores de la primera opcion
    data1 = calcOperacion_1();
    // Cambiamos los valores de la segunda opcion
    data2 = calcOperacion_2();
  });

  // -------------------------------------------------------------------------
  // ACCIONES AL DAR CLIC EN BOTON DE OPCION DE IGUALES (CENT)
  // -------------------------------------------------------------------------
  $("#resp-igual").click(function() {
    // Comparamos el resultado de la primera opcion con el resultado de la segunda opcion para ver si son iguales
    if(data1 == data2){
      // Ejecutamos la funcion para mostrar efectos en pantalla
      $juego.game.setCorrecto();
    }
    else{
      // Funcion Para mostrar en pantalla que se ha seleccionado la opcion equivocada
      $juego.game.setError(30);
    }
    // Cambiamos los valores de la primera opcion
    data1 = calcOperacion_1();
    // Cambiamos los valores de la segunda opcion
    data2 = calcOperacion_2();
  });

});
//Fin del Document Ready
