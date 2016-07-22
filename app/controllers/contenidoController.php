<?php

/**
 *
 */
class contenidoController extends BaseController
{

  function getInicio(){
    if(!Auth::user()->hasRole('padre_free') && !Auth::user()->hasRole('demo_padre') && !Auth::user()->hasRole('padre')){
      $rol = Auth::user()->roles[0]->name;
      $grados = nivel::where('active', '=', '1')->get();
      $actividades = archivo::join('actividades', 'actividades.id', '=', 'archivos.actividad_id')
      ->where('actividades.active', '=', '1')
      ->where('archivos.active', '=', '1')
      ->select('actividades.id')
      ->groupBy('actividades.id')
      ->get();
      $flagRank = array();
      foreach ($actividades as $key => $value) {
        $promedio = round(DB::table('hijo_califica_actividades')
        ->where('actividad_id', '=', $value->id)
        ->avg('calificacion'));
        $actividad = archivo::join('actividades', 'actividades.id', '=', 'archivos.actividad_id')
        ->join('temas', 'temas.id', '=', 'actividades.tema_id')
        ->join('bloques', 'bloques.id', '=', 'temas.bloque_id')
        ->join('inteligencias', 'inteligencias.id', '=', 'bloques.inteligencia_id')
        ->join('niveles', 'niveles.id', '=', 'inteligencias.nivel_id')
        ->where('actividades.id', '=', $value->id)
        ->where('actividades.active', '=', '1')
        ->where('archivos.active', '=', '1')
        ->where('temas.active', '=', '1')
        ->where('bloques.active', '=', '1')
        ->where('inteligencias.active', '=', '1')
        ->where('niveles.active', '=', '1')
        ->where('actividades.estatus', '=', 'unlock')
        ->where('temas.estatus', '=', 'unlock')
        ->where('bloques.estatus', '=', 'unlock')
        ->where('inteligencias.estatus', '=', 'unlock')
        ->where('niveles.estatus', '=', 'unlock')
        ->where('ext', '=', 'php')
        ->select('actividades.*', 'archivos.nombre as nombreFile', 'temas.nombre as nombreTema', 'bloques.nombre as nombreBloque', 'inteligencias.nombre as nombreInteligencia', 'niveles.nombre as nombreNivel', 'temas.isPremium as premium')
        ->get();
        array_push($flagRank, array('act' => $actividad, 'promedio' => $promedio));
      }
      // Ordenamos cada actividad segun su promedio
      for ($i=0; $i < count($flagRank); $i++) {
        $isMayor = null;
        $mayor = 0;
        $pos = 0;
        $vuelta = 0;
        for ($e = 0; $e < count($flagRank); $e++) {
          if ($flagRank[$i]['promedio'] < $flagRank[$e]['promedio']){
            $temp = $flagRank[$i];
            $flagRank[$i] = $flagRank[$e];
            $flagRank[$e] = $temp;
          }
        }
      }
      //Agregamos la cantidad de actividades segun el limite establecido
      // segun su mayor promedio
      $ranking = array();
      $limite = 4;
      $index = count($flagRank);
      if ($index > $limite) { $iters = $limite; }
      else { $iters = $index; }
      for ($i = 0; $i < $iters; $i++) {
        array_push($ranking, $flagRank[$index - 1]['act'][0]);
        $index--;
      }
      $nuevos = archivo::join('actividades', 'actividades.id', '=', 'archivos.actividad_id')
      ->join('temas', 'temas.id', '=', 'actividades.tema_id')
      ->join('bloques', 'bloques.id', '=', 'temas.bloque_id')
      ->join('inteligencias', 'inteligencias.id', '=', 'bloques.inteligencia_id')
      ->join('niveles', 'niveles.id', '=', 'inteligencias.nivel_id')
      ->where('actividades.active', '=', '1')
      ->where('archivos.active', '=', '1')
      ->where('temas.active', '=', '1')
      ->where('bloques.active', '=', '1')
      ->where('inteligencias.active', '=', '1')
      ->where('niveles.active', '=', '1')
      ->where('actividades.estatus', '=', 'unlock')
      ->where('temas.estatus', '=', 'unlock')
      ->where('bloques.estatus', '=', 'unlock')
      ->where('inteligencias.estatus', '=', 'unlock')
      ->where('niveles.estatus', '=', 'unlock')
      ->where('ext', '=', 'php')
      ->select('actividades.*', 'archivos.nombre as nombreFile', 'temas.nombre as nombreTema', 'bloques.nombre as nombreBloque', 'inteligencias.nombre as nombreInteligencia', 'niveles.nombre as nombreNivel', 'temas.isPremium as premium')
      ->orderBy('actividades.id', 'desc')
      ->limit(5)
      ->get();
      $populares = archivo::join('actividades', 'actividades.id', '=', 'archivos.actividad_id')
      ->join('temas', 'temas.id', '=', 'actividades.tema_id')
      ->join('bloques', 'bloques.id', '=', 'temas.bloque_id')
      ->join('inteligencias', 'inteligencias.id', '=', 'bloques.inteligencia_id')
      ->join('niveles', 'niveles.id', '=', 'inteligencias.nivel_id')
      ->where('actividades.active', '=', '1')
      ->where('archivos.active', '=', '1')
      ->where('temas.active', '=', '1')
      ->where('bloques.active', '=', '1')
      ->where('inteligencias.active', '=', '1')
      ->where('niveles.active', '=', '1')
      ->where('actividades.estatus', '=', 'unlock')
      ->where('temas.estatus', '=', 'unlock')
      ->where('bloques.estatus', '=', 'unlock')
      ->where('inteligencias.estatus', '=', 'unlock')
      ->where('niveles.estatus', '=', 'unlock')
      ->where('ext', '=', 'php')
      ->select('actividades.*', 'archivos.nombre as nombreFile', 'temas.nombre as nombreTema', 'bloques.nombre as nombreBloque', 'inteligencias.nombre as nombreInteligencia', 'niveles.nombre as nombreNivel', 'temas.isPremium as premium')
      ->orderBy('vistos', 'desc')
      ->limit(4)
      ->get();      
      $idHijo = Auth::User()->persona()->first()->hijo()->pluck('id');
      $gradoHijo = DB::table('escolaridades')->where('hijo_id', '=', $idHijo)->orderBy('id', 'desc')->limit(1)->pluck('grado');
      $recomendados = archivo::join('actividades', 'actividades.id', '=', 'archivos.actividad_id')
      ->join('temas', 'temas.id', '=', 'actividades.tema_id')
      ->join('bloques', 'bloques.id', '=', 'temas.bloque_id')
      ->join('inteligencias', 'inteligencias.id', '=', 'bloques.inteligencia_id')
      ->join('niveles', 'niveles.id', '=', 'inteligencias.nivel_id')
      ->where('actividades.active', '=', '1')
      ->where('archivos.active', '=', '1')
      ->where('temas.active', '=', '1')
      ->where('bloques.active', '=', '1')
      ->where('inteligencias.active', '=', '1')
      ->where('niveles.active', '=', '1')
      ->where('actividades.estatus', '=', 'unlock')
      ->where('temas.estatus', '=', 'unlock')
      ->where('bloques.estatus', '=', 'unlock')
      ->where('inteligencias.estatus', '=', 'unlock')
      ->where('niveles.estatus', '=', 'unlock')
      ->where('ext', '=', 'php')
      ->select('actividades.*', 'archivos.nombre as nombreFile', 'temas.nombre as nombreTema', 'bloques.nombre as nombreBloque', 'inteligencias.nombre as nombreInteligencia', 'niveles.nombre as nombreNivel', 'temas.isPremium as premium')
      ->orderBy('actividades.id', 'desc')
      ->limit(5)
      ->get();
      // return array(
      //   'rol' => $rol,
      //   'grados' => $grados,
      //   'ranking' => $ranking,
      //   'nuevos' => $nuevos,
      //   'populares' => $populares
      // );
      return View::make('vista_home_actividades')->with(array(
        'rol' => $rol,
        'grados' => $grados,
        'ranking' => $ranking,
        'nuevos' => $nuevos,
        'populares' => $populares
      ));
    }
    else {
      return View::make('vista_perfil');
    }
  }

  function getInteligencias($idGrade){
    $inteligencias = inteligencia::where("active", '=', "1")->where("nivel_id", "=", $idGrade)->get();
    return View::make("vista_contenido")->with("inteligencias", $inteligencias);
  }


}




 ?>
