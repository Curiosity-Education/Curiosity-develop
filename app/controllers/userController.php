<?php
class userController extends BaseController{

    public function verPagina(){
        if(Request::method() == "GET"){
          if (Auth::user()->hasRole('padre_free') ||          
          Auth::user()->hasRole('hijo_free'))
          {
            Auth::logout();
            return Redirect::to('/proximamente');
          }
          else{
            $perfil = Auth::User()->perfil()->first();
            $persona = Auth::User()->persona()->first();
            $padre=$persona->padre()->first();
            $estados = estado::all();
            $escuelas = escuela::where('active', '=', '1')->get();
            $idAuth = Auth::user()->id;
            $rol = Auth::user()->roles[0]->name;
          if(Auth::user()->hasRole('padre') || Auth::user()->hasRole('padre_free') || Auth::user()->hasRole('demo_padre')){
              $juegos = archivo::join('actividades', 'actividades.id', '=', 'archivos.actividad_id')
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
              $idPadre = Auth::user()->persona()->first()->padre()->pluck('id');
              $datosHijos = Padre::join('hijos', 'hijos.padre_id', '=', 'padres.id')
              ->join('personas', 'personas.id', '=', 'hijos.persona_id')
              ->join('users', 'users.id', '=', 'personas.user_id')
              ->join('perfiles', 'perfiles.users_id','=', 'users.id')
              ->where('users.active', '=', '1')
              ->where('hijos.padre_id', '=', $idPadre)
              ->select('hijos.*', 'personas.*', 'users.*', 'perfiles.*')->get();
              return View::make('vista_papa_inicio')->with(array('datosHijos' => $datosHijos, 'juegos' => $juegos));
            }
            else if (Auth::user()->hasRole('hijo') || Auth::user()->hasRole('hijo_free') || Auth::user()->hasRole('demo_hijo')){
              // Si el hijo es la primera vez en iniciar sesion
              // le mostramos una vista en la cual seleccionará su avatar
              if(Auth::user()->flag == 1){
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
                $idHijo = Auth::User()->persona()->first()->hijo()->pluck('id');

                // --- Verificamos la fecha para la meta diaria del hijo
                // --- Si es la primera vez del dia en la que ha iniciado sesión
                // --- se hace el registro de la fecha actual del servidor y se establece
                // --- su avance en cero (0) ya que no ha jugado nada en el dia
                $now = date("Y-m-d");
                $isFirst = DB::table('avances_metas')
                ->join('hijos_metas_diarias', 'hijos_metas_diarias.id', '=', 'avances_metas.avance_id')
                ->where('hijos_metas_diarias.hijo_id', '=', $idHijo)
                ->where('avances_metas.fecha', '=', $now)
                ->pluck('avances_metas.id');
                $idAvance = DB::table('hijos_metas_diarias')
                ->where('hijo_id', '=', $idHijo)
                ->pluck('id');
                if ($isFirst == ""){
                  $avance = DB::table('avances_metas')->insert(array(
                    'avance' => 0,
                    'fecha' => $now,
                    'avance_id' => $idAvance
                  ));
                }

                $avanceMeta = DB::table('avances_metas')->where('fecha', '=', $now)->pluck('avance');
                $metas = DB::table('metas_diarias')->get();
                $miMeta = DB::table('metas_diarias')
                ->join('hijos_metas_diarias', 'hijos_metas_diarias.meta_diaria_id', '=', 'metas_diarias.id')
                ->where('hijos_metas_diarias.hijo_id', '=', $idHijo)
                ->select('metas_diarias.*')
                ->first();
                $experiencia = DB::table('hijo_experiencia')->where('hijo_id', '=', $idHijo)->first();
                $coins = $experiencia->coins;

                // --- Calculo del avance en porcenaje de la meta del hijo
                $porcAvanceMeta = round(($avanceMeta * 100) / $miMeta->meta);
                if ($porcAvanceMeta > 100) { $porcAvanceMeta = 100; }

                // --- Calculo de cuanto falta para cumplir la meta diaria
                $faltanteMeta = $miMeta->meta - $avanceMeta;
                if ($faltanteMeta < 0) { $faltanteMeta = 0; }

                $avatar = DB::table('hijos_avatars')
                ->join('avatars_estilos', 'hijos_avatars.avatar_id', '=', 'avatars_estilos.id')
                ->join('secuencias', 'avatars_estilos.id', '=', 'secuencias.avatar_estilo_id')
                ->join('tipos_secuencias', 'secuencias.tipo_secuencia_id', '=', 'tipos_secuencias.id')
                ->where('hijos_avatars.hijo_id', '=', $idHijo)
                ->where('tipos_secuencias.nombre', '=', 'esperar')
                ->select('secuencias.sprite', 'avatars_estilos.avatars_id')
                ->first();
                $nombreAvatar = DB::table('avatars')->where('id', '=', $avatar->avatars_id)->pluck('nombre');

                return View::make('vista_hijo_inicio')
                ->with(array(
                  'experiencia' => $experiencia,
                  'avatar' => $avatar,
                  'metas' => $metas,
                  'miMeta' => $miMeta,
                  'porcAvanceMeta' => $porcAvanceMeta,
                  'avanceMeta' => $avanceMeta,
                  'faltanteMeta' => $faltanteMeta,
                  'coins' => $coins,
                  'nombreAvatar' => $nombreAvatar
                ));
              }
            }
            else{
                return View::make('vista_perfil')->with(array('perfil' => $perfil, 'persona' => $persona, 'rol'=>$rol));
            }
          }
        }

    }

