<?php


/**
 *
 */
class tiendaController extends BaseController
{

  function viewPage(){
    $idHijo = Auth::User()->persona()->first()->hijo()->pluck('id');

    $skins = skin::orderBy('costo', 'asc')->get();

    $mySkins = skin::join('users_skins', 'users_skins.skin_id', '=', 'skins.id')
    ->where('user_id', '=', Auth::user()->id)
    ->select('skins.id', 'skin', 'preview', 'premium', 'costo', 'uso')
    ->groupBy('skins.id')
    ->get();

    $skinsBuy = [];

    foreach ($skins as $key => $value) {
      $lotengo = false;
      foreach ($mySkins as $key2 => $value2) {
        if ($value->id == $value2->id){
          $lotengo = true;
        }
      }
      if (!$lotengo){
        array_push($skinsBuy, $value);
      }
    }

    // $avatarActual = DB::table('hijos_avatars')
    // ->join('avatars_estilos', 'hijos_avatars.avatar_id', '=', 'avatars_estilos.id')
    // ->join('secuencias', 'avatars_estilos.id', '=', 'secuencias.avatar_estilo_id')
    // ->join('tipos_secuencias', 'secuencias.tipo_secuencia_id', '=', 'tipos_secuencias.id')
    // ->where('hijos_avatars.hijo_id', '=', $idHijo)
    // ->where('tipos_secuencias.nombre', '=', 'esperar')
    // ->select('secuencias.sprite', 'avatars_estilos.descripcion as historia', 'avatars_estilos.avatars_id', 'hijos_avatars.avatar_id as idEstilo')
    // ->first();

    // $nombreAvatarActual = DB::table('avatars')->where('id', '=', $avatarActual->avatars_id)->pluck('nombre');
    $estiloAvatar = avatarestilosController::getSelectedInfo();
    $avatarEstilos = avatarestilosController::getEstilosByAvatar();
    // $avatarEstilos = avatar::join('avatars_estilos', 'avatars.id', '=', 'avatars_estilos.avatars_id')
    // ->join('secuencias', 'avatars_estilos.id', '=', 'secuencias.avatar_estilo_id')
    // ->join('tipos_secuencias', 'secuencias.tipo_secuencia_id', '=', 'tipos_secuencias.id')
    // ->where('avatars.active', '=', '1')
    // ->where('avatars_estilos.active', '=', '1')
    // ->where('avatars_estilos.avatars_id', '=', $estiloAvatar->avatars_id)
    // ->where('tipos_secuencias.nombre', '=', 'esperar')
    // ->select('avatars.nombre as nombreAvatar', 'avatars_estilos.*')
    // ->get();

    $experiencia = DB::table('hijo_experiencia')->where('hijo_id', '=', $idHijo)->first();

    return View::make('vista_hijo_tiendaAvatar')->with(array(
      'skinsBuy' => $skinsBuy,
      'mySkins' => $mySkins,
      'experiencia' => $experiencia,
      'estiloAvatar' => $estiloAvatar,
      'avatarEstilos' => $avatarEstilos
    ));
  }

  function cambiarSkin(){
    $skin = Input::get('data');
    $user = Auth::user()->id;
    DB::table('users_skins')
    ->where('user_id', '=', $user)
    ->update(array(
      'uso' => 0
    ));
    DB::table('users_skins')
    ->where('user_id', '=', $user)
    ->where('skin_id', '=', $skin)
    ->update(array(
      'uso' => 1
    ));
    User::where('id', '=', $user)
    ->update(array(
      'skin_id' => $skin
    ));
    return Response::json(array("success"));
  }

  function comprarSkin(){
    $idHijo = Auth::User()->persona()->first()->hijo()->pluck('id');
    $skin = Input::get('data');
    $user = Auth::user()->id;
    // Comprobar si se completa la compra del skin
    $misCoins = DB::table('hijo_experiencia')->where('hijo_id', '=', $idHijo)->pluck('coins');
    $coinsBuy = skin::where('id', '=', $skin)->pluck('costo');
    if ($misCoins >= $coinsBuy){
      // Si se completa la compra realizamos el registro y regresamos el mensaje
      DB::table('users_skins')->insert(array(
        'uso' => 0,
        'skin_id' => $skin,
        'user_id' => $user
      ));
      DB::table('hijo_experiencia')
      ->where('hijo_id', '=', $idHijo)
      ->decrement('coins', $coinsBuy);
      $misCoins = $misCoins - $coinsBuy;
      return Response::json(array("success", array('skin' => $skin, 'coins' => $misCoins)));
    }
    else{
      // Si no se completa la compra regresamos un mensaje
      return Response::json(array("invalid"));
    }
  }

  function cambiarAvatar(){
    $idHijo = Auth::User()->persona()->first()->hijo()->pluck('id');
    $style = Input::get('data');
    DB::table('hijos_avatars')
    ->where('hijo_id', '=', $idHijo)
    ->update(array(
      'avatar_id' => $style
    ));
    return Response::json(array("success"));
  }

}




 ?>
