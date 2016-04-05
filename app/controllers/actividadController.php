<?php

/**
 *
 */
class actividadController extends BaseController
{
  function verPagina($id, $idBloque, $idInt, $idNivel){
    if(Request::method()=="GET"){
      // buscamos si el id de inteligencia que paso como parametro
      // existe y si es asi si este se encuentra activo
      $activo = tema::where('id', '=', $id)->pluck('active');
      if($activo === 1){
        // creamos un objeto de tipo array asociativo el
        // cual contiene una coleccion de datos de los bloques y
        // de los tipos de inteligencia que se encuentran activos, asi como el id
        // que se ha pasado como parametro el cual indica de cual inteligencia
        // pertenece toda la informacion que se va a mostrar al usuario
        $obj_actividades= array('obj_actividades' => actividad::where('actividades.active', '=', '1')
        ->where('actividades.tema_id', '=', $id)
        ->join('videos', 'videos.actividad_id', '=', 'actividades.id')
        ->select('actividades.id', 'actividades.nombre', 'actividades.objetivo', 'actividades.estatus', 'actividades.bg_color', 'actividades.tema_id', 'actividades.imagen', 'actividades.pdf', 'videos.profesores_id', 'videos.code_embed', 'videos.id as video_id')
        ->get(),
        'obj_tema' => tema::where('id', '=', $id)
        ->select('id', 'nombre')->get(),
        'obj_bloque' => bloque::where('id', '=', $idBloque)
        ->select('id', 'nombre')->get(),
        'obj_inteligencia' => inteligencia::where('id', '=', $idInt)
        ->select('id', 'nombre')->get(),
        'obj_nivel' => nivel::where('id', '=', $idNivel)
        ->select('id', 'nombre')->get(),
        'obj_profesores' => profesor::select('id', 'nombre', 'apellido_paterno', 'apellido_materno')->get()
        );
        // regresamos la vista junto con el arreglo recien creado
        return View::make('vista_actividades_admin', $obj_actividades);
      }
      else{
        // si el id que paso como parametro no existe o bien
        // no se encuentra activo se regresa la vista de error 404
        // indicando la direccion ingresada no existe
        return View::make('view-error404');
      }
    }
    else{
      // si se accedio a la ruta por POST se realiza lo siguiente:
      // obtenemos la informacion del formulario
      $formulario = Input::all();
      // creamos las reglas de validacion
      $reglas = array(
        'nombre' => 'required'
      );
      // validamos el formulario segun las reglas establecidas
      $validar = Validator::make($formulario, $reglas);
      // verificamos que los datos del formulario cumplan las reglas
      // de validacion
      if($validar->fails()){
        // si no se han cumplido las reglas se envian
        // los errores a pantalla del usuario
        return $validar->messages();
      }
      else{
        // hacemos una consulta a la base de datos donde
        // traemos todos los nombres que existen segun el
        // id que se envio desde el formulario
        $nombre = actividad::where('tema_id', '=', $formulario['tema_id'])->select('nombre')->get();
        $existe = false;
        // se recorre el objeto de nombres
        foreach ($nombre as $name) {
          // si el nombre es igual al que contiene la informacion
          // del formulario se establece la variable bandera en true
          if($name->nombre === $formulario['nombre']){
            $existe = true;
          }
        }
        // si la variable bandera se encuentra en false
        // quiere decir que el nombre que contiene el formulario
        // no existe en la base de datos
        if($existe === false){
          // creamos un objeto y lo guardamos en la base de datos
          // al final enviamos una respuesta y el objeto creado
          $destinoPath = public_path()."/packages/docs/";
          $file = $formulario['archivoPDF'];
          $file->move($destinoPath, $file->getClientOriginalName());

          $objeto = new actividad($formulario);
          $objeto->imagen = "default.png";
          $objeto->pdf = is_null($formulario['archivoPDF']) ? null : $formulario['archivoPDF']->getClientOriginalName();
          $objeto->save();
          $video = new video($formulario);
          $video->actividad_id = $objeto->id;
          $video->save();
          $actividad = video::where('videos.id', '=', $video->id)
            ->join('actividades', 'actividades.id', '=', 'videos.actividad_id')
            ->join('temas', 'temas.id', '=', 'actividades.tema_id')
            ->join('bloques', 'bloques.id', '=', 'temas.bloque_id')
            ->join('inteligencias', 'inteligencias.id', '=', 'bloques.inteligencia_id')
            ->join('niveles', 'niveles.id', '=', 'inteligencias.nivel_id')
            ->select('actividades.id', 'actividades.nombre', 'actividades.objetivo', 'actividades.bg_color', 'actividades.active', 'actividades.estatus', 'actividades.imagen', 'actividades.tema_id', 'temas.id as tema_id', 'bloques.id as bloque_id', 'niveles.id as nivel_id', 'inteligencias.id as inteligencia_id', 'videos.code_embed as code_embed', 'actividades.pdf', 'videos.profesores_id', 'videos.id as video_id')
            ->get();
          return Response::json(array(0=>"success", 1=>$actividad));
        }
        else{
          $estaActivo = actividad::where('nombre', '=', $formulario['nombre'])
          ->where('tema_id', '=', $formulario['tema_id'])
          ->pluck('active');
          if($estaActivo === 0){
            // Si el nombre ya existe en la base de datos
            // y se encuantra inactivo segun el id de inteligencia
            // lo volvemos a activar cambiando el active a 1
            // segun el nombre
            $idAct = actividad::where('nombre', '=', $formulario['nombre'])->pluck('id');
            $archivo;

            if($formulario['archivoPDF'] != null){
              $archivo = $formulario['archivoPDF']->getClientOriginalName();
              $destinoPath = public_path()."/packages/docs/";
              $file = $formulario['archivoPDF'];
              $file->move($destinoPath, $file->getClientOriginalName());
            }
            else{
              $archivo = actividad::where('nombre', '=', $formulario['nombre'])->pluck('pdf');
            }

            actividad::where('nombre', '=', $formulario['nombre'])
            ->where('tema_id', '=', $formulario['tema_id'])
            ->update(array(
                'active' => 1,
                'imagen' => 'default.png',
                'objetivo' => $formulario['objetivo'],
                'pdf' => $archivo,
                'estatus' => 'lock'
              ));

            video::where('actividad_id', '=', $idAct)->update(array(
                'code_embed' => $formulario['code_embed'],
                'profesores_id' => $formulario['profesores_id']
              ));

            $actividad = video::where('videos.actividad_id', '=', $idAct)
              ->join('actividades', 'actividades.id', '=', 'videos.actividad_id')
              ->join('temas', 'temas.id', '=', 'actividades.tema_id')
              ->join('bloques', 'bloques.id', '=', 'temas.bloque_id')
              ->join('inteligencias', 'inteligencias.id', '=', 'bloques.inteligencia_id')
              ->join('niveles', 'niveles.id', '=', 'inteligencias.nivel_id')
              ->select('actividades.id', 'actividades.nombre', 'actividades.objetivo', 'actividades.bg_color', 'actividades.active', 'actividades.estatus', 'actividades.imagen', 'actividades.tema_id', 'temas.id as tema_id', 'bloques.id as bloque_id', 'niveles.id as nivel_id', 'inteligencias.id as inteligencia_id', 'videos.code_embed as code_embed', 'actividades.pdf', 'videos.profesores_id', 'videos.id as video_id')
              ->get();
            return  Response::json(array(0=>"success_exist", 1=>$actividad));
          }
          else{
            // si el nombre existe enviamos un mensaje
            // que indica que el nombre ya existe en la base de datos
            return Response::json(array(0=>"same"));
          }
        }
      }
    }
  }

