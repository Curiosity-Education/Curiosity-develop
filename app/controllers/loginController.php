<?php

/**
 *
 */
class loginController extends BaseController
{

  function verPagina()
  {
    if(Request::method() == 'POST')
        {
          /*Guardamos en la variable $Form todos los valores obtenidos*/
          $Form = Input::get('data'); //datos
          /*Creamos la reglas de validacion para esos valores*/
          $Reglas = array(
            'username' => 'required',
            'password' => 'required'
          );
          $mensajes = array(
            'required' => 'Ingresar Contraseña'
          );
          /*Creamos la validación diciendo que datos
          * y como se validarán
          */
          if($Form){
              $Validar  = Validator::make($Form, $Reglas, $mensajes);
              /* Verificamos si los datos fueron validados*/
              if($Validar->fails())
              {
                  /*Retornamos los errores de validación encontrados*/
                 return $Validar->messages();
              }
              else
              {
                /*Creamos el array para enviar los datos
                * a la autentifiacion del usuario*/
                $validarAuth = array(
                    'username'  =>  Input::get('data.username'),
                    'password'  =>  Input::get('data.password'),
                    'active'    =>  1
                );
                  /*Vemos si las credenciales son correctas*/
                  if(Auth::attempt($validarAuth)){
                    /*Guarda la info de la session*/
                    // if(Auth::user()->sesion_info == null){
                    //     $session = new sesionInfo(Input::get('data'));
                    //     $session->users_id = Auth::user()->id;
                    //     $session->device = str_replace(".local","",gethostname());
                    //     $session->save();
                    // }
                    // else{
                    //     $sessionCurrent = sesionInfo::find(Auth::user()->sesion_info->id);
                    //     $sessionCurrent->device = str_replace(".local","",gethostname());
                    //     $sessionCurrent->users_id = Auth::user()->id;
                    //     $sessionCurrent->app_version = Input::get('data.app_version');
                    //     $sessionCurrent->mobile = Input::get('data.mobile');
                    //     $sessionCurrent->browser = Input::get('data.browser');
                    //     $sessionCurrent->save();
                    //
                    // }
                    /*Fin de guardado de sesión*/
                    //Ingresamos un id de session
                    // $idSession = $this->generaidSession();
                    // User::where('id','=',Auth::user()->id)->update(array('id_session'=>$idSession));
                    // Session::put('sessionId',$idSession);
                    if (Auth::user()->hasRole('hijo') || Auth::user()->hasRole('demo_hijo') || Auth::user()->hasRole('hijo_free')){
                      return Response::json(array(0=>'success', 1=>'h'));
                    }
                    else{
                      return Response::json(array(0=>'success', 1=>'o'));
                    }
                  }
                  else{
                    return Response::json(array(0=>'error'));;
                  }
              }
          }
          else{

              //---Este else responderá a Android
              $validarAuth = array(
                    'username'  =>  Input::get('username'),
                    'password'  =>  Input::get('password'),
                    'active'    =>  1
                );
               /*Vemos si las credenciales son correctas*/
                  if(Auth::attempt($validarAuth)){
                    //Ingresamos un id de session
                    if(Auth::user()->hasRole('padre')){
                        try{

                            $idSession = $this->generaidSession();
                            User::where('id','=',Auth::user()->id)->update(array('id_session'=>$idSession));
                            Session::put('sessionId',$idSession);
                            $persona = Auth::user()->persona()->first();
                            $idpadre =Auth::user()->persona()->first()->padre()->first()->id;
                            $email = Auth::User()->persona()->first()->padre()->pluck('email') == null ? "Sin email" : Auth::User()->persona()->first()->padre()->pluck('email');
                            $nombre_completo = $persona->nombre." ".$persona->apellido_paterno." ".$persona->apellido_materno;
                            return Response::json(array("estado"=>"200",
                                                        "message"=>"success",
                                                        "email"=>  $email,
                                                        "username"=>Auth::user()->username,
                                                        "nombre_completo"=>$nombre_completo,
                                                        "padre_id"=>$idpadre

                                                ));
                        }catch(Exception $e){return $e;}
                    }else return Response::json(array("estado"=>"404","message"=>"No eres padre"));

                  }
                  else{
                    return Response::json(array("estado"=>"404","message"=>"No se encontro el usuario"));
                  }
          }
        }
      else{
        // return User::where('users.id', '=', 9)
        // ->join('perfiles', 'users.id', '=', 'perfiles.users_id')
        // ->select('perfiles.foto_perfil')->get();
         // $skin = Skin::where('skin', '=', 'skin-blue')->pluck('id');
         // $usuario = new User();
         // $usuario->username = 'contenido';
         // $usuario->password = Hash::make('12345');
         // $usuario->active = 1;
         // $usuario->token = Hash::make('contenido');
         // $usuario->skin_id = $skin;
         // $usuario->save();
         // $myRole = DB::table('roles')->where('name', '=', 'content manager')->pluck('id');
         // $usuario->attachRole($myRole);
         // $perfil = new Perfil();
         // $perfil->foto_perfil = 'perfil-default.jpg';
         // $perfil->users_id = $usuario->id;
         // $perfil->save();
         // return "se registro al usuario: ".$usuario->username;
         return View::make('vista_login');
      }
    }

    public function salir(){
        Auth::logout();
        return Redirect::to('/');
    }

