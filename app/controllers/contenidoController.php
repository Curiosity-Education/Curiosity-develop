<?php

/**
 *
 */
class contenidoController extends BaseController
{

  function getInicio(){
    if(!Auth::user()->hasRole('padre_free') && !Auth::user()->hasRole('demo_padre') && !Auth::user()->hasRole('padre')){
      $contenido = array(
        "grados" => Nivel::where('active', '=', '1')->get(),
        "ranking" => Actividad::join("hijo_califica_actividades", 'actividad_id', '=', 'actividades.id')
                     ->where('active', '=', '1')
                     ->orderBy('calificacion', 'desc')
                     ->limit(4)
                     ->get()
      );
      // return $contenido;
      return View::make('vista_home_actividades', $contenido);
    }
    else {
      return View::make('vista_perfil');
    }
  }

  function getInteligencias($idGrade){
    $inteligencias = Inteligencia::where("active", '=', "1")->where("nivel_id", "=", $idGrade)->get();
    return View::make("vista_contenido")->with("inteligencias", $inteligencias);
  }


}




 ?>