    public function remoteUsernameHijo(){
        if(User::where("username","=",Input::get('username_hijo'))->first()){
            return "false";
        }else{
         return "true";
        }
    }
    public function remoteUsername(){
    	if(User::where("username","=",Input::get('username'))->first()){
    		return "false";
    	}else{
    	 return "true";
    	}
    }
    public function remoteUsernameAdmin(){
        if(User::where("username","=",Input::get('username_admin'))->first()){
            return "false";
        }else{
         return "true";
        }
    }
    public function remoteUsernameUpdate(){
        if(DB::table("users")->where("username","=",Input::get('username_persona'))->where("username","!=",Auth::user()->username)->get()){
            return "false";
        }else return "true";
    }
    public function remotePasswordUpdate(){
        if(Hash::check(Input::get('password_now'),Auth::user()->password)){
            return "true";
        }else return "false";
    }
    public function saveAdmin(){
        $dateNow = date("Y-m-d");
        $date_min =strtotime("-18 year",strtotime($dateNow));
        $date_min=date("Y-m-d",$date_min);
        $rules=[
            "username_admin"          =>"required|unique:users,username|max:50",
            "password_admin"          =>"required|min:8|max:100",
            "cpassword_admin"         =>"required|same:password_admin",
            "nombre_admin"            =>"required|letter|max:50",
            "apellido_paterno_admin"  =>"required|letter|max:30",
            "apellido_materno_admin"  =>"required|letter|max:30",
            "sexo_admin"              =>"required|string|size:1",
            "fecha_nacimiento_admin"  =>"required|date_format:Y-m-d|before:$date_min",
            "role_admin"              =>"required"

        ];
        $messages = [
                     "required"    =>  "Este campo :attribute es requerido",
                     "alpha"       =>  "Solo puedes ingresar letras",
                     "before"      =>  "La fecha que ingresaste tiene que ser menor al $date_min",
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
        $validaciones = Validator::make(Input::all(),$rules,$messages);
        if($validaciones->fails()){
            return $validaciones->messages();
        }else{
            try {
                $user = new User();
                $user->username=Input::get('username_admin');
                $user->password=Hash::make(Input::get('password_admin'));
                $user->active=1;
                $user->token= sha1($user->username);
                $user->skin_id=skin::all()->first()->id;
                $user->save();
                $user->attachRole(Input::get('role_admin'));
                $persona = new persona();
                $persona->nombre = Input::get('nombre_admin');
                $persona->apellido_paterno = Input::get('apellido_paterno_admin');
                $persona->apellido_materno = Input::get('apellido_materno_admin');
                $persona->sexo = Input::get('sexo_admin');
                $persona->fecha_nacimiento = Input::get('fecha_nacimiento_admin');
                $persona->user_id = $user->id;
                $persona->save();
                $perfil = new perfil();
                $perfil->foto_perfil="perfil-default.jpg";
                $perfil->users_id=$user->id;
                $perfil->save();
                return Response::json(array("estado"=>200,"message"=>"El usuario ha sido registrado exitosamente"));

            }catch (Exception $e) {
                return Response::json(array("estado"=>500,"message"=>$e));
            }
        }

    }


  //   private function inicioPapa(){
	// 	if(Request::method() == "GET"){
  //           $perfil = Auth::User()->perfil()->first();
  //           $persona = Auth::User()->persona()->first();
  //           $padre=$persona->padre()->first();
  //           $estados = estado::all();
  //           $escuelas = escuela::where('active', '=', '1')->get();
  //           $idAuth = Auth::user()->id;
  //           $rol = User::join('assigned_roles', 'users.id', '=', 'assigned_roles.user_id')
  //           ->join('roles', 'assigned_roles.role_id', '=', 'roles.id')
  //           ->where('users.id', '=', Auth::user()->id)
  //           ->pluck('name');
  //           if(Auth::user()->hasRole('padre') || Auth::user()->hasRole('root') || Auth::user()->hasRole('demo_padre')){
  //               $idPadre = Auth::user()->persona()->first()->padre()->pluck('id');
  //               $datosHijos = Padre::join('hijos', 'hijos.padre_id', '=', 'padres.id')
  //               ->join('personas', 'personas.id', '=', 'hijos.persona_id')
  //               ->join('users', 'users.id', '=', 'personas.user_id')
  //               ->join('perfiles', 'perfiles.users_id','=', 'users.id')
  //               ->where('users.active', '=', '1')
  //               ->where('hijos.padre_id', '=', $idPadre)
  //               ->select('hijos.*', 'personas.*', 'users.*', 'perfiles.*')->get();
  //               return View::make('vista_papa_inicio')
  //               ->with(array('perfil' => $perfil, 'persona' => $persona, 'datosHijos' => $datosHijos, 'escuelas'=>$escuelas,"padre"=>$padre,"estados"=>$estados, 'rol'=>$rol));
  //           }
  //           else{
  //               return View::make('vista_papa_inicio')->with(array('perfil' => $perfil, 'persona' => $persona, 'escuelas'=>$escuelas,"padre"=>$padre,"estados"=>$estados, 'rol'=>$rol));
  //           }
  //       }
	// }
}
