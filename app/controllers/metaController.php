<?php


/**
 *
 */
class metaController extends BaseController
{
  public function getAll(){
    return DB::table('metas_diarias')->get();
  }

  public function getMetaHijo(){
    $idHijo = Auth::User()->persona()->first()->hijo()->pluck('id');
    $miMeta = DB::table('metas_diarias')
    ->join('hijos_metas_diarias', 'hijos_metas_diarias.meta_diaria_id', '=', 'metas_diarias.id')
    ->where('hijos_metas_diarias.hijo_id', '=', $idHijo)
    ->select('metas_diarias.*', 'hijos_metas_diarias.id as metaAsignedId')
    ->first();
    return $miMeta;
  }

  public function getAvanceMetaHijo(){
    $idAvance = $this->getMetaHijo()->metaAsignedId;
    $now = date("Y-m-d");
    $avanceMeta = DB::table('avances_metas')
    ->where('fecha', '=', $now)
    ->where('avance_id', '=', $idAvance)
    ->pluck('avance');
    return $avanceMeta;
  }

  public function hasMetaToday(){
    $idHijo = Auth::User()->persona()->first()->hijo()->pluck('id');
    $now = date("Y-m-d");
    $isFirst = DB::table('avances_metas')
    ->join('hijos_metas_diarias', 'hijos_metas_diarias.id', '=', 'avances_metas.avance_id')
    ->where('hijos_metas_diarias.hijo_id', '=', $idHijo)
    ->where('avances_metas.fecha', '=', $now)
    ->pluck('avances_metas.id');
    if ($isFirst == ""){
      return false;
    }
    return true;
  }




}



 ?>
