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
            "promedio"				=>"required",
            "grado_inicial"			=>"required"
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
			$padreRole = Auth::user()->roles[0]->name;
            $user = new User();
            $user->username=$datos["username_hijo"];
            $user->password=Hash::make($datos["password"]);
            $user->token=sha1($datos["username_hijo"]);
            $user->skin_id=skin::where('skin', '=', 'skin-blue')->pluck('id');
            $user->active=1;
            $user->save();
                if($padreRole == "padre"){
                    $myRole = DB::table('roles')->where('name', '=', 'hijo')->pluck('id');
                }
                else if ($padreRole == "padre_free"){
                    $myRole = DB::table('roles')->where('name', '=', 'hijo')->pluck('id');
                }
                else if ($padreRole == "demo_padre"){
                    $myRole = DB::table('roles')->where('name', '=', 'demo_hijo')->pluck('id');
                }
            $user->attachRole($myRole);
            $perfil = new perfil();
                if ($datos['sexo'] == 'm'){
                    $perfil->foto_perfil = "boy-def.png";
                }
                else{
                    $perfil->foto_perfil = "girl-def.png";
                }
            $perfil->users_id = $user->id;
            $perfil->save();
            $persona = new persona($datos);
            $persona->user_id = $user->id;
            $persona->save();
            $hijo = new hijo();
            $hijo->persona_id = $persona->id;
            $padre_id = Auth::user()->persona()->first()->padre()->first()->id;
            $hijo->padre_id = $padre_id;
            $hijo->save();
            DB::table('escolaridades')->insert(array(
                'grado' => $datos['grado_inicial'],
                'promedio' => $datos['promedio'],
                'hijo_id' => $hijo->id
            ));
            $avance = DB::table('hijos_metas_diarias')->insert(array(
                'hijo_id' => $hijo->id,
                'meta_diaria_id' => DB::table('metas_diarias')->where('nombre', '=', 'Normal')->pluck('id')
            ));
            $exp = DB::table('hijo_experiencia')->insert(array(
                'hijo_id' => $hijo->id,
                'cantidad_exp' => 0,
                'coins' => 0
            ));
            if ($padreRole == "padre" || $padreRole == "padre_free"){
                $membresia_plan = new membresiaPlan();
                $membresia = new membresia(array(
                    "token_card" => Session::get('sub_id'),
                    "fecha_registro" => Date('Y-m-d'),
                    "active"    => 1,
                    "padre_id"  => $padre_id
                ));
                $membresia->save(); 
                $membresia_plan->membresia_id=$membresia->id;
                $plan = plan::where("name","=","1 Hijo")->first();
                $membresia_plan->plan_id=$plan->id;
                $membresia_plan->hijo_id=$hijo->id;
                $membresia_plan->active=1;
                $membresia_plan->save();
            }
            return Response::json(array("OK", $perfil->foto_perfil));
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

		public function changeMeta(){
			$idMeta = Input::get('data');
			$idHijo = Auth::User()->persona()->first()->hijo()->pluck('id');

			DB::table('hijos_metas_diarias')
			->where('hijo_id', '=', $idHijo)
			->update(array(
				'meta_diaria_id' => $idMeta
			));

			return $this->getMeta($idHijo);
		}

        public function getMeta($idHijo){
            $now = date("Y-m-d");
            $miMeta = DB::table('metas_diarias')
            ->join('hijos_metas_diarias', 'hijos_metas_diarias.meta_diaria_id', '=', 'metas_diarias.id')
            ->where('hijos_metas_diarias.hijo_id', '=', $idHijo)
            ->select('metas_diarias.*', 'hijos_metas_diarias.id as metaAsignedId')
            ->first();
            $idAvance = $miMeta->metaAsignedId;
            $avanceMeta = DB::table('avances_metas')
            ->where('fecha', '=', $now)
            ->where('avance_id', '=', $idAvance)
            ->pluck('avance');

              // --- Calculo del avance en porcenaje de la meta del hijo
              $porcAvanceMeta = round(($avanceMeta * 100) / $miMeta->meta);
              if ($porcAvanceMeta > 100) { $porcAvanceMeta = 100; }

              // --- Calculo de cuanto falta para cumplir la meta diaria
              $faltanteMeta = $miMeta->meta - $avanceMeta;
              if ($faltanteMeta < 0) { $faltanteMeta = 0; }

			$row = array(
				"miMeta" => $miMeta,
				"porcAvanceMeta" => $porcAvanceMeta,
				'avanceMeta' => $avanceMeta,
				'faltanteMeta' => $faltanteMeta
			);

			return $row;
        }


		function info(){
			$rol = Auth::user()->roles[0]->name;
			$idPadre = Auth::user()->persona()->first()->padre()->pluck('id');
			$datosHijos = Padre::join('hijos', 'hijos.padre_id', '=', 'padres.id')
			->join('personas', 'personas.id', '=', 'hijos.persona_id')
			->join('users', 'users.id', '=', 'personas.user_id')
			->join('perfiles', 'perfiles.users_id','=', 'users.id')
			->where('users.active', '=', '1')
			->where('hijos.padre_id', '=', $idPadre)
			->select('hijos.*', 'personas.*', 'users.id', 'perfiles.*')->get();
			return View::make('vista_papa_misHijos')->with(array('rol' => $rol, 'datosHijos' => $datosHijos));
		}

		function asignAvatar(){
			$av = Input::get('data');
			$myId = Auth::User()->persona()->first()->hijo()->pluck('id');
			DB::table('hijos_avatars')->insert(array(
				'hijo_id' => $myId,
				'avatar_id' => $av
			));
			$us = Auth::user();
			$us->flag = 0;
			$us->save();
			return Response::json(array(0=>"success"));
		}

    function desgloceJuegos($idHijo){
            $now = date("Y-m-d");
            return DB::select("SELECT
            t_jugados.nombre as 'name',t_jugados.t_jugados_act as 'total' , (t_jugados.t_jugados_act * 100 /t_sum_juegos.total_jugados) as 'y', t_jugados.promedio
            FROM
            (
                SELECT
                actividades.nombre,count(actividades.id) as 't_jugados_act',AVG(hijo_realiza_actividades.promedio) as 'promedio'
                FROM
                hijo_realiza_actividades
                inner join
                actividades
                on
                hijo_realiza_actividades.actividad_id = actividades.id
                where
                hijo_realiza_actividades.hijo_id = $idHijo and hijo_realiza_actividades.created_at between  '$now 00:00:00' and '$now 23:59:59'
                group by(actividades.nombre)
            )
            as t_jugados,
            (
                SELECT
                    count(actividades.id) as 'total_jugados'
                FROM
                    hijo_realiza_actividades
                inner join
                    actividades on hijo_realiza_actividades.actividad_id = actividades.id
                where
                    hijo_realiza_actividades.hijo_id = $idHijo and hijo_realiza_actividades.created_at between  '$now 00:00:00' and '$now 23:59:59'
                group by(hijo_realiza_actividades.hijo_id)
            )
            as t_sum_juegos");
    }

}
