<?php
class userController extends BaseController{

    public function verPagina(){
        if(Request::method() == "GET"){
            $perfil = Auth::User()->perfil()->first();
            $persona = Auth::User()->persona()->first();
            $padre=$persona->padre()->first();
            $estados = estado::all();
            //return $persona;
            $escuelas = escuela::all();
            return View::make('vista_perfil')->with(array('perfil' => $perfil, 'persona' => $persona, 'escuelas'=>$escuelas,"padre"=>$padre,"estados"=>$estados));
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
