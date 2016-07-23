$(document).ready(function() {

// ---------------------------------------------------------------------------------------------
// DECLARAMOS LAS VARIABLES DE USO GLOBAL
// ---------------------------------------------------------------------------------------------
  // Declaramos variable para guardar el valor de la primera operacion
  var data1;
  // Declaramos variable para guardar el valor de la segunda operacion
  var data2;
  // Declaramos variable para el control de nivel
  var nivel = 1;
  // Declaramos nivel prueba para saber si avanza en nivel
  var nivel_prueba = 1;
  // Sabremos cuantos numeros hemos creado
  var numCreados=0;
  // Medimos la categoria en la que se encuentra el alumno
  var categoria=9;
  // variable auxiliar para llebar acavo el conteo de los milisegundos del juego

  var objetivo = "Lorem ipsum dolor sit amet, consectetur adipisicing e";

  // $curiosity.menu.setPaginaId("#li-multipliaciones-challanger");
 $curiosity.menu.setPaginaId("#li-multiplicaciones");
  $juego.setTitulo("La Multiplicación Mayor");
  $juego.setObjetivo(objetivo);
  $juego.setBackgroundColor("rgb(25, 132, 179)");
  $juego.setBackgroundImg("/packages/images/fondos/fondo.jpg");
  $juego.setNivelUsuarioIMG("/packages/images/cups/medalla1.png");
  $juego.boton.archivoPDF.setDireccion('/packages/docs/pruebaPDF.pdf');
  $juego.boton.archivoPDF.setNombreDescarga('Guia Sumas Restas');
  // $juego.boton.video.setVideo('/packages/video/Restas.mp4');
  $juego.boton.comenzar.setFuncion(funcionComenzar);
  $juego.slider.changeImages({
      img1:"multiplicacion01.png",
      img2:"multiplicacion02.png",
      img3:"multiplicacion03.png"
  });
  $juego.setSrcVideo({
    titulo:"| Multiplicación |",
    ruta:"/packages/video/games/instrucciones/multiplicacion.mp4",
    explanation1:"1. Decide qué circulo tiene el resultado más alto y tócala.",
    explanation2:"2. Si los resultados son iguales, toca el botón iguales."
  });

// ---------------------------------------------------------------------------------------------
// PETICIONES A BASE DE DATOS
// ---------------------------------------------------------------------------------------------
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

// ---------------------------------------------------------------------------------------------
// FUNCION PARA COMENZAR LA ACTIVIDAD
// ---------------------------------------------------------------------------------------------
  // Acciones a realizar al hacer click en el boton de comenzar la actividad
  function funcionComenzar() {
    // Establecemos la primera operacion de inicio
     data1 = calcOperacion(nivel,"resp-1",true);
     // Establecemos la segunda operacion de inicio
     data2 = calcOperacion(nivel,"resp-2",false);
     // Ocultamos la pantalla del objetivo
     $juego.game.start();
     $juego.cronometro.start(60,false);
     nivel = 1;
  };
// ---------------------------------------------------------------------------------------------
// GENERAMOS EL LOS NUMEROS DE FORMA ALEATORIA
// ---------------------------------------------------------------------------------------------
   // Valor random es una funcion que nos ayudara en  un numero generado a traves de ciertas reglas
  function $valorRandom(numMayor,recursivo){

    var numero;
        /*------------------------------------------------------------------
        Empezamos a aumentar cada vez que creamos un numero en el tablero excepto
        si la llamada fue recursiva
        -------------------------------------------------------------------*/
        if(!recursivo)
            numCreados++;

        /*------------------------------------------------------------------
        Esta variable me ayudara a saber donde ira el numero perteneciente
        al nivel que es de manera obligatoria
        -------------------------------------------------------------------*/
        var multiplicadoRandom = $valorRandomSimple(2);

        /*------------------------------------------------------------------
        Este switch decide si el numero perteneciente al nivel aparece en
        el 1er o 3er numero generado ya que estos son los multiplicados
        -------------------------------------------------------------------*/
        switch(multiplicadoRandom){
            case 1:
                    if(numCreados == 1)
                        return (numMayor+1);
                break;
            case 2:
                    if(numCreados == 3)
                        return (numMayor+1);
                break;
        }


        //  --Si el numero creado ya es el 4to entonces regresamos al 0 ya que se regenera el tablero
        if(numCreados == 4)
            numCreados = 0;
        // --- Si el numero generado es el multiplicado entonces su random se genera a trvés de nivel + 1 y omitimos 1 y undefined
        if(numCreados == 1 || numCreados == 3){
            numero =  $valorRandomSimple(numMayor+1);

            /*------------------------------------------------------------------
            Si el numero es undefined, cero ó uno entonces mandamos a llamar la
            funcion si no entonces establecemos el numero
            -------------------------------------------------------------------*/
            numero = (numero == undefined) ? $valorRandom(numero,true) : numero;
            numero = (numero == 0) ? $valorRandom(numero,true) : numero;
            numero = (numero == 1) ? $valorRandom(numero,true) : numero;

            // --- Retornamos al final el numero
            return numero;
        }
        else{
            // -- Si no es el multiplicado entonces creamos un randomSimple y el multiplicado lo regresamos a true ya que es el sig.
            var rand = $valorRandomSimple(numMayor);
            /*------------------------------------------------------------------
            Si el numero es 0 volvemos a llamar a $valorRandomSimple
            -------------------------------------------------------------------*/
            numero = (rand == 0) ? $valorRandomSimple(numMayor): rand;

            // --- Retornamos al final el numero
            return numero;
        }
  }

  // funcion para determinar un numero random no mayor a la cantidad establecida como parametro
  function $valorRandomSimple(numMayor){
      var numero =  Math.round((Math.random() * numMayor));
      return numero;
  }
// ---------------------------------------------------------------------------------------------
// MANIPULACION DEL TIMER EN EL DOM
// ---------------------------------------------------------------------------------------------

// ---------------------------------------------------------------------------------------------
// FUNCION PARA CONTROLAR LAS OPERACIONES MATEMATICA DE LA OPCION UNO (IZQ)
// ---------------------------------------------------------------------------------------------
function calcOperacion(nivel,contenedor,isFirst){
  categoria = (nivel_prueba == (categoria*3)) ? nivel_prueba-(nivel_prueba/3) : categoria;
  nivel = (nivel > categoria) ? categoria : nivel;
  // Establecemos el primer numero de la operacion a realizar en la primera opcion
  var num1_1 = $valorRandom(nivel);
  // Establecemos el segundo numero de la operacion a realizar en la primera opcion
  var num2_1 = $valorRandom(9);
  // Declaramos la variable donde se guardará el resultado de la operacion a realizar en la primera opcion
  var result1;
  // si no es la primera vez  que se genera la operación entonces comparamos la seguna operación que no se repita
  if(!isFirst){
    if(num1_1===parseInt($("#resp-1").text().charAt(0))){
        if(num1_1==10){
          num1_1--;
      }else num1_1++;
    }
  }
    // Realizamos la operacion de multiplicación para calcular el resultado de la operacion
    result1 = (num1_1 * num2_1);
    // Se coloca la operacion a realizar en la primera opcion
    $("#"+contenedor).text(num1_1 + " x " + num2_1).css('font-size','55px');


  // Retornamos el valor del resultado de la operación
  return result1;
}

// ---------------------------------------------------------------------------------------------
// ACCIONES AL DAR CLIC EN BOTON DE OPCION UNO (IZQ)
// ---------------------------------------------------------------------------------------------
  $("#resp-1").click(function() {
    // Comparamos el resultado de la primera opcion con el resultado de la segunda opcion
    if(data1 > data2){
      // Ejecutamos la funcion para mostrar efectos en pantalla
      $juego.game.setCorrecto();
        nivel++;
        nivel_prueba++;
    }
    else{
      // Funcion Para mostrar en pantalla que se ha seleccionado la opcion equivocada
      $juego.game.setError(30);
    }
    // Cambiamos los valores de la primera opcion
    data1 = calcOperacion(nivel,"resp-1",true);
    // Cambiamos los valores de la segunda opcion
    data2 = calcOperacion(nivel,"resp-2",false);
    // Determinar si se asignará un combo de puntaje al alumno
    $juego.game.determinarCombo();
  });

  // ---------------------------------------------------------------------------------------------
  // ACCIONES AL DAR CLIC EN BOTON DE OPCION DOS (DER)
  // ---------------------------------------------------------------------------------------------
  $("#resp-2").click(function() {
    // Comparamos el resultado de la segunda opcion con el resultado de la primera opcion
    if(data2 > data1){
      // Ejecutamos la funcion para mostrar efectos en pantalla
      $juego.game.setCorrecto();
      nivel++;
      nivel_prueba++;
    }
    else{
      // Funcion Para mostrar en pantalla que se ha seleccionado la opcion equivocada
      $juego.game.setError(30);
    }
    // Cambiamos los valores de la primera opcion
    data1 = calcOperacion(nivel,"resp-1");
    // Cambiamos los valores de la segunda opcion
    data2 = calcOperacion(nivel,"resp-2");
    // Determinar si se asignará un combo de puntaje al alumno
    $juego.game.determinarCombo();
  });

  // ---------------------------------------------------------------------------------------------
  // ACCIONES AL DAR CLIC EN BOTON DE OPCION DE IGUALES (CENT)
  // ---------------------------------------------------------------------------------------------
  $("#resp-igual").click(function() {
    // Comparamos el resultado de la primera opcion con el resultado de la segunda opcion para ver si son iguales
    if(data1 == data2){
      // Ejecutamos la funcion para mostrar efectos en pantalla
      $juego.game.setCorrecto();
      nivel++;
      nivel_prueba++;
    }
    else{
      // Funcion Para mostrar en pantalla que se ha seleccionado la opcion equivocada
      $juego.game.setError(30);
    }
    // Cambiamos los valores de la primera opcion
    data1 = calcOperacion(nivel,"resp-1");
    // Cambiamos los valores de la segunda opcion
    data2 = calcOperacion(nivel,"resp-2");
    // Determinar si se asignará un combo de puntaje al alumno
    $juego.game.determinarCombo();
  });

});
//Fin del Document Ready
