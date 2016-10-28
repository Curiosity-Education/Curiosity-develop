<?php

/**
 *  Permite obtener datos de ubicacion de direcciones
 *  mediante peticiones AJAX
 */

class direccionController extends BaseController
{

  function getEstados($pais){
    return estado::where('pais_id', '=', pais::where('pais', '=', $pais)->pluck('id'))->get();
  }

  function getCiudades(){
    $estadoId = Input::get('estado');
    $pais = Input::get('pais');
    $query = DB::table('ciudades')->join('estados', 'estado_id', '=', 'estados.id')
    ->join('paises', 'pais_id', '=', 'paises.id')
    ->where('estados.id', '=', $estadoId)
    ->where('paises.pais', '=', $pais)
    ->select('ciudades.*')
    ->get();
    return $query;
  }

}


 ?>
