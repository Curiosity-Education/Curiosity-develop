<?php

/**
 *
 */
class profesorController extends BaseController
{

  function verPagina(){
    if(Request::method()=="GET"){
      $escuelas = array('escuelas'=>escuela::where('active', '=', 1)->get());
      return View::make('vista_profesores_admin', $escuelas);
    }
    else{
      $formulario = Input::all();
      $rules = array(
        'nombre' => 'required',
        'apellido_paterno' => 'required',
        'escuela_id' => 'required'
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
      $validar = Validator::make($formulario, $rules, $messages);
      if($validar->fails()){
        return $validar->messages();
      }
      else{
        if($formulario['foto'] != null){
          $destinoPath = public_path()."/packages/images/profesores/";
          $file = $formulario['foto'];
          $file->move($destinoPath, $file->getClientOriginalName());
          $thePhoto = $formulario['foto']->getClientOriginalName();
        }
        else{
          $thePhoto = 'prof-default.jpg';
        }
        $profesor = new profesor($formulario);
        $profesor->foto = $thePhoto;
        $profesor->save();
        return Response::json(array(0=>"success"));
      }
    }
  }

  function update(){
    $formulario = Input::all();
    $rules = array(
      'nombre' => 'required',
      'apellido_paterno' => 'required',
      'escuela_id' => 'required'
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
    $validar = Validator::make($formulario, $rules, $messages);
    if($validar->fails()){
      return $validar->messages();
    }
    else{
      $foto;
      if($formulario['foto'] != null){
        $destinoPath = public_path()."/packages/images/profesores/";
        $file = $formulario['foto'];
        $file->move($destinoPath, $file->getClientOriginalName());
        $foto = $file->getClientOriginalName();
      }
      else{
        $foto = profesor::where('id', '=', $formulario['id'])->pluck('foto');
      }
      profesor::where('id', '=', $formulario['id'])->update(array(
        'nombre' => $formulario['nombre'],
        'apellido_paterno' => $formulario['apellido_paterno'],
        'apellido_materno' => $formulario['apellido_materno'],
        'email' => $formulario['email'],
        'gustos' => $formulario['gustos'],
        'foto' => $foto,
        'escuela_id' => $formulario['escuela_id']
      ));
      return Response::json(array(0=>"success"));
    }
  }

  function remove(){
    $formulario = Input::get('data');
    profesor::where('id', '=', $formulario['id'])->update(array(
      'active' => 0
    ));
  }

  function getProfeInfo()
  {
    return profesor::join('escuelas', 'escuelas.id', '=', 'profesores.escuela_id')
    ->where('profesores.active', '=', 1)
    ->where('escuelas.active', '=', 1)
    ->select('profesores.*', 'escuelas.nombre as escuela_nombre', 'escuelas.id as escuela_id')
    ->get();
  }
}


 ?>
