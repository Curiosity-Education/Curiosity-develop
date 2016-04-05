<?php


/**
 *
 */
class temaController extends BaseController
{
  function verPagina($id, $idInt, $idNivel){
    if(Request::method()=="GET"){
      // buscamos si el id de inteligencia que paso como parametro
      // existe y si es asi si este se encuentra activo
      $activo = bloque::where('id', '=', $id)->pluck('active');
      if($activo === 1){
        // creamos un objeto de tipo array asociativo el
        // cual contiene una coleccion de datos de los bloques y
        // de los tipos de inteligencia que se encuentran activos, asi como el id
        // que se ha pasado como parametro el cual indica de cual inteligencia
        // pertenece toda la informacion que se va a mostrar al usuario
        $obj_temas= array('obj_temas' => tema::where('active', '=', '1')
        ->where('bloque_id', '=', $id)
        ->select('id', 'nombre', 'descripcion', 'estatus', 'bg_color', 'bloque_id', 'imagen')
        ->get(),
        'obj_bloque' => bloque::where('id', '=', $id)
        ->select('id', 'nombre')->get(),
        'obj_inteligencia' => inteligencia::where('id', '=', $idInt)
        ->select('id', 'nombre')->get(),
        'obj_nivel' => nivel::where('id', '=', $idNivel)
        ->select('id', 'nombre')->get()
        );
        // regresamos la vista junto con el arreglo recien creado
        return View::make('vista_temas_admin', $obj_temas);
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
      $formulario = Input::get('data');
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
        $nombre = tema::where('bloque_id', '=', $formulario['bloque_id'])->select('nombre')->get();
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
          $objeto = new tema($formulario);
          $objeto->imagen = "default.png";
          $objeto->save();
          $tema = tema::where('temas.id', '=', $objeto->id)
            ->join('bloques', 'bloques.id', '=', 'temas.bloque_id')
            ->join('inteligencias', 'inteligencias.id', '=', 'bloques.inteligencia_id')
            ->join('niveles', 'niveles.id', '=', 'inteligencias.nivel_id')
            ->select('temas.id', 'temas.nombre', 'temas.descripcion', 'temas.bg_color', 'temas.active', 'temas.estatus', 'temas.imagen', 'temas.bloque_id', 'niveles.id as nivel_id', 'inteligencias.id as inteligencia_id')
            ->get();
          return Response::json(array(0=>"success", 1=>$tema));
        }
        else{
          $estaActivo = tema::where('nombre', '=', $formulario['nombre'])
          ->where('bloque_id', '=', $formulario['bloque_id'])
          ->pluck('active');
          if($estaActivo === 0){
            // Si el nombre ya existe en la base de datos
            // y se encuantra inactivo segun el id de inteligencia
            // lo volvemos a activar cambiando el active a 1
            // segun el nombre
            tema::where('nombre', '=', $formulario['nombre'])
            ->where('bloque_id', '=', $formulario['bloque_id'])
            ->update(array(
              'active' => 1,
              'imagen' => 'default.png',
              'descripcion' => $formulario['descripcion']
              ));
            $tema = tema::where('temas.nombre', '=', $formulario['nombre'])
            ->join('bloques', 'bloques.id', '=', 'temas.bloque_id')
            ->join('inteligencias', 'inteligencias.id', '=', 'bloques.inteligencia_id')
            ->join('niveles', 'niveles.id', '=', 'inteligencias.nivel_id')
            ->select('temas.id', 'temas.nombre', 'temas.descripcion', 'temas.bg_color', 'temas.active', 'temas.estatus', 'temas.imagen', 'temas.bloque_id', 'niveles.id as nivel_id', 'inteligencias.id as inteligencia_id')
            ->get();
            return  Response::json(array(0=>"success_exist", 1=>$tema));
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
    $formulario = Input::get('data');
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
      $objetosDB = tema::where('id', '=', $formulario['idUpdate'])->get();
      if($objetosDB[0]['nombre'] === $formulario['nombre']){
        // si el nombre existe en la BD no se actualiza el nombre
        // unicamente la descripcion y el estatus del mismo
        tema::where('id', '=', $formulario['idUpdate'])->update(array(
          'descripcion' => $formulario['descripcion'],
          'estatus' => $formulario['estatus']
        ));
        return Response::json(array(0=>"success"));
      }
      else{
        // si el nombre no es el mismo que el que proviene de la BD segun
        // el id enviado se busca ahora si el nombre del formulario
        // existe en la base de datos independientemente del id que se tenga
        // como referencia. es decir se busca en toda la DB
        $existe = 'no';
        $nombres = tema::where('bloque_id', '=', $formulario['procedenciaID'])
        ->select('nombre')->get();
        foreach ($nombres as $name) {
          if($name['nombre'] === $formulario['nombre']){
            $existe = 'si';
          }
        }
        if($existe === 'no'){
          tema::where('id', '=', $formulario['idUpdate'])->update(array(
            'nombre' => $formulario['nombre'],
            'descripcion' => $formulario['descripcion'],
            'estatus' => $formulario['estatus']
          ));
          return Response::json(array(0=>"success"));
        }
        else{
          // si el nombre existe
          $nombreActivo = tema::where('bloque_id', '=', $formulario['procedenciaID'])
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
    tema::where('id', '=', $id)->update(array(
      'active' => 0
    ));
    return Response::json(array(0=>'success'));
  }

  function verPaginaInWeb($id){
    // consultamos en la base de datos todos los tipos
    // de inteligencia que se encuentren
    // activos obteniendo la informacion necesaria dependiendo del nivel
    $objetos = array('objetos' => tema::join('bloques', 'bloques.id', '=', 'temas.bloque_id')
      ->join('inteligencias', 'inteligencias.id', '=', 'bloques.inteligencia_id')
      ->join('niveles', 'niveles.id', '=', 'inteligencias.nivel_id')
      ->where('bloques.id', '=', $id)
      ->where('temas.active', '=', 1)
      ->select('temas.id', 'temas.nombre', 'temas.descripcion', 'temas.estatus', 'temas.bg_color', 'temas.imagen', 'inteligencias.id as inteligencia_id', 'inteligencias.nombre as inteligencia_nombre', 'niveles.id as nivel_id', 'niveles.nombre as nivel_nombre', 'bloques.id as bloque_id', 'bloques.nombre as bloque_nombre')
      ->get()
    );

    $objectBelive = bloque::where('id', '=', $id)->pluck('estatus');

    $existe = tema::join('bloques', 'bloques.id', '=', 'temas.bloque_id')
    ->where('bloques.id', '=', $id)->select('temas.id')->first();

    if($objectBelive === "unlock"){
      if($existe != null){
        return View::make('vista_temas', $objetos);
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
      $destinoPath = public_path()."/packages/images/temas/";
      $file = $image;
      $file->move($destinoPath, $file->getClientOriginalName());
      tema::where('id', '=', $id)->update(array(
        'imagen' => $file->getClientOriginalName()
      ));
      return Response::json(array(0=>'success', 1=>$file->getClientOriginalName()));
    }
  }
}



 ?>
