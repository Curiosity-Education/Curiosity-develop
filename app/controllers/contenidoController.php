<?php

/**
 *
 */
class contenidoController extends BaseController
{
  function getInicio(){
    if(!Auth::user()->hasRole('padre_free') && !Auth::user()->hasRole('demo_padre') && !Auth::user()->hasRole('padre')){
      if (Auth::user()->hasRole('hijo') || Auth::user()->hasRole('hijo_free') || Auth::user()->hasRole('demo_hijo')){
        if (Auth::user()->flag == 1){
          // Si el hijo es la primera vez en iniciar sesion
          // le mostramos una vista en la cual seleccionará su avatar
          $avatars = array(
            "avatars" => DB::table('avatars')->join('avatars_estilos', 'avatars.id', '=', 'avatars_estilos.avatars_id')
             ->join('secuencias', 'secuencias.avatar_estilo_id', '=', 'avatars_estilos.id')
             ->join('tipos_secuencias', 'tipos_secuencias.id', '=', 'secuencias.tipo_secuencia_id')
             ->where('avatars.active', '=', '1')
             ->where('avatars_estilos.active', '=', '1')
             ->where('avatars_estilos.is_default', '=', '1')
             ->where('secuencias.active', '=', '1')
             ->where('tipos_secuencias.nombre', '=', 'esperar')
             ->select('avatars.nombre', 'avatars_estilos.preview', 'avatars_estilos.id as yd')
             ->groupBy('avatars_estilos.id')
             ->get()
          );
          DB::table('users_skins')->insert(array(
            'uso' => 1,
            'skin_id' => Auth::user()->skin_id,
            'user_id' => Auth::user()->id
          ));
          return View::make('vista_selectAvatar', $avatars);
        }
        else{
          return $this->makeViewInicio();
        }
      }
      else{
        return $this->makeViewInicio();
      }
    }
    else {
      return View::make('vista_perfil');
    }
  }

  function getInteligencias($idGrade){
    $inteligencias = inteligencia::where("active", '=', "1")->where("nivel_id", "=", $idGrade)->get();
    return View::make("vista_contenido")->with("inteligencias", $inteligencias);
  }

  function getAllVideos(){
    return video::select('code_embed')->get();
  }

  private function makeViewInicio(){
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
      if (count($actividad) > 0){
        array_push($flagRank, array('act' => $actividad, 'promedio' => $promedio));
      }
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
    ->select('actividades.*', 'archivos.nombre as nombreFile', 'temas.nombre as nombreTema', 'bloques.nombre as nombreBloque', 'inteligencias.nombre as nombreInteligencia', 'niveles.nombre as nombreNivel', 'temas.isPremium as premium', 'actividades.wallpaper')
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

    // Juegos recomendables para el alumno dependiendo los resultados mas bajos
    if(Auth::user()->hasRole('hijo') || Auth::user()->hasRole('hijo_free') || Auth::user()->hasRole('demo_hijo')){
        $recomendables = archivo::join('actividades', 'archivos.actividad_id', '=', 'actividades.id')
          ->join('hijo_realiza_actividades', 'hijo_realiza_actividades.actividad_id', '=', 'actividades.id')
          ->join('temas', 'temas.id', '=', 'actividades.tema_id')
          ->join('bloques', 'bloques.id', '=', 'temas.bloque_id')
          ->join('inteligencias', 'inteligencias.id', '=', 'bloques.inteligencia_id')
          ->join('niveles', 'niveles.id', '=', 'inteligencias.nivel_id')
          ->join('hijos','hijos.id','=','hijo_realiza_actividades.hijo_id')
          ->join('personas','hijos.persona_id','=','personas.id')
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
          ->where('personas.user_id',Auth::user()->id)
          ->select(DB::raw("actividades.nombre, actividades.estatus, AVG( hijo_realiza_actividades.promedio ) AS  'promedio', actividades.*, archivos.nombre as nombreFile, temas.nombre as nombreTema, bloques.nombre as 'nombreBloque', inteligencias.nombre as 'nombreInteligencia', niveles.nombre as 'nombreNivel', temas.isPremium as 'premium'"))
          ->groupBy('actividades.nombre')
          ->orderBy('promedio')
          ->limit(3)
          ->get();
    }
    else{
        $recomendables = array();
    }

    $videos = video::join('actividades', 'videos.actividad_id', '=', 'actividades.id')
    ->join('temas', 'actividades.tema_id', '=', 'temas.id')
    ->join('bloques', 'temas.bloque_id', '=', 'bloques.id')
    ->join('inteligencias', 'bloques.inteligencia_id', '=', 'inteligencias.id')
    ->join('niveles', 'inteligencias.nivel_id', '=', 'niveles.id')
    ->where('niveles.active', '=', '1')
    ->where('inteligencias.active', '=', '1')
    ->where('bloques.active', '=', '1')
    ->where('temas.active', '=', '1')
    ->where('actividades.active', '=', '1')
    ->where('actividades.estatus', '=', 'unlock')
    ->where('temas.estatus', '=', 'unlock')
    ->where('bloques.estatus', '=', 'unlock')
    ->where('inteligencias.estatus', '=', 'unlock')
    ->where('niveles.estatus', '=', 'unlock')
    ->select('videos.code_embed', 'temas.bg_color as color')
    ->orderBy('videos.index_order', 'asc')
    ->limit(4)
    ->get();

    // return array(
    //   'rol' => $rol,
    //   'grados' => $grados,
    //   'ranking' => $ranking,
    //   'nuevos' => $nuevos,
    //   'populares' => $populares
    // );
    if(Auth::user()->hasRole('hijo') || Auth::user()->hasRole('hijo_free') || Auth::user()->hasRole('demo_hijo')){
      $now = date("Y-m-d");
      $meta = new metaController();
      $metas = $meta->getAll();
      $miMeta = $meta->getMetaHijo();
      if (!$meta->hasMetaToday()){
        DB::table('avances_metas')->insert(array(
          'avance' => 0,
          'fecha' => $now,
          'avance_id' => $miMeta->metaAsignedId
        ));
      }
    }

    return View::make('vista_home_actividades')->with(array(
      'rol' => $rol,
      'grados' => $grados,
      'ranking' => $ranking,
      'nuevos' => $nuevos,
      'populares' => $populares,
      'recomendables' => $recomendables,
      'videos' => $videos
    ));
  }

