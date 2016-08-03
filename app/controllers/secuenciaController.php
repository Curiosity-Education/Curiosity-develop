<?php


/**
 *
 */
class secuenciaController extends BaseController
{
  function getById(){
    $id = Input::get('data');
    $secuencias = secuencia::where('active', '=', '1')
                           ->where('avatar_estilo_id', '=', $id)
                           ->get();
    $row = array();
    foreach ($secuencias as $key => $value) {
      array_push($row, json_encode($value));
    }
    return $row;
  }

  function guardar(){
    $datos = Input::all();
    $file = $datos['prevAvatar'];
    $rules = array('tipo_secuencia' => 'required');
    $messages = ["required" => "El campo :attribute es requerido"];
    $validar = Validator::make($datos, $rules, $messages);
    if($validar->fails()){
      return $validar->messages();
    }
    else{
      if($file != null){
        $destinoPath = public_path()."/packages/images/avatars_curiosity/secuencias/";
        $nombreFile = "sec_estid_".$datos['avatar_estilo_id'].'_'.md5($file->getClientOriginalName()).".".$file->getClientOriginalExtension();
        $secuencia = new secuencia($datos);
        $secuencia->tipo_secuencia_id = $datos['tipo_secuencia'];
        $secuencia->sprite = $nombreFile;
        $secuencia->save();
        $file->move($destinoPath, $nombreFile);
        return Response::json(array("success", json_encode($secuencia)));
      }
      else{
        return Response::json(array("fileEmpty"));
      }
    }
  }

  function eliminar(){
    $id = Input::get('data');
    secuencia::where('id', '=', $id)->update(array(
      'active' => 0
    ));
    return Response::json(array(0=>'success'));
  }


}




 ?>