  function update(){
    // obtenemos la informacion del formulario
    $formulario = Input::all();
    // creamos las reglas de validacion
    $reglas = array(
      'nombre' => 'required'
    );
    // validamos el formulario segun las reglas
    $validar = Validator::make($formulario, $reglas);
    // verificamos si el formualrio ha sido validado
    if($validar->fails()){
      return $validar->messages();
    }
    else{
      // verificamos si el nombre proveniente del formulario
      // es el mismo del que existe en la base de datos
      // segun el mismo id proveniente del formulario
      $objetosDB = actividad::where('id', '=', $formulario['idUpdate'])->get();
      if($objetosDB[0]['nombre'] === $formulario['nombre']){
        // si el nombre existe en la BD no se actualiza el nombre
        // unicamente la descripcion y el estatus del mismo
        $archivo;
        if($formulario['archivoPDF'] != null){
          $archivo = $formulario['archivoPDF']->getClientOriginalName();
          $destinoPath = public_path()."/packages/docs/";
          $file = $formulario['archivoPDF'];
          $file->move($destinoPath, $file->getClientOriginalName());
        }
        else{
          $archivo = actividad::where('id', '=', $formulario['idUpdate'])->pluck('pdf');
        }

        actividad::where('id', '=', $formulario['idUpdate'])->update(array(
          'objetivo' => $formulario['objetivo'],
          'pdf' => $archivo,
          'estatus' => $formulario['estatus']
        ));

        video::where('actividad_id', '=', $formulario['idUpdate'])->update(array(
            'code_embed' => $formulario['code_embed'],
            'profesores_id' => $formulario['profesores_id']
          ));
        return Response::json(array(0=>"success"));
      }
      else{
        // si el nombre no es el mismo que el que proviene de la BD segun
        // el id enviado se busca ahora si el nombre del formulario
        // existe en la base de datos independientemente del id que se tenga
        // como referencia. es decir se busca en toda la DB
        $existe = 'no';
        $nombres = actividad::where('tema_id', '=', $formulario['procedenciaID'])
        ->select('nombre')->get();
        foreach ($nombres as $name) {
          if($name['nombre'] === $formulario['nombre']){
            $existe = 'si';
          }
        }
        if($existe === 'no'){
          $archivo;
          if($formulario['archivoPDF'] != null){
            $archivo = $formulario['archivoPDF']->getClientOriginalName();
            $destinoPath = public_path()."/packages/docs/";
            $file = $formulario['archivoPDF'];
            $file->move($destinoPath, $file->getClientOriginalName());
          }
          else{
            $archivo = actividad::where('id', '=', $formulario['idUpdate'])->pluck('pdf');
          }

          actividad::where('id', '=', $formulario['idUpdate'])->update(array(
            'nombre' => $formulario['nombre'],
            'objetivo' => $formulario['objetivo'],
            'pdf' => $archivo,
            'estatus' => $formulario['estatus']
          ));

          video::where('actividad_id', '=', $formulario['idUpdate'])->update(array(
            'code_embed' => $formulario['code_embed'],
            'profesores_id' => $formulario['profesores_id']
          ));
          return Response::json(array(0=>"success"));
        }
        else{
          // si el nombre existe
          $nombreActivo = actividad::where('tema_id', '=', $formulario['procedenciaID'])
          ->where('nombre', '=', $formulario['nombre'])
          ->select('active')->get();
          if($nombreActivo[0]->active === 0){
            return Response::json(array(0=>"same_exist"));
          }
          else{
            return Response::json(array(0=>"same"));
          }
        }
      }
    }
  }

