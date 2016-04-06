<?php

/**
 *
 */
class nivelController extends BaseController
{
  function verPagina(){
    if(Request::method()=="GET"){
      // consultamos en la base de datos todos los niveles que se encuentren
      // activos obteniendo la informacion necesaria
      $niveles = array('niveles' => nivel::where('active', '=', '1')
        ->select('id', 'nombre', 'descripcion', 'estatus', 'bg_color', 'imagen')
        ->get());
        // return $niveles;
      // regresamos la vista junto con la coleccion de niveles
      return View::make('vista_niveles_admin', $niveles);
    }
    else{
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
      // Validamos el formulario en base a lasreglas creadas
      $validar = Validator::make($formulario, $reglas, $messages);
      if($validar->fails()){
        // si la validacion falla regresamos la coleccion de errores
        return $validar->messages();
      }
      else{
        // consultamos en la base de datos si el nombre ingresado
        // existe y obtenemos su active para ver si se encuentra
        // activo o no (eliminado)
        $existeActivo = nivel::where('nombre', '=', $formulario['nombre'])->pluck('active');
        if($existeActivo === 1){
          // si la respuesta es 1 indica que si existe el nombre y
          // se encuentra activo por lo tanto regresamos
          // un mensaje para indicar al sistema que ya se encuentra
          // registrado
          return Response::json(array(0=>"same"));
        }
        else if($existeActivo === 0){
          // si la respuesta es 0 indica que el nombre existe pero
          // se encuentra desactivado (eliminado) por este motivo
          // lo que se debe de realizar es actualizar el mismo
          // objeto en base a la informacion nueva (activamos nuevamente)
          nivel::where('nombre', '=', $formulario['nombre'])->update(array(
            'active' => 1,
            'descripcion' => $formulario['descripcion']
          ));
          // obtenemos el objeto en base a el nombre ya existente
          $nivel = nivel::where('nombre', '=', $formulario['nombre'])->get();
          return Response::json(array(0=>"success", 1=>$nivel[0]));
        }
        else{
          // si la respuesta es diferente a 1 ó 0 nos indica que el nombre del nivel
          // ingresado no existe en la base de datos por esto
          // pasamos a registrarlo por primera vez
          $nivel = new nivel($formulario);
          $nivel->imagen = 'default.png';
          $nivel->save();
          return Response::json(array(0=>"success", 1=>$nivel));
        }
      }
    }
  }

  function update(){
    $formulario = Input::get('data');
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
    $validar = Validator::make($formulario, $reglas, $messages);
    if($validar->fails()){
      return $validar->messages();
    }
    else{
      $nombre = nivel::where('id', '=', $formulario['idUpdate'])->pluck('nombre');
      if($nombre === $formulario['nombre']){
        nivel::where('id', '=', $formulario['idUpdate'])->update(array(
          'descripcion' => $formulario['descripcion'],
          'estatus' => $formulario['estatus']
        ));
      }
      else{
        $nombre2 = nivel::where('nombre', '=', $formulario['nombre'])->pluck('nombre');
        if($nombre2 === $formulario['nombre']){
          return Response::json(array(0=>"same"));
        }
        nivel::where('id', '=', $formulario['idUpdate'])->update(array(
          'nombre' => $formulario['nombre'],
          'descripcion' => $formulario['descripcion'],
          'estatus' => $formulario['estatus']
        ));
      }
      return Response::json(array(0=>"success"));
    }
  }

  function remove(){
    $id = Input::get('data.id');
    nivel::where('id', '=', $id)->update(array(
      'active' => 0
    ));
    return Response::json(array(0=>'success'));
  }

  function changeImage($id){
    $image = Input::file('up-image');
    if($image != null){
      $destinoPath = public_path()."/packages/images/niveles/";
      $file = $image;
      $file->move($destinoPath, $file->getClientOriginalName());
      nivel::where('id', '=', $id)->update(array(
        'imagen' => $file->getClientOriginalName()
      ));
      return Response::json(array(0=>'success', 1=>$file->getClientOriginalName()));
    }
  }

  function verPaginaInWeb(){
    // consultamos en la base de datos todos los niveles que se encuentren
    // activos obteniendo la informacion necesaria
    $niveles = array('niveles' => nivel::where('active', '=', '1')
      ->select('id', 'nombre', 'descripcion', 'estatus', 'bg_color', 'imagen')
      ->get());
    // regresamos la vista junto con la coleccion de niveles
    return View::make('vista_niveles', $niveles);
  }


}


 ?>
