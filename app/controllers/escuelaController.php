<?php


/**
 *
 */
class escuelaController extends BaseController
{
  function verPagina(){
    if(Request::method()=="GET"){

      $escuelas = array('escuelas' => escuela::where('active', '=', 1)->get());
      return View::make('vista_escuelas_admin', $escuelas);

    }
    else{
      $formulario = Input::all();
      $rules = array(
        'nombre' => 'required',
        'logotipo' => 'required'
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
        $existeActivo = escuela::where('nombre', '=', $formulario['nombre'])->pluck('active');
        if($existeActivo === null){
          $destinoPath = public_path()."/packages/images/escuelas/";
          $file = $formulario['logotipo'];
          $file->move($destinoPath, $file->getClientOriginalName());

          $escuela = new escuela($formulario);
          $escuela->logotipo = $formulario['logotipo']->getClientOriginalName();
          $escuela->save();
          return Response::json(array(0=>"success", 1=>$escuela));
        }
        else if($existeActivo === 0){
          $destinoPath = public_path()."/packages/images/escuelas/";
          $file = $formulario['logotipo'];
          $file->move($destinoPath, $file->getClientOriginalName());

          escuela::where('nombre', '=', $formulario['nombre'])->update(array(
            'active' => 1,
            'web' => $formulario['web'],
            'logotipo' => $file->getClientOriginalName()
          ));
          $escuela = escuela::where('nombre', '=', $formulario['nombre'])->first();
          return Response::json(array(0=>"success_exist", 1=>$escuela));
        }
        else{
          return Response::json(array(0=>"same"));
        }
      }
    }
  }

  function update(){
    $formulario = Input::all();
    $rules = array(
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
    $validar = Validator::make($formulario, $rules, $messages);
    if($validar->fails()){
      return $validar->messages();
    }
    else{
      $logo;
      if($formulario['logotipo'] != null){
        $destinoPath = public_path()."/packages/images/escuelas/";
        $file = $formulario['logotipo'];
        $file->move($destinoPath, $file->getClientOriginalName());
        $logo = $file->getClientOriginalName();
      }
      else{
        $logo = escuela::where('id', '=', $formulario['idUpdate'])->pluck('logotipo');
      }

      $activo = escuela::where('nombre', '=', $formulario['nombre'])->pluck('active');
      $nombreEsc = escuela::where('id', '=', $formulario['idUpdate'])->pluck('nombre');

      if($activo === null){
        escuela::where('id', '=', $formulario['idUpdate'])->update(array(
          'nombre' => $formulario['nombre'],
          'logotipo' => $logo,
          'web' => $formulario['web']
        ));
        $escuela = escuela::where('id', '=', $formulario['idUpdate'])->pluck('logotipo');
        return Response::json(array(0=>"success", 1=>$escuela));
      }
      else if($activo === 0){
        return Response::json(array(0=>"same_exist"));
      }
      else if($activo === 1){
        if($nombreEsc == $formulario['nombre']){
          escuela::where('id', '=', $formulario['idUpdate'])->update(array(
            'logotipo' => $logo,
            'web' => $formulario['web']
          ));
          $escuela = escuela::where('id', '=', $formulario['idUpdate'])->pluck('logotipo');
          return Response::json(array(0=>"success", 1=>$escuela));
        }
        else{
          return Response::json(array(0=>"same"));
        }
      }
    }
  }

  function remove(){
    $formulario = Input::all();
    escuela::where('id', '=', $formulario)->update(array(
      'active' => 0
    ));
    return Response::json(array(0=>"success"));
  }

}



 ?>