  function remove(){
    $id = Input::get('data.id');
    actividad::where('id', '=', $id)->update(array(
      'active' => 0
    ));
    return Response::json(array(0=>'success'));
  }

  function verPaginaInWeb($id){
    // consultamos en la base de datos todos los tipos
    // de inteligencia que se encuentren
    // activos obteniendo la informacion necesaria dependiendo del nivel
    $objetos = array('objetos' => actividad::join('temas', 'temas.id', '=', 'actividades.tema_id')
      ->join('bloques', 'bloques.id', '=', 'temas.bloque_id')
      ->join('inteligencias', 'inteligencias.id', '=', 'bloques.inteligencia_id')
      ->join('niveles', 'niveles.id', '=', 'inteligencias.nivel_id')
      ->where('temas.id', '=', $id)
      ->where('actividades.active', '=', 1)
      ->select('actividades.id', 'actividades.nombre', 'actividades.objetivo', 'actividades.estatus', 'actividades.bg_color', 'actividades.imagen', 'inteligencias.id as inteligencia_id', 'inteligencias.nombre as inteligencia_nombre', 'niveles.id as nivel_id', 'niveles.nombre as nivel_nombre', 'bloques.id as bloque_id', 'bloques.nombre as bloque_nombre', 'temas.id as tema_id', 'temas.nombre as tema_nombre')
      ->get()
    );

    $objectBelive = tema::where('id', '=', $id)->pluck('estatus');

    $actividadExiste = actividad::join('temas', 'temas.id', '=', 'actividades.tema_id')
    ->where('temas.id', '=', $id)->select('actividades.id')->first();

    if($objectBelive === "unlock"){
      if($actividadExiste != null){
        return View::make('vista_actividades', $objetos);
      }
      else{
        return View::make('view-error404');
      }
    }
    else{
      return View::make('view-error404');
    }
  }

