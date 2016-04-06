<?php
class userController extends BaseController{

    public function verPagina(){
        if(Request::method() == "GET"){
            $perfil = Auth::User()->perfil()->first();
            $persona = Auth::User()->persona()->first();
            $padre=$persona->padre()->first();
            $estados = estado::all();
            $escuelas = escuela::all();
            if(Auth::user()->hasRole('padre') || Auth::user()->hasRole('root')){
                $idPadre = Auth::user()->persona()->first()->padre()->pluck('id');
                $datosHijos = Padre::join('hijos', 'hijos.padre_id', '=', 'padres.id')
                ->join('personas', 'personas.id', '=', 'hijos.persona_id')
                ->join('users', 'users.id', '=', 'personas.user_id')
                ->join('perfiles', 'perfiles.users_id','=', 'users.id')
                ->where('users.active', '=', '1')
                ->where('hijos.padre_id', '=', $idPadre)
                ->select('hijos.*', 'personas.*', 'users.*', 'perfiles.*')->get();                
                return View::make('vista_perfil')
                ->with(array('perfil' => $perfil, 'persona' => $persona, 'datosHijos' => $datosHijos, 'escuelas'=>$escuelas,"padre"=>$padre,"estados"=>$estados));
            }
            else{
                return View::make('vista_perfil')->with(array('perfil' => $perfil, 'persona' => $persona, 'escuelas'=>$escuelas,"padre"=>$padre,"estados"=>$estados));
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
}
