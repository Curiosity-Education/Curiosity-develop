<?php

/**
 *
 */
class inteligenciaController extends BaseController
{
  function verPagina($nivel){
    if(Request::method()=="GET"){
      // buscamos si el id del nivel que paso como parametro
      // existe y si es asi si este se encuentra activo
      $activo = nivel::where('id', '=', $nivel)->pluck('active');
      if($activo === 1){
        // creamos un objeto de tipo array asociativo el
        // cual contiene una coleccion de datos de las inteligencias y
        // de los niveles que se encuentran activos, asi como el id
        // que se ha pasado como parametro el cual indica de cual nivel
        // pertenece toda la informacion que se va a mostrar al usuario
        $objetos = array('objetos' => inteligencia::where('active', '=', '1')
        ->where('nivel_id', '=', $nivel)
        ->select('id', 'nombre', 'descripcion', 'estatus', 'bg_color', 'nivel_id', 'imagen')
        ->get(),
        'objetos2' => nivel::where('id', '=', $nivel)
        ->select('nombre')
        ->get(),
        'perteneciente' => $nivel
        );
        // regresamos la vista junto con el arreglo recien creado
        return View::make('vista_inteligencias_admin', $objetos);
      }
      else{
        // si el id que paso como parametro no existe o bien
        // no se encuentra activo se regresa la vista de error 404
        // indicando la direccion ingresada no existe
        return View::make('view-error404');
      }
    }
    else{
      // si se accedio a la ruta por POST (registrar) se realiza lo siguiente:
      // obtenemos la informacion del formulario
      $formulario = Input::get('data');
      // creamos las reglas de validacion
      $reglas = array(
        'nombre' => 'required'
      );

      $messages = [
             "required"    =>  "Este campo :attribute es requerido",
             "alpha"       =>  "Solo puedes ingresar letras",
             "date"        =>  "Formato de fecha invalido",
             "numeric"     =>  "Solo se permiten digitos",
             "email"       =>  "Ingresa un formato de correo valido",
             "unique"      =>  "Este usuario ya existe",
             "integer"     =>  "Solo se permiten numeros enteros",
             "exists"      =>  "El campo :attribute no existe en el sistema",
             "unique"      =>  "El campo :attribute no esta disponible intente con otro valor",
             "integer"     =>  "Solo puedes ingresar numeros enteros",
             "same"        =>  "Las contraseñas no coinciden",
             "after"       =>  "La fecha de expiracion es incorrecta, no puedes ingresar fechas inferiores al día de hoy",
       ];
      // validamos el formulario segun las reglas establecidas
      $validar = Validator::make($formulario, $reglas, $messages);
      // verificamos que los datos del formulario cumplan las reglas
      // de validacion
      if($validar->fails()){
        // si no se han cumplido las reglas se envian
        // los errores a pantalla del usuario
        return $validar->messages();
      }
      else{
        // hacemos una consulta a la base de datos donde
        // traemos todos los nombres que existen segun el
        // id que se envio desde el formulario
        $nombre = inteligencia::where('nivel_id', '=', $formulario['nivel_id'])->select('nombre')->get();
        $existe = false;
        // se recorre el objeto de nombres
        foreach ($nombre as $name) {
          // si el nombre es igual al que contiene la informacion
          // del formulario se establece la variable bandera en true
          if($name->nombre === $formulario['nombre']){
            $existe = true;
          }
        }
        // si la variable bandera se encuentra en false
        // quiere decir que el nombre que contiene el formulario
        // no existe en la base de datos
        if($existe === false){
          // creamos un objeto y lo guardamos en la base de datos
          // al final enviamos una respuesta y el objeto creado
          $objeto = new inteligencia($formulario);
          $objeto->imagen = "default.png";
          $objeto->save();
          return Response::json(array(0=>"success", 1=>$objeto));
        }
        else{
          $estaActivo = inteligencia::where('nombre', '=', $formulario['nombre'])
          ->where('nivel_id', '=', $formulario['nivel_id'])
          ->pluck('active');
          if($estaActivo === 0){
            // Si el nombre ya existe en la base de datos
            // y se encuantra inactivo segun el id del nievl
            // lo volvemos a activar cambiando el active a 1
            // segun el nombre
            inteligencia::where('nombre', '=', $formulario['nombre'])
            ->where('nivel_id', '=', $formulario['nivel_id'])
            ->update(array(
              'active' => 1,
              'imagen' => 'default.png',
              'descripcion' => $formulario['descripcion'],
              'bg_color' => $formulario['bg_color']
              ));
            $inteligencia = inteligencia::where('nombre', '=', $formulario['nombre'])->first();
            return  Response::json(array(0=>"success", 1=>$inteligencia));
          }
          else{
            // si el nombre existe enviamos un mensaje
            // que indica que el nombre ya existe en la base de datos
            return Response::json(array(0=>"same"));
          }
        }
      }
    }
  }