  function changeImage($id){
    $image = Input::file('up-image');
    if($image != null){
      $destinoPath = public_path()."/packages/images/actividades/";
      $file = $image;
      $file->move($destinoPath, $file->getClientOriginalName());
      actividad::where('id', '=', $id)->update(array(
        'imagen' => $file->getClientOriginalName()
      ));
      return Response::json(array(0=>'success', 1=>$file->getClientOriginalName()));
    }
  }
    public function hasGame(){
        return archivo::where('ext','=','php')->where('active','=','1')->select('id','actividad_id','nombre')->get();
    }
    /*-----------------------------------
    | Funcion para mostrar el juego
    | dependiendo su parametro que recibe
    | el nombre del juego
    -------------------------------------*/
    public function getViewJuego($idActividad,$nombre){
       //---Seleccionamos el nombre de la vista que nos mando por la URI
        $vista = archivo::where('nombre','=',$nombre.'.blade.php')->where('actividad_id','=',$idActividad)->where('ext','=','php')->select('nombre')->get();
            try{
                //----Retornamos la vista del juego
                return View::make('juegos.'.str_replace('.blade.php','',$vista[0]->nombre));
            }
            catch(Exception $ex){
                return Redirect::To('/cursosAdmin');
            }
    }
    public function subirJuego($idActividad){
        if(Request::method() == 'GET'){
            //---Vista para subir el juego
            return View::make('vista_subirJuego');
        }
        else{
              try{
                        
                        //---Guardamos el id de la actividad en una session para usarla luego
                        Session::put('idActividad',$idActividad);
                        //Validamos que el input no este vacio
                        if(Input::file('juego_zip') != null){
                            //Realizamos la validación para ver si es un archivo .ZIP
                            if(Input::file('juego_zip')->getClientOriginalExtension() == 'zip'){
                                //Guardamos el nombre del archivo en la var $log
                                $log = Input::file('juego_zip')->getClientOriginalName();
                                //Preguntamos en una condicional si la carpeta juegosZIP existe
                                if(!file_exists(public_path().'/packages/juegosZIP/'))
                                    $dirTempJuegoZip = mkdir(public_path().'/packages/juegosZIP/');
                                //--Guardamos el destino para guardar el zip del juego
                                $destinoPath = public_path().'/packages/juegosZIP/';
                                //--Guardamos el archivo en la variable $file
                                $file = Input::file('juego_zip');
                                //Movemos el archivo a el $destinoPath
                                $file->move($destinoPath,$log);
                                //--Asignamos a la variable rutaZIP la ruta donde se encuentra el ZIP
                                $rutaZIP = $destinoPath.$log;


                                //---Extraemos el archivo y como parametro recibe la ruta si todo
                                //---se procesa bien dentro de la funcion
                                if($this->extraerArchivo($rutaZIP) == true){

                                    return Response::json(array('message'=>'El juego se ha dado de alta',
                                                                'type' => 'success',
                                                                'archivos' => Session::get('archivos')));
                                }
                                else {
                                    return Response::json(array('message'=>'Ocurrio un error al descoprimir',
                                                                'type' => 'error'));
                                }
                            }
                            else{
                                return Response::json(array('message'=>'El archivo no es un ZIP',
                                                                'type' => 'warning'));
                            }
                        }
                        else{
                             return Response::json(array('message'=>'El archivo esta vacio',
                                                                'type' => 'warning'));
                        }

                }
                 catch(Exception $ex){
                     return Response::json(array(0=>'ERROR: '.$ex));
                 }
        }

    }
    private function extraerArchivo($rutaZIP){
        //Creamos un objeto de la clase ZipArchive()
            $enzipado = new ZipArchive();

        //Abrimos el archivo a descomprimir
            $enzipado->open($rutaZIP);

            if(!file_exists(public_path().'/packages/juegosZIP/Descomprimidos/'))
                $Zipdescompress = mkdir(public_path().'/packages/juegosZIP/Descomprimidos/');
        //Extraemos el contenido del archivo dentro de la carpeta especificada
            $ruta = public_path().'/packages/juegosZIP/Descomprimidos/';
        //--Extraemos el archivo a la ruta destinada
            $extraido = $enzipado->extractTo($ruta);
        //--Crerramos el archivo
            $enzipado->close();
        //---Recorreomos la ruta para validar sus archivos y distribuirlos
            $this->recorrer_ruta($ruta);


        /* Si el archivo se extrajo correctamente listamos los nombres de los
        * archivos que contenia de lo contrario mostramos un mensaje de error
        */

        if($extraido == true){
            return true;
        }
        else{
            return false;
        }

    }
     private function recorrer_ruta($ruta){
       // abrir un directorio y listarlo
        Session::forget('archivos');
        //---Verificamos si la ruta es un dirctorio
       if (is_dir($ruta)) {
           //---Abrimos el directorio
          if ($dh = opendir($ruta)) {
              //---Mientras que el directio sea leeible
             while (($file = readdir($dh)) !== false) {
                //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio
                if (!is_dir($ruta . $file) && $file!="." && $file!=".."){
                   //solo si es un archivo, distinto que "." y ".."
                    //Encontramos su extemsion
                   switch(archivoController::findExtension($file))
                   {
                       case 'css':
                           archivoController::moveFile($ruta.$file,public_path().'/packages/css/curiosity/juegos/'.$file);
                           Session::push('archivos',array('nombre'=>$file,'ruta'=>'/packages/css/curiosity/juegos/'.$file,'tipo'=>'css'));
                        break;
                       case 'js':
                           archivoController::moveFile($ruta.$file,public_path().'/packages/js/curiosity/juegos/'.$file);
                           Session::push('archivos',array('nombre'=>$file,'ruta'=>'/packages/js/curiosity/juegos/'.$file,'tipo'=>'js'));
                        break;
                       case 'php':
                           archivoController::moveFile($ruta.$file,app_path().'/views/juegos/'.$file);
                           Session::push('archivos',array('nombre'=>$file,'ruta'=>'/views/juegos/'.$file,'tipo'=>'php'));
                           $this->regJuego();
                        break;
                       case 'jpeg':
                           archivoController::moveFile($ruta.$file,public_path().'/packages/images/games/'.$file);
                           Session::push('archivos',array('nombre'=>$file,'ruta'=>'/packages/images/games/'.$file,'tipo'=>'jpeg'));
                        break;
                        case 'jpg':
                           archivoController::moveFile($ruta.$file,public_path().'/packages/images/games/'.$file);
                           Session::push('archivos',array('nombre'=>$file,'ruta'=>'/packages/images/games/'.$file,'tipo'=>'jpg'));
                        break;
                         case 'mp3':
                           archivoController::moveFile($ruta.$file,public_path().'/packages/sounds/juegos/'.$file);
                           Session::push('archivos',array('nombre'=>$file,'ruta'=>'/packages/sounds/juegos/'.$file,'tipo'=>'mp3'));
                        break;
                        case 'png':
                           archivoController::moveFile($ruta.$file,public_path().'/packages/images/games/'.$file);
                           Session::push('archivos',array('nombre'=>$file,'ruta'=>'/packages/images/games/'.$file,'tipo'=>'png'));
                        break;
                        case 'gif':
                           archivoController::moveFile($ruta.$file,public_path().'/packages/images/games/'.$file);
                           Session::push('archivos',array('nombre'=>$file,'ruta'=>'/packages/images/games/'.$file,'tipo'=>'gif'));
                        break;
                       default:
                           archivoController::moveFile($ruta.$file,app_path().'/views/juegos/'.$file);
                           Session::push('archivos',array('nombre'=>$file,'ruta'=>'/views/juegos/'.$file,'tipo'=>'php'));
                           $this->regJuego();
                        break;
                   }
                }
             }
            closedir($dh);
          }
       }else
          return  Response::json(array(0=>"<br>No es ruta valida"));
    }
    private function regJuego(){
        $archivos = Session::get('archivos');

        foreach($archivos as $archivo){
            $this->saveArchivo($archivo['nombre'],$archivo['ruta'],$archivo['tipo'],Session::get('idActividad'));
        }
    }
    private function saveArchivo($nombre,$ruta,$tipo,$idJuego){
        $juego_existio = is_null(archivo::where('nombre','=',$nombre)->pluck('id')) ? 0 : archivo::where('nombre','=',$nombre)->pluck('id');
        if($juego_existio == 0){
            $archivo = new archivo();
            $archivo->nombre = $nombre;
            $archivo->ruta = $ruta;
            $archivo->ext = $tipo;
            $archivo->active = 1;
            $archivo->actividad_id = $idJuego;
            $archivo->save();
        }
        else{
            $archivo = archivo::find($juego_existio);
            $archivo->actividad_id = $idJuego;
            $archivo->active = 1;
            $archivo->save();
        }

    }
    public function moveGame(){
        $updated = array('actividad_id'=>Input::get('idActivityNowGame'));
        $col_affect=archivo::where('actividad_id','=',Input::get('idActivityBeforeGame'))->update($updated);
        if($col_affect > 0)
            return Response::json(array('message'=>'success'));
        else
            return Response::json(array('message'=>'error'));

    }
    public function disabledGame(){
        $col_affect = archivo::where('actividad_id','=',Input::get('actividad_id'))->update(array('active'=>'0'));
        if($col_affect > 0)
            return Response::json(array('message'=>'success'));
        else
            return Response::json(array('message'=>'error'));
    }
}



 ?>
