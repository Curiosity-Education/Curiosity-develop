<?php
class padreController extends BaseController
{
    public function remoteEmail(){
        if(padre::where("email","=",Input::get("email"))->first())
            return "false";
        else return "true";
    }

    public function addPadre(){
        $datos = Input::get('data');
        $dateNow = date("Y-m-d");
        $date_min =strtotime("-18 year",strtotime($dateNow));
        $date_min=date("Y-m-d",$date_min);
        $hoy= date("Y-m-d");
        // $datos_tarjeta = array(
        //     "tarjetahabiente"   =>Input::get("tarjetahabiente"),
        //     "numero_tarjeta"    =>Input::get("numero_tarjeta"),
        //     "cvc"               =>Input::get("cvc"),
        //     "fecha_expiracion"  =>Input::get("fecha_expiracion")
        // );
        $rules = [
            "username"          =>"required|unique:users,username|max:50",
            "password"          =>"required|min:8|max:100",
            "cpassword"         =>"required|same:password",
            "nombre"            =>"required|letter|max:50",
            "apellido_paterno"  =>"required|letter|max:30",
            "apellido_materno"  =>"required|letter|max:30",
            "sexo"              =>"required|string|size:1",
            "fecha_nacimiento"  =>"required|date_format:Y-m-d|before:$date_min",
            "email"             =>"required|email|unique:padres,email"

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
        try {
         $validator = Validator::make($datos,$rules,$messages);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        if($validator->fails()){
            return $validator->messages();
        }
        else {
            try {
                $user = new User($datos);
                $user->password=Hash::make($datos["password"]);
                $user->token=sha1($datos['email']);
                $user->skin_id=skin::all()->first()->id;
                $user->save();
                $myRole = DB::table('roles')->where('name', '=', 'padre_free')->pluck('id');
                $user->attachRole($myRole);
                $persona = new persona($datos);
                $persona->user_id=$user->id;
                $persona->save();
                // $membresia = new membresia();
                // $membresia->token_card=sha1($datos_tarjeta["numero_tarjeta"]);
                // $membresia->fecha_registro= date("Y-m-d");
                // $membresia->active=1;
                // $membresia->save();
                $padre = new padre($datos);
                $padre->persona_id = $persona->id;
                $padre->save();
                $perfil = new perfil();
                $perfil->foto_perfil="perfil-default.jpg";
                $perfil->gustos="¿Cuáles son tus gustos?";
                $perfil->users_id=$user->id;
                $perfil->save();

            } catch (Exception $e){
                $user->delete();
                // $direccion->delete();
                // $membresia->delete();
                return $e->getMessage();
            }

            // $dataSend = [
            //     "name"     =>       "Equipo Curiosity",
            //     "client"   =>       $persona->nombre." ".$persona->apellido_paterno." ".$persona->apellido_materno,
            //     "email"    =>       $padre->email,
            //     "subject"  =>       "Registro relizado exitosamente",
            //     "msg"      =>       "La petición de registro al sistema Curiosity que realizo ha sido realizada con exito, para confirmar y activar su cuenta siga el enlace que esta en la parte de abajo",
            //     "token"    =>       $user->token
            // ];
            // $toEmail=$padre->email;
            // $toName=$dataSend["email"];
            // $subject =$dataSend["subject"];
            // try {
            //     Mail::send('emails.confirmar_registro',$dataSend,function($message) use($toEmail,$toName,$subject){
            //         $message->to($toEmail,$toName)->subject($subject);
            //     });
            //     return "OK";
            // } catch (Exception $e) {
            //     $user->delete();
            //     // $direccion->delete();
            //     // $membresia->delete();
            //     $code = $e->getCode();
            //     return $code;
            // }
            return "OK";

        }

    }
    public function confirmar($token){
        $user = User::where("token","=",$token)->first();
        if($user){
            $user->active=1;
            $user->save();
            Auth::login($user);
            return Redirect::to("/perfil");
        }else return Redirect::to("/");

    }
    public function gethijos(){

        return DB::select("Select users.username, hijos.id,concat(personas.nombre,' ',personas.apellido_paterno) as 'nombre_completo', max(hijo_realiza_actividades.promedio) 'max_promedio' , actividades.nombre as 'actividad'
         from padres inner join hijos on hijos.padre_id = padres.id
        inner join hijo_realiza_actividades on hijos.id = hijo_realiza_actividades.hijo_id
        inner join actividades on hijo_realiza_actividades.actividad_id = actividades.id
        inner join personas on hijos.persona_id = personas.id
        inner join users on users.id = personas.user_id where padres.id = '37'");
    }
    public function sendMensaje(){
    try{
        $mensaje = new recordatorioHijo();
         $mensaje->hijo_recuerda=User::where('username','=',Input::get('hijo_recuerda'))->join('personas','personas.user_id','=','users.id')->join('hijos','hijos.persona_id','=','personas.id')->select('hijos.id')->get()[0]->id;
        $mensaje->mensaje=Input::get('mensaje');
        $mensaje->is_read = 0;
        $mensaje->padre_avisa=Input::get('padre_avisa');
        $mensaje->save();
        return Response::json(array("message"=>"El mensaje se envio al hijo","estado"=>"200"));
        }catch(Exception $e){return $e;}
    }

    public function getCountHijos(){
      return persona::join('padres', "personas.id", "=", "padres.persona_id")
      ->join("hijos", "padres.id", "=", "hijos.padre_id")
      ->where("user_id", "=", Auth::user()->id)
      ->count('hijos.padre_id');
    }
}
