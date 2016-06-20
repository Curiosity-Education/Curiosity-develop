<?php
class userController extends BaseController{

    public function verPagina(){
        if(Request::method() == "GET"){
            $perfil = Auth::User()->perfil()->first();
            $persona = Auth::User()->persona()->first();
            $padre=$persona->padre()->first();
            $estados = estado::all();
            $escuelas = escuela::where('active', '=', '1')->get();
            $idAuth = Auth::user()->id;
            $rol = User::join('assigned_roles', 'users.id', '=', 'assigned_roles.user_id')
            ->join('roles', 'assigned_roles.role_id', '=', 'roles.id')
            ->where('users.id', '=', Auth::user()->id)
            ->pluck('name');
            if(Auth::user()->hasRole('padre') || Auth::user()->hasRole('root') || Auth::user()->hasRole('demo_padre') || Auth::user()->hasRole('padre_free')){
                $idPadre = Auth::user()->persona()->first()->padre()->pluck('id');
                $datosHijos = Padre::join('hijos', 'hijos.padre_id', '=', 'padres.id')
                ->join('personas', 'personas.id', '=', 'hijos.persona_id')
                ->join('users', 'users.id', '=', 'personas.user_id')
                ->join('perfiles', 'perfiles.users_id','=', 'users.id')
                ->where('users.active', '=', '1')
                ->where('hijos.padre_id', '=', $idPadre)
                ->select('hijos.*', 'personas.*', 'users.*', 'perfiles.*')->get();
                return View::make('vista_perfil')
                ->with(array('perfil' => $perfil, 'persona' => $persona, 'datosHijos' => $datosHijos, 'escuelas'=>$escuelas,"padre"=>$padre,"estados"=>$estados, 'rol'=>$rol));
            }
            else{
                return View::make('vista_perfil')->with(array('perfil' => $perfil, 'persona' => $persona, 'escuelas'=>$escuelas,"padre"=>$padre,"estados"=>$estados, 'rol'=>$rol));
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
}