  function update(){
    // obtenemos la informacion del formulario
    $formulario = Input::get('data');
    // creamos las reglas de validacion
    $reglas = array(
      'nombre' => 'required'
    );

    $messages = [
           "required"    =>  "Este campo :attribute es requerido",
           "alpha"       =>  "Solo puedes ingresar letras",
           "date"        =>  "Formato de fecha invalido",
           "numeric"     =>  "Solo se permiten digitos",
           "email"       =>  "Ingresa un formato de correo valido",
           "unique"      =>  "Este usuario ya existe",
           "integer"     =>  "Solo se permiten numeros enteros",
           "exists"      =>  "El campo :attribute no existe en el sistema",
           "unique"      =>  "El campo :attribute no esta disponible intente con otro valor",
           "integer"     =>  "Solo puedes ingresar numeros enteros",
           "same"        =>  "Las contraseñas no coinciden",
           "after"       =>  "La fecha de expiracion es incorrecta, no puedes ingresar fechas inferiores al día de hoy",
     ];
    // validamos el formulario segun las reglas
    $validar = Validator::make($formulario, $reglas, $messages);
    // verificamos si el formualrio ha sido validado
    if($validar->fails()){
      return $validar->messages();
    }
    else{
      // verificamos si el nombre proveniente del formulario
      // es el mismo del que existe en la base de datos
      // segun el mismo id proveniente del formulario
      $objetosDB = inteligencia::where('id', '=', $formulario['idUpdate'])->get();
      if($objetosDB[0]['nombre'] === $formulario['nombre']){
        // si el nombre existe en la BD no se actualiza el nombre
        // unicamente la descripcion y el estatus del mismo
        inteligencia::where('id', '=', $formulario['idUpdate'])->update(array(
          'descripcion' => $formulario['descripcion'],
          'estatus' => $formulario['estatus'],
          'bg_color' => $formulario['color']
        ));
        return Response::json(array(0=>"success"));
      }
      else{
        // si el nombre no es el mismo que el que proviene de la BD segun
        // el id enviado se busca ahora si el nombre del formulario
        // existe en la base de datos independientemente del id que se tenga
        // como referencia. es decir se busca en toda la DB
        $existe = 'no';
        $nombres = inteligencia::where('nivel_id', '=', $formulario['procedenciaID'])->select('nombre')->get();
        foreach ($nombres as $name) {
          if($name['nombre'] === $formulario['nombre']){
            $existe = 'si';
          }
        }
        // return $existe;
        if($existe === 'no'){
          inteligencia::where('id', '=', $formulario['idUpdate'])->update(array(
            'nombre' => $formulario['nombre'],
            'descripcion' => $formulario['descripcion'],
            'estatus' => $formulario['estatus'],
            'bg_color' => $formulario['color']
          ));
          return Response::json(array(0=>"success"));
        }
        else{
          // si el nombre existe
          return Response::json(array(0=>"same"));
        }
      }
    }
  }

  function remove(){
    $id = Input::get('data.id');
    inteligencia::where('id', '=', $id)->update(array(
      'active' => 0
    ));    
    return Response::json(array(0=>'success'));
  }

  function verPaginaInWeb($idNivel){
    // consultamos en la base de datos todos los tipos
    // de inteligencia que se encuentren
    // activos obteniendo la informacion necesaria dependiendo del nivel
    $objetos = array('objetos' => inteligencia::join('niveles', 'niveles.id', '=', 'inteligencias.nivel_id')
      ->where('niveles.active', '=', '1')
      ->where('inteligencias.active', '=', '1')
      ->where('nivel_id', '=', $idNivel)
      ->select('inteligencias.id', 'inteligencias.nombre', 'inteligencias.descripcion', 'inteligencias.estatus', 'inteligencias.bg_color', 'inteligencias.imagen')
      ->get(),
      'objetos2' => nivel::where('id', '=', $idNivel)
      ->select('nombre')
      ->get(),
      'perteneciente' => $idNivel
    );

    $objectBelive = nivel::where('id', '=', $idNivel)->pluck('estatus');

    $existe = inteligencia::join('niveles', 'niveles.id', '=', 'inteligencias.nivel_id')
    ->where('niveles.id', '=', $idNivel)->select('inteligencias.id')->first();

    if($objectBelive === "unlock"){
      if($existe != null){
        return View::make('vista_inteligencias', $objetos);
      }
      else{
        return View::make('view-error404');
      }
    }
    else{
      return View::make('view-error404');
    }
  }

  function changeImage($id){
    $image = Input::file('up-image');
    if($image != null){
      $destinoPath = public_path()."/packages/images/inteligencias/";
      $file = $image;
      $file->move($destinoPath, $file->getClientOriginalName());
      inteligencia::where('id', '=', $id)->update(array(
        'imagen' => $file->getClientOriginalName()
      ));
      return Response::json(array(0=>'success', 1=>$file->getClientOriginalName()));
    }
  }

}


 ?>
