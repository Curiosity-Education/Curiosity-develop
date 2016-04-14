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
        'obj_profesores' => profesor::where('active', '=', 1)
        ->select('id', 'nombre', 'apellido_paterno', 'apellido_materno')
        ->get()
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
        'nombre' => 'required',
        'objetivo' => 'required',
        'code_embed' => 'required',
        'archivoPDF' => 'required',
        'profesores_id' => 'required'
      );

      $messages = [
             "required"    =>  "Este campo :attribute es requerido",
             "alpha"       =>  "Solo puedes ingresar letras",
             "date"        =>  "Formato de fecha invalido",
             "numeric"     =>  "Solo se permiten digitos",
             "email"       =>  "Ingresa un formato de correo valido",
             "unique"      =>  "Este usuario ya existe",
             "integer"     =>  "Solo se permiten numeros enteros",
             "exists"      =>  "El campo :attribute no existe en el sistema",
             "unique"      =>  "El campo :attribute no esta disponible intente con otro valor",
             "integer"     =>  "Solo puedes ingresar numeros enteros",
             "same"        =>  "Las contraseñas no coinciden",
             "after"       =>  "La fecha de expiracion es incorrecta, no puedes ingresar fechas inferiores al día de hoy",
       ];
      // validamos el formulario segun las reglas establecidas
      $validar = Validator::make($formulario, $reglas, $messages);
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
          $objeto->pdf = $file->getClientOriginalName();
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

    $messages = [
           "required"    =>  "Este campo :attribute es requerido",
           "alpha"       =>  "Solo puedes ingresar letras",
           "date"        =>  "Formato de fecha invalido",
           "numeric"     =>  "Solo se permiten digitos",
           "email"       =>  "Ingresa un formato de correo valido",
           "unique"      =>  "Este usuario ya existe",
           "integer"     =>  "Solo se permiten numeros enteros",
           "exists"      =>  "El campo :attribute no existe en el sistema",
           "unique"      =>  "El campo :attribute no esta disponible intente con otro valor",
           "integer"     =>  "Solo puedes ingresar numeros enteros",
           "same"        =>  "Las contraseñas no coinciden",
           "after"       =>  "La fecha de expiracion es incorrecta, no puedes ingresar fechas inferiores al día de hoy",
     ];
    // validamos el formulario segun las reglas
    $validar = Validator::make($formulario, $reglas, $messages);
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
        $vista = archivo::join('actividades', 'archivos.actividad_id', '=', 'actividades.id')
        ->join('videos', 'actividades.id', '=', 'videos.actividad_id')
        ->where('archivos.nombre','=',$nombre.'.blade.php')
        ->where('archivos.actividad_id','=',$idActividad)
        ->where('ext','=','php')
        ->select('archivos.nombre as archivo_nombre', 'actividades.nombre as actividad_nombre', 'actividades.objetivo', 'actividades.pdf', 'videos.code_embed')
        ->get();


        Session::put("idActivity",$idActividad);
        $maxProm = hijoRealizaActividad::where('hijo_id', '=', Auth::user()->pluck('id'))
        ->where('actividad_id', '=', $idActividad)
        ->max('promedio');

            try{
                //----Retornamos la vista del juego
                return View::make('juegos.'.str_replace('.blade.php','',$vista[0]->archivo_nombre), array('datos'=>$vista, 'maxProm' => $maxProm));
            }
            catch(Exception $ex){
                return Redirect::back();
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
                           unlink($ruta.$file);
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

    function getEstadisticasHijo(){
    $formulario = Input::get('data');

    $ids = padre::join('hijos', 'hijos.padre_id', '=' ,'padres.id')
    ->join('personas', 'personas.id', '=', 'hijos.persona_id')
    ->join('users', 'users.id', '=', 'personas.user_id')
    ->where('padres.id', '=', $formulario['id'])
    ->where('users.active', '=', 1)
    ->select('hijos.id')->get();

    $rel_hijo_act = array();
    $idHijo_idAct = array();
    $promedios = array();
    $alertas = array();

    foreach ($ids as $id => $valor) {
      $actividades = hijoRealizaActividad::join('actividades', 'actividades.id', '=', 'hijo_realiza_actividades.actividad_id')
      ->where('hijo_id', '=', $valor['id'])
      ->select('hijo_realiza_actividades.actividad_id', 'actividades.nombre', 'hijo_realiza_actividades.hijo_id')
      ->get();
      array_push($rel_hijo_act, $actividades);
    }

    foreach ($rel_hijo_act as $key => $value) {
      foreach ($value as $key2 => $value2) {
        $flag = true;
        $cont = 0;
        foreach ($idHijo_idAct as $key3 => $value3) {
          $cont++;
        }
        if($cont > 0){
          foreach ($idHijo_idAct as $key4 => $value4) {
            if($value2['hijo_id'] === $value4['hijo_id'] && $value2['actividad_id'] === $value4['actividad_id']){
              $flag = false;
            }
          }
        }

        if($flag === true){
          array_push($idHijo_idAct, array('hijo_id' => $value2['hijo_id'], 'actividad_id' => $value2['actividad_id']));
        }
      }
    }

    foreach ($idHijo_idAct as $key => $value) {
      $datos = hijoRealizaActividad::where('actividad_id', '=', $value['actividad_id'])
      ->where('hijo_id', '=', $value['hijo_id'])->get();

      $sp = 0; // sumatoria de promedios del juego
      $cp = 0; // cantidad de promedios del juego
      foreach ($datos as $dato => $value) {
        // Sumamos uno mas a la cantidad por cada iteración
        $cp++;
        // Sumamos el promedio obtenido a la sumatoria
        // de promedios general para el calculo
        $sp = $sp + $value['promedio'];
      }
      // Calculamos la media dividiendo
      // la suma total de promedios entre
      // la cantidad de promedios registrados
      // en el juego
      $m = ($sp/$cp);

      $usernameHijo = hijo::join('personas', 'personas.id', '=', 'hijos.persona_id')
      ->join('users', 'users.id', '=', 'personas.user_id')
      ->where('hijos.id', '=', $value['hijo_id'])
      ->pluck('username');

      $actividadNombre = actividad::where('id', '=', $value['actividad_id'])->pluck('nombre');

      // añadimos la desviacion estandar calculada
      // al arreglo de promedios por juego segun
      // el hijo
      array_push($promedios, array(
        'usernameHijo' => $usernameHijo,
        'actividadNombre' => $actividadNombre,
        'promedioGral' => $m,
        'actividad_id' => $value['actividad_id'],
        'hijo_id' => $value['hijo_id']
      ));
    }

    foreach ($promedios as $key => $value) {
      $datos = hijoRealizaActividad::where('actividad_id', '=', $value['actividad_id'])->get();
      $sp = 0; // sumatoria de promedios del juego
      $cp = 0; // cantidad de promedios del juego
      foreach ($datos as $dato => $value2) {
        // Sumamos uno mas a la cantidad por cada iteración
        $cp++;
        // Sumamos el promedio obtenido a la sumatoria
        // de promedios general para el calculo
        $sp = $sp + $value2['promedio'];
      }
      // Calculamos la media dividiendo
      // la suma total de promedios entre
      // la cantidad de promedios registrados
      // en el juego
      $m = ($sp/$cp);
      $dpmTotal = 0; // total de diferencias al cuadrado
      foreach ($datos as $dato => $value2) {
        // calculamos la diferencia del promedio
        // a la media por cada promedio del juego
        $dpm = $value2['promedio'] - $m;
        // sumamos al total de distancias de promedios
        // a la media el resultado anterior elevado al
        // cuadrado
        $dpmTotal = $dpmTotal + (pow($dpm, 2));
      }
      // calculamos la media de la suma total de las diferencias
      // de los promedios a la media elevados al cuadrado (Varianza)
      $varianza = $dpmTotal / ($cp);
      // Calculamos la desviacion estandar que se
      // calcula sacando la raiz cuadrada de la
      // varianza calculada
      $desvEst = (Sqrt($varianza));
      if($value['promedioGral'] < ($m - $desvEst)){
        // selecccionamos los archivos que serviran
        // ayuda para el padre cuando su hijo se
        // encuentre debajo de la desviacion estandar
        // en la actividad
        $ayudaPadre = tema::join('actividades', 'actividades.tema_id', '=', 'temas.id')
        ->join('videos', 'videos.actividad_id', '=', 'actividades.id')
        ->where('actividades.id', '=', $value['actividad_id'])
        ->select('actividades.nombre as actividad_nombre', 'pdf', 'code_embed', 'temas.nombre as tema_nombre')
        ->get();
        // añadimos la información de la ayuda al arreglo
        // de ayudas
        array_push($alertas, array(
          'ayuda' => $ayudaPadre,
          'usernameHijo' => $value['usernameHijo'],
          'actividadNombre' => $value['actividadNombre']
        ));
      }
    }
    // verificamos si el arreglo de ayuda se encuentra
    // vacio, esto lo hacemos recorriendolo
    $contAlerta = 0;
    foreach ($alertas as $key) {
      $contAlerta++;
    }

    // si el arreglo se encuentra lleno entonces
    // regresamos el arreglo con las alertas
    if($contAlerta > 0){
      return $alertas;
    }
    // Si el arreglo se encuentra vacio entonces
    // retornamos un objeto JSON con un Succes
    // indicando que todo esta bien
    else{
      return Response::json(array(0=>"success"));
    }
  }

  function getEstandarte(){
      $datos = hijoRealizaActividad::where('actividad_id', '=', Session::get('idActivity'))
      ->where('hijo_id', '=', Auth::user()->persona()->first()->hijo()->pluck('id'))->get();
      $sp = 0; // sumatoria de promedios del juego
      $cp = 0; // cantidad de promedios del juego
      foreach ($datos as $dato => $value) {
        // Sumamos uno mas a la cantidad por cada iteración
        $cp++;
        // Sumamos el promedio obtenido a la sumatoria
        // de promedios general para el calculo
        $sp = $sp + $value['promedio'];
      }
      // Calculamos la media dividiendo
      // la suma total de promedios entre
      // la cantidad de promedios registrados
      // en el juego
      $mediaHijo = ($sp/$cp); // Media (promedio del juego)
      // --------------------------------------------------------
      $datos = hijoRealizaActividad::where('actividad_id', '=', Session::get('idActivity'))->get();

      $sp = 0; // sumatoria de promedios del juego
      $cp = 0; // cantidad de promedios del juego
      foreach ($datos as $dato => $value) {
        // Sumamos uno mas a la cantidad por cada iteración
        $cp++;
        // Sumamos el promedio obtenido a la sumatoria
        // de promedios general para el calculo
        $sp = $sp + $value['promedio'];
      }
      // Calculamos la media dividiendo
      // la suma total de promedios entre
      // la cantidad de promedios registrados
      // en el juego
      $mediaJugo = ($sp/$cp);
      $dpmTotal = 0; // total de diferencias al cuadrado
      foreach ($datos as $dato => $value) {
        // calculamos la diferencia del promedio
        // a la media por cada promedio del juego
        $dpm = $value['promedio'] - $mediaJugo;
        // sumamos al total de distancias de promedios
        // a la media el resultado anterior elevado al
        // cuadrado
        $dpmTotal = $dpmTotal + (pow($dpm, 2));
      }
      // calculamos la media de la suma total de las diferencias
      // de los promedios a la media elevados al cuadrado (Varianza)
      $varianza = $dpmTotal / $cp;
      // Calculamos la desviacion estandar que se
      // calcula sacando la raiz cuadrada de la
      // varianza calculada
      $desviacion = (Sqrt($varianza));

      // Verificamos si el promedio del juego del niño se
      // encuentra dentro de la desviacion estandar,
      // por debajo o bien sobre ella
      $rangoAbajo = ($desviacion - $mediaJugo);
      $rangoArriba = ($desviacion + $mediaJugo);
      if($mediaHijo >= $rangoAbajo && $mediaHijo <= $rangoArriba){
        return Response::json(array(0=>"plata"));
      }
      else if($mediaHijo < $rangoAbajo){
        return Response::json(array(0=>"bronce"));
      }
      else{
        return Response::json(array(0=>"oro"));
      }
    }

    function grafPuntajes(){
      $formulario = Input::get('data');

      $ids = padre::join('hijos', 'hijos.padre_id', '=' ,'padres.id')
      ->join('personas', 'personas.id', '=', 'hijos.persona_id')
      ->join('users', 'users.id', '=', 'personas.user_id')
      ->where('padres.id', '=', $formulario['id'])
      ->where('users.active', '=', 1)
      ->select('hijos.id')->get();

      // $rel_hijo_act = array();
      // $idHijo_idAct = array();
      //
      // foreach ($ids as $id => $valor) {
      //   $actividades = hijoRealizaActividad::join('actividades', 'actividades.id', '=', 'hijo_realiza_actividades.actividad_id')
      //   ->where('hijo_id', '=', $valor['id'])
      //   ->select('hijo_realiza_actividades.actividad_id', 'actividades.nombre', 'hijo_realiza_actividades.hijo_id')
      //   ->get();
      //   array_push($rel_hijo_act, $actividades);
      // }
      $puntajes = array();
      foreach ($ids as $obj => $id){
        $max = hijoRealizaActividad::where('hijo_id', '=', $id['id'])->max('promedio');
        $min = hijoRealizaActividad::where('hijo_id', '=', $id['id'])->min('promedio');
        $actMax = actividad::join('hijo_realiza_actividades', 'hijo_realiza_actividades.actividad_id', '=',       'actividades.id')
                ->where('hijo_realiza_actividades.hijo_id', '=', $id['id'])
                ->where('hijo_realiza_actividades.promedio', '=', $max)
                ->pluck('actividades.nombre');
        $actMin = actividad::join('hijo_realiza_actividades', 'hijo_realiza_actividades.actividad_id', '=',       'actividades.id')
                ->where('hijo_realiza_actividades.hijo_id', '=', $id['id'])
                ->where('hijo_realiza_actividades.promedio', '=', $min)
                ->pluck('actividades.nombre');
        $hijo = hijo::join('personas', 'personas.id', '=', 'hijos.persona_id')
                ->where('hijos.id', '=', $id['id'])
                ->select('personas.nombre', 'personas.apellido_paterno', 'personas.apellido_materno')
                ->get();
        array_push($puntajes, array(
          'hijo' => $hijo[0]['nombre']." ".$hijo[0]['apellido_paterno'],
          'maximo' => $max,
          'minimo' => $min,
          'actMax' => $actMax,
          'actMin' => $actMin
        ));
      }

      return $puntajes;

    }

    public function setDataActivity(){
        try{
          if(Auth::user()->hasRole('hijo')){
            $activida_hijo = new hijoRealizaActividad(Input::all());
            $activida_hijo->hijo_id = Auth::user()->persona()->first()->hijo()->pluck('id');
            $activida_hijo->actividad_id = Session::get('idActivity');
            $activida_hijo->save();
          }
          return Response::json(array("estado"=>"200","message"=>"Juego finalizado"));
        }
        catch(Excetion $ex){
            return Response::json(array("estado"=>"500","message"=>$ex->getMessage()));
        }
    }
}

