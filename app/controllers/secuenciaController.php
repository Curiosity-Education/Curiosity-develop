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
                           ->groupBy('avatar_estilo_id')
                           ->get();
    $row = array();
    foreach ($secuencias as $key => $value) {
      array_push($row, json_encode($value));
    }
    return $row;
  }

  function guardar(){
    $datos = Input::all();
    $file = Input::file('filesecuence');
    $rules = array('tipo_secuencia' => 'required');
    $messages = ["required" => "El campo :attribute es requerido"];
    $validar = Validator::make($datos, $rules, $messages);
    if($validar->fails()){
      return $validar->messages();
    }
    else{
      if($file != null){
        $myZip = new zipController();
        $tiposDir = array(
          'png' => '/packages/images/avatars_curiosity/secuencias/'
        );
        $zipFile = $myZip->extraerSave($file, $tiposDir, 'both');
        foreach ($zipFile[1] as $index => $objeto) {
          $secuencia = new secuencia($datos);
          $secuencia->tipo_secuencia_id = $datos['tipo_secuencia'];
          $secuencia->sprite = $objeto['nombre'];
          $secuencia->save();
        }
        return Response::json(array("success", json_encode($secuencia)));
      }
      else{
        return Response::json(array("fileEmpty"));
      }
    }
  }

  function eliminar(){
    $datos = Input::get('data');
    secuencia::where('avatar_estilo_id', '=', $datos['idEstilo'])
    ->where('tipo_secuencia_id', '=', $datos['isTipo'])
    ->update(array(
      'active' => 0
    ));
    return Response::json(array(0=>'success'));
  }

  public static function getSelectedSprite($nameType){
    if (Auth::user()->hasRole('hijo') || Auth::user()->hasRole('hijo_free') || Auth::user()->hasRole('demo_hijo')){
      $idHijo = Auth::User()->persona()->first()->hijo()->pluck('id');
      $idEstilo = avatarestilosController::getSelectedInfo()->id;
      $spritePack = DB::table('hijos_avatars')
      ->join('avatars_estilos', 'hijos_avatars.avatar_id', '=', 'avatars_estilos.id')
      ->join('secuencias', 'avatars_estilos.id', '=', 'secuencias.avatar_estilo_id')
      ->join('tipos_secuencias', 'secuencias.tipo_secuencia_id', '=', 'tipos_secuencias.id')
      ->where('hijos_avatars.hijo_id', '=', $idHijo)
      ->where('tipos_secuencias.nombre', '=', $nameType)
      ->where('secuencias.avatar_estilo_id', '=', $idEstilo)
      ->select('secuencias.sprite', 'secuencias.id')
      ->orderBy('secuencias.sprite', 'asc')
      ->get();
      return Response::json(array('estatus'=>true, 'sprite'=>$spritePack));
    }
    else{
      return Response::json(array('estatus'=>false, 'sprite'=>'spritenonsondavatar.png'));
    }
  }

}




 ?>