  function adminVideos(){
    return View::make('vista_videosInicio');
  }

    function myVideos(){
        $videos = video::join('actividades', 'videos.actividad_id', '=', 'actividades.id')
        ->join('temas', 'actividades.tema_id', '=', 'temas.id')
        ->join('bloques', 'temas.bloque_id', '=', 'bloques.id')
        ->join('inteligencias', 'bloques.inteligencia_id', '=', 'inteligencias.id')
        ->join('niveles', 'inteligencias.nivel_id', '=', 'niveles.id')
        ->where('niveles.active', '=', '1')
        ->where('inteligencias.active', '=', '1')
        ->where('bloques.active', '=', '1')
        ->where('temas.active', '=', '1')
        ->where('actividades.active', '=', '1')
        ->where('actividades.estatus', '=', 'unlock')
        ->where('temas.estatus', '=', 'unlock')
        ->where('bloques.estatus', '=', 'unlock')
        ->where('inteligencias.estatus', '=', 'unlock')
        ->where('niveles.estatus', '=', 'unlock')
        ->select('videos.code_embed', 'niveles.nombre as nivel', 'bloques.nombre as bloque', 'inteligencias.nombre as inteligencia','videos.id','videos.index_order', 'temas.nombre as tema', 'actividades.nombre as actividad')
        ->orderBy('videos.index_order', 'asc')
        ->get();
        Session::put("videos",$videos);
        return $this->indexar(Session::get("videos"));
    }

    private function indexar($videos){
        $index = 1;
        foreach($videos as $video){
            $video->index_order = $index;
            $index++;
        }
        return $videos;
    }
    
    public function reindexar(){
        $arrayVideos = Input::get("videos");
        /*===========================================
            Validamos que los objetos mand-
            os al cliente sean la misma C-
            cantidad de objetos que los r-
            ecividos del lado del cliente
        =============================================*/  
        if(count($arrayVideos) == count(Session::get("videos"))){
            $index = 1;
            $this->ordenarArrayJson($arrayVideos,0,count($arrayVideos)-1);//ordenamos en orden ascendente 
            foreach($arrayVideos as $video){
                $video_ = video::find($video["id"]);
                if($video_){
                    $video_->index_order = $index;
                    $video_->save();
                    $index++;
                }
            }
            return Response::json(["status"=>true]);
        }else{
            return Response::json(["status"=>false]);
        } 
    }
    /*===================================================
        función para ordenar ascendentemente el array
        esto función en caso de que haya alguna inco-
        sistencia en el orden del array como se envió
        del lado del cliente, para esto volvemos a 
        reordenarlo,(solo para verificar)- 
    ====================================================*/
    private function ordenarArrayJson($jsons,$izq,$der){
      $pivote=$jsons[$izq]; 
      $i=$izq; 
      $j=$der; 
      $aux;
        while($i<$j){           
           while(intval($jsons[$i]["index_order"])<=intval($pivote["index_order"]) && $i<$j) $i++; 
           while(intval($jsons[$j]["index_order"])>intval($pivote["index_order"])) $j--;         
           if ($i<$j) {                                         
               $aux= $jsons[$i];                 
               $jsons[$i]=$jsons[$j];
               $jsons[$j] =$aux;
           }
         }
         $jsons[$izq]=$jsons[$j];
         $jsons[$j]=$pivote; 
         if($izq<$j-1)
            $this->ordenarArrayJson($jsons,$izq,$j-1); 
         if($j+1 <$der)
            $this->ordenarArrayJson($jsons,$j+1,$der); 
    }
}
    
    