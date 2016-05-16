<?php
class hijoController extends BaseController{

	public function addHijo(){
		$datos = Input::get('data');
		$dateNow = date("Y-m-d");
        $date_min =strtotime("-4 year",strtotime($dateNow));
        $date_min=date("Y-m-d",$date_min);
		$rules=[
			"username_hijo"     =>"required|unique:users,username|max:50",
            "password"          =>"required|min:8|max:100",
            "cpassword"         =>"required|same:password",
            "nombre"            =>"required|letter|max:50",
            "apellido_paterno"  =>"required|letter|max:30",
            "apellido_materno"  =>"required|letter|max:30",
            "sexo"              =>"required|string|size:1",
            "fecha_nacimiento"  =>"required|date_format:Y-m-d|before:$date_min",
            "esc_lat"           =>"max:200",
            "promedio"			=>"required",
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
        $validaciones = Validator::make($datos,$rules,$messages);
        if($validaciones->fails()){
            return $validaciones->messages();
        }else{


            if($datos["escuela_id"]=="" || $datos["escuela_id"]=="NULL"){
                unset($datos["escuela_id"]);
            }
            $membresia_plan = new membresiaPlan();
            $user = new User();
            $user->username=$datos["username_hijo"];
            $user->password=Hash::make($datos["password"]);
            $user->token=sha1($datos["username_hijo"]);
            $user->skin_id=skin::all()->first()->id;
            $user->active=1;
            $user->save();
            $myRole = DB::table('roles')->where('name', '=', 'hijo')->pluck('id');
            $user->attachRole($myRole);
            $perfil = new perfil();
            $perfil->foto_perfil="perfil-default.jpg";
            $perfil->users_id=$user->id;
            $perfil->save();
            $persona = new persona($datos);
            $persona->user_id=$user->id;
            $persona->save();
            $hijo = new hijo($datos);
            $hijo->persona_id=$persona->id;
            $padre_id = Auth::user()->persona()->first()->padre()->first()->id;
            $hijo->padre_id=$padre_id;
            $hijo->save();
            $membresia = Auth::user()->persona()->first()->padre()->first()->membresia()->first();
            $membresia_plan->membresia_id=$membresia->id;
            $plan = plan::where("name","=","1 Hijo")->first();
            $membresia_plan->plan_id=$plan->id;
            $membresia_plan->hijo_id=$hijo->id;
            $membresia_plan->save();
        	return "OK";

        }
	}
    public function recordatorio(){
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        $id=User::where('username','=',Auth::user()->username)->join('personas','personas.user_id','=','users.id')->join('hijos','hijos.persona_id','=','personas.id')->select('hijos.id')->get()[0]->id;
        $data = DB::select("Select r_h.id, r_h.mensaje,perfiles.foto_perfil from recordatorios_hijos as r_h
inner join padres on padres.id = r_h.padre_avisa inner join personas on
personas.id = padres.persona_id inner join users on personas.user_id = users.id
inner join perfiles on perfiles.users_id = users.id  where r_h.hijo_recuerda = ".$id." and r_h.is_read=0");
        
        recordatorioHijo::where('hijo_recuerda','=',$id)->update(array('is_read'=>'1'));
        echo "data: ".json_encode($data)."\n\n";
      
        flush();
    }
}