    public function verificarUsuario(){
      $reglas = array(
        'username' => 'required'
      );
      $Validar  = Validator::make(Input::get('data'), $reglas);
      /* Verificamos si los datos fueron validados*/

      // if($Validar->fails())
      // {
      //   /*Retornamos los errores de validación encontrados*/
      //    return $Validar->messages();
      // }
      // else{
        $Usuario = User::where('username', '=',Input::get('data'))
        ->where('active', '=', 1)
        ->first();
        if($Usuario == ''){
          return Response::json(array(0=>'null'));
        }
        else{
          return $Usuario->perfil()->get();
        }
      // }
    }
    public function loginFB(){
        $validarAuth = array(
            'username' => Input::get('first_name').' '.Input::get('last_name'),
            'password' => Input::get('id')
        );
        /*Vemos si las credenciales son correctas*/
                  if(Auth::attempt($validarAuth)){
                        $idSession = $this->generaidSession();
                        User::where('id','=',Auth::user()->id)->update(array('id_session'=>$idSession));
                        Session::put('sessionId',$idSession);
                        return Response::json(array(0=>'success'));
                  }
                  else{
                     $user = new User();
                        $user->username=Input::get('first_name').' '.Input::get('last_name');
                        $user->password=Hash::make(Input::get('id'));
                        $user->token=sha1(Input::get('email'));
                        $user->active = 1;
                        $user->skin_id=skin::all()->first()->id;
                        $user->save();
                        Session::put('crypt',Crypt::encrypt($user->password));
                        $myRole = DB::table('roles')->where('name', '=', 'padre-fb')->pluck('id');
                        $user->attachRole($myRole);
                        $persona = new persona();
                        $persona->nombre = Input::get('first_name');
                        $persona->apellido_paterno = Input::get('last_name');
                        if(Input::get('gender') == 'male'){
                            $persona->sexo = 'm';
                        }
                        else
                            $persona->sexo = 'f';
                        $persona->user_id=$user->id;
                        $persona->save();
                        // $membresia = new membresia();
                        // $membresia->token_card=sha1($datos_tarjeta["numero_tarjeta"]);
                        // $membresia->fecha_registro= date("Y-m-d");
                        // $membresia->active=1;
                        // $membresia->save();
                        $padre = new padre();
                        $padre->persona_id   = $persona->id;
                        $padre->email = (Input::get('email') == '')?'Sin email':Input::get('email');
                        $padre->save();
                        $perfil = new perfil();
                        $perfil->foto_perfil=Input::get('picture')['data']['url'];
                        $perfil->gustos="¿Cuáles son tus gustos?";
                        $perfil->users_id=$user->id;
                        $perfil->save();
                        $idSession = $this->generaidSession();
                            if(Auth::attempt($validarAuth)){
                            $idSession = $this->generaidSession();
                            User::where('id','=',Auth::user()->id)->update(array('id_session'=>$idSession));
                            Session::put('sessionId',$idSession);
                            return Response::json(array(0=>'success'));
                      }
                  }
    }
    public function recuperarCont($token = null){
        if($token == null){
            if(Request::method() == "GET")
                return View::make("vista_recuperacion_de_contrasena");
            else{
                $user = User::join('personas','personas.user_id','=','users.id')
                        ->join('padres','padres.persona_id','=','personas.id')
                        ->where('email','=',Input::get('email'))->select(DB::raw("personas.nombre,personas.apellido_paterno,users.id as 'id', padres.email as 'email'"))->get();


                if(!empty($user[0])){
                    $token = md5($user[0]->email);
                    $usuario = User::find($user[0]->id);
                    $usuario->token = $token;
                    $usuario->save();
                      $dataSend = [
                          "name"     =>       "Equipo Curiosity",
                          "client"   =>       $user[0]->nombre." ".$user[0]->apellido_paterno,
                          "email"    =>       $user[0]->email,
                          "subject"  =>       "Recuperar Contraseña",
                          "token"    =>       $token
                      ];
                      $toEmail=$user[0]->email;
                      $toName=$dataSend["email"];
                      $subject =$dataSend["subject"];
                      try {
                          Mail::send('emails.recuperar_password',$dataSend,function($message) use($toEmail,$toName,$subject){
                              $message->to($toEmail,$toName)->subject($subject);
                          });

                      } catch (Exception $e) {
                          $code = $e->getCode();
                          return $e;
                      }
                    return Response::json(array('status'=>'200','message'=>"Se ha enviado un link de recuperación a su correo",'data'=>$user));
                }
                else{
                    return Response::json(array('status'=>'404','message'=>"El correo nunca se ha utilzado para una cuenta Curiosity. Porfavor ingresa el correo con el que te registraste"));
                }
            }
        }
        else{
            if(Request::method() == "GET"){
                if(User::where('token','=',$token)->get()){
                    Session::put('token_change_curiosity',$token);
                    return View::make('vista_cambiar_pass');
                }
                else{
                    return View::make("view-error404");
                }
            }
            else{
                if($token == "d4t4p4r4c4mbi0d3p45word"){
                   try{
                       $user = User::where('token','=',Session::get('token_change_curiosity'))->get();
                       User::find($user[0]->id)->update(array('password'=>Hash::make(Input::get('newPass'))));

                       return Response::json(array('status'=>'200','message'=>'La contraseña ha sido cambiada'));
                   }
                   catch(Exception $e){
                       return Response::json(array('status'=>$e->getCode(),'message'=>Response::json($e)));
                   }
                }
            }
        }
    }
    private function generaidSession(){
		$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

		$longitudCadena=strlen($cadena);


		$folio = "";
		$longitudFolio=10;

		for($i=1 ; $i<=$longitudFolio ; $i++){
			$pos=rand(0,$longitudCadena-1);

			$folio .= substr($cadena,$pos,1);
		}
		return $folio;
	}

}
