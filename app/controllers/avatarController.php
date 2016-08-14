<?php

/**
 *
 */
class avatarController extends BaseController
{

  function gestionar() {
    $avatars = array(
      'avatars' => avatar::join('avatars_estilos', 'avatars.id', '=', 'avatars_estilos.avatars_id')
      ->where('avatars.active', '=', '1')
      ->where('avatars_estilos.active', '=', '1')
      ->where('avatars_estilos.is_default', '=', '1')
      ->select('avatars.*', 'avatars_estilos.preview')
      ->get(),
      'tipos' => DB::table('tipos_secuencias')->get()
    );
    return View::make('vista_avatar_admin', $avatars);
  }

  function registrarAvatar(){
    $datos = Input::all();
    $file = $datos['prevAvatar'];
    $rules = array(
      'nombreAvatar' => 'required',
      'nombreEstilo' => 'required',
      'historia' => 'required',
      'sexo' => 'required',
      'active' =>'required',
      'is_default' => 'required',
      'valor' => 'required'
    );
    $messages = ["required" => "El campo :attribute es requerido"];
    $validar = Validator::make($datos, $rules, $messages);
    if($validar->fails()){
      return $validar->messages();
    }
    else{
      if($file != null){
        $avatar = new avatar($datos);
        $avatar->nombre = $datos['nombreAvatar'];
        $avatar->save();
        $destinoPath = public_path()."/packages/images/avatars_curiosity/estilos/";
        $nombreFile = "def_avid_".$avatar->id.'_'.md5($file->getClientOriginalName()).".".$file->getClientOriginalExtension();
        $estilo = new avatarestilo($datos);
        $estilo->nombre = $datos['nombreEstilo'];
        $estilo->preview = $nombreFile;
        $estilo->avatars_id = $avatar->id;
        $estilo->save();
        $file->move($destinoPath, $nombreFile);
        $tupla = array(
          'id' => $avatar->id,
          'nombre' => $avatar->nombre,
          'historia' => $avatar->historia,
          'sexo' => $avatar->sexo,
          'active' => $avatar->active,
          'preview' => $estilo->preview
        );
        return Response::json(array("success", json_encode($tupla)));
      }
      else{
        return Response::json(array("fileEmpty"));
      }
    }
  }

  function actualizarAvatar(){
    $datos = Input::all();
    $file = $datos['prevAvatar'];
    $rules = array(
      'nombreAvatar' => 'required',
      'historia' => 'required',
      'sexo' => 'required'
    );
    $messages = ["required" => "El campo :attribute es requerido"];
    $validar = Validator::make($datos, $rules, $messages);
    if($validar->fails()){
      return $validar->messages();
    }
    else{
      $estilo = avatarestilo::where('avatars_id', '=', $datos['id'])
                              ->where('is_default', '=', '1')
                              ->first();
      if($file == null){
        $nombreFile = $estilo->preview;
      }
      else{
        $destinoPath = public_path()."/packages/images/avatars_curiosity/estilos/";
        $nombreFile = "def_avid_".$estilo->avatars_id.'_updated_'.md5($file->getClientOriginalName()).".".$file->getClientOriginalExtension();
        $file->move($destinoPath, $nombreFile);
      }
      $avatar = avatar::where('id', '=', $datos['id'])->first();
      $avatar->nombre = $datos['nombreAvatar'];
      $avatar->sexo = $datos['sexo'];
      $avatar->historia = $datos['historia'];
      $avatar->save();
      $estilo->preview = $nombreFile;
      $estilo->save();
      $tupla = array(
        'id' => $avatar->id,
        'nombre' => $avatar->nombre,
        'historia' => $avatar->historia,
        'sexo' => $avatar->sexo,
        'active' => $avatar->active,
        'preview' => $estilo->preview
      );
      return Response::json(array("success", json_encode($tupla)));
    }
  }

  function eliminarAvatar(){
    $id = Input::get('data.id');
    avatar::where('id', '=', $id)->update(array(
      'active' => 0
    ));
    return Response::json(array(0=>'success'));
  }

  function getAvatarSprite($secuenciaName){
    $idHijo = Auth::User()->persona()->first()->hijo()->pluck('id');    
    $sprite = DB::table('hijos_avatars')
    ->join('avatars_estilos', 'hijos_avatars.avatar_id', '=', 'avatars_estilos.id')
    ->join('secuencias', 'avatars_estilos.id', '=', 'secuencias.avatar_estilo_id')
    ->join('tipos_secuencias', 'secuencias.tipo_secuencia_id', '=', 'tipos_secuencias.id')
    ->where('hijos_avatars.hijo_id', '=', $idHijo)
    ->where('tipos_secuencias.nombre', '=', $secuenciaName)
    ->pluck('secuencias.sprite');
    return $sprite;
  }

}


 ?>
