<?php


/**
 *
 */
class avatarestilosController extends BaseController
{
  function getById(){
    $id = Input::get('data');
    $estilos = avatarestilo::where('active', '=', '1')
                           ->where('avatars_id', '=', $id)
                           ->get();
    $row = array();
    foreach ($estilos as $key => $value) {
      array_push($row, json_encode($value));
    }
    return $row;
  }

  function registrarEstilo(){
    $datos = Input::all();
    $file = $datos['prevAvatar'];
    $rules = array(
      'nombre' => 'required',
      'valor' => 'required|integer',
      'descripcion' => 'required'
    );
    $messages = [
      "required" => "El campo :attribute es requerido",
      "integer" => "El valor de adquisición debe ser numérico sin decimal"
    ];
    $validar = Validator::make($datos, $rules, $messages);
    if($validar->fails()){
      return $validar->messages();
    }
    else{
      if($file != null){
        $destinoPath = public_path()."/packages/images/avatars_curiosity/estilos/";
        $nombreFile = "style_avid_".$datos['avatars_id'].'_'.md5($file->getClientOriginalName()).".".$file->getClientOriginalExtension();
        $estilo = new avatarestilo($datos);
        $estilo->preview = $nombreFile;
        $estilo->save();
        $file->move($destinoPath, $nombreFile);
        return Response::json(array("success", json_encode($estilo)));
      }
      else{
        return Response::json(array("fileEmpty"));
      }
    }
  }

  function actualizarEstilo(){
    $datos = Input::all();
    $file = $datos['prevAvatar'];
    $rules = array(
      'nombre' => 'required',
      'valor' => 'required|integer',
      'descripcion' => 'required'
    );
    $messages = [
      "required" => "El campo :attribute es requerido",
      "integer" => "El valor de adquisición debe ser numérico sin decimal"
    ];
    $validar = Validator::make($datos, $rules, $messages);
    if($validar->fails()){
      return $validar->messages();
    }
    else{
      $estilo = avatarestilo::where('id', '=', $datos['id'])->first();
      if($file == null){
        $nombreFile = $estilo->preview;
      }
      else{
        $destinoPath = public_path()."/packages/images/avatars_curiosity/estilos/";
        $nombreFile = "style_avid_".$estilo->avatars_id.'_updated_'.md5($file->getClientOriginalName()).".".$file->getClientOriginalExtension();
        $file->move($destinoPath, $nombreFile);
      }
      $estilo->nombre = $datos['nombre'];
      $estilo->descripcion = $datos['descripcion'];
      $estilo->valor = $datos['valor'];
      $estilo->preview = $nombreFile;
      $estilo->save();
      return Response::json(array("success", json_encode($estilo)));
    }
  }

  function eliminarEstilo(){
    $id = Input::get('data');
    avatarestilo::where('id', '=', $id)->update(array(
      'active' => 0
    ));
    return Response::json(array(0=>'success'));
  }


}




 ?>
