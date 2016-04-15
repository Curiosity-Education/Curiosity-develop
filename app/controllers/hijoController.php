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
}
