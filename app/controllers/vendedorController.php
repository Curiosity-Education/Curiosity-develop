<?php

/**
 *
 */
class vendedorController extends BaseController
{

  function verPagina(){
    return View::make('adminVendedores');
  }

  function obtenerActivos (){
    return vendedor::join('ciudades', 'ciudades.id', '=', 'vendedores.ciudad_id')
    ->join('estados', 'estados.id', '=', 'ciudades.estado_id')
    ->select('vendedores.*', 'ciudades.id as ciudadId', 'ciudades.nombre as ciudadNombre', 'estados.id as estadoId', 'estados.nombre as estadoNombre')
    ->where('active', '=', 1)->get();
  }

  function guardar(){
    $datos = Input::all();
    $rules = array(
      'nombre' => 'required',
      'apellidos' => 'required',
      'correo' => 'required|email',
      'sexo' => 'required',
      'ciudad' => 'required'
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
     $validar = Validator::make($datos, $rules, $messages);
     if($validar->fails()){
       return $validar->messages();
     }
     else{
       // Caracteres que se pueden usar.
       $caracteres = "abcdefghijklmnopqrstuvwxyz1234567890";
       //numero de letras para generar el nombre random
       $cantidadLetras = 3;
       //variable para crear el codigo
       $nombreRandom = "";
       for($i=0; $i < $cantidadLetras; $i++){
         /*Extraemos 1 caracter de los caracteres
         entre el rango 0 a Numero de letras que tiene la cadena */
         $nombreRandom .= substr($caracteres,rand(0,strlen($caracteres)),1);
       }
       $inicialN = substr($datos['nombre'], 0, 2);
       $inicialAP = substr($datos['apellidos'], 0, 2);
       $vendedor = new vendedor($datos);
       $vendedor->active = 1;
       $vendedor->foto = 'foto_default.jpg';
       $vendedor->ciudad_id = $datos['ciudad'];
       $vendedor->codigo = "cue".$nombreRandom.$inicialN.rand().$inicialAP.date("y").date("d").date("m");
       $vendedor->save();
       return json_encode('success');
     }
  }

  function actualizar(){
    $datos = Input::all();
    $rules = array(
      'nombre' => 'required',
      'apellidos' => 'required',
      'correo' => 'required|email',
      'sexo' => 'required',
      'ciudad' => 'required'
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
     $validar = Validator::make($datos, $rules, $messages);
     if($validar->fails()){
       return $validar->messages();
     }
     else{
       $vendedor = vendedor::where('id', '=', $datos['id'])->first();
       $vendedor->nombre = $datos['nombre'];
       $vendedor->apellidos = $datos['apellidos'];
       $vendedor->correo = $datos['correo'];
       $vendedor->telefono = $datos['telefono'];
       $vendedor->sexo = $datos['sexo'];
       $vendedor->ciudad_id = $datos['ciudad'];
       $vendedor->save();
       return json_encode('success');
     }
  }

  function eliminar (){
    $dato = Input::all();
    $vendedor = vendedor::where('id', '=', $dato['id'])->first();
    $vendedor->active = 0;
    $vendedor->save();
    return json_encode('success');
  }

  function guardarFoto(){
    $foto = Input::file('imagenV');
    $dato = Input::all();
    $id = $dato['id'];
    $vendedor = vendedor::where("id", '=', $id)->first();
    if ($foto != null){
      if ($vendedor->foto != "foto_default.jpg"){
        unlink(public_path()."/packages/images/perfilVendedores/".$vendedor->foto);
      }
      $nf = rand().substr($vendedor->nombre, 0, 2).substr($vendedor->apellidos, 0, 2).date("m").date("d").date("y").".".$foto->getClientOriginalExtension();
      $destinoPath = public_path()."/packages/images/perfilVendedores/";
      $foto->move($destinoPath, $nf);
      $vendedor->foto = $nf;
      $vendedor->save();
      return $vendedor->foto;
    }
  }

}


 ?>
