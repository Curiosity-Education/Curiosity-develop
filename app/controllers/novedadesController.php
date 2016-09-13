<?php

/**
 *
 */
class novedadesController extends BaseController{

	// function getViewNovedad(){
	// 	return View::make('vista_gestion_novedades');
  //   }


	// Validaciones remotas

	public function tituloNov_papa(){
		$novedad = DB::table('novedades_papa')
			->where("titulo","=",Input::get("titulo_papa"))
			->where("status", "=", "1")->first();
		$novedadEdit = DB::table('novedades_papa')
			->where("titulo","=",Input::get("tituloEdit_papa"))
			->where("status", "=", "1")->first();

		if($novedad || $novedadEdit){
			return "false";
		}else{
			return "true";
		}
	}

	public function tituloNov_hijo(){
		$novedad = DB::table('novedades_hijo')
			->where("titulo","=",Input::get("tituloNov_hijo"))
			->where("status", "=", "1")->first();
		$novedadEdit = DB::table('novedades_hijo')
			->where("titulo","=",Input::get("tituloEditar_hijo"))
			->where("status", "=", "1")->first();

		if($novedad || $novedadEdit){
			return "false";
		}else{
			return "true";
		}
	}

	public function linkNov_hijo(){
		$link = DB::table('novedades_hijo')
			->where("uri","=",Input::get("link"))
			->where("status","=","1")->first();

		$link_edit = DB::table('novedades_hijo')
			->where("uri","=",Input::get("link_edit"))
			->where("status","=","1")->first();

		if($link || $link_edit){
			return "false";
		}else{
			return "true";
		}
	}

	// Mostrar la vista
	public function getViewNovedad(){

		$novedades_papa = DB::table('novedades_papa')
			->select('*')
			->where('status', '=', '1')
			->limit(3)
			->orderBy('id','DESC')
			->get();

		$novedades_hijo = DB::table('novedades_hijo')
			->select('*')
			->where('status', '=', '1')
			->limit(3)
			->orderBy('id','DESC')
			->get();

		return View::make('vista_gestion_novedades')->with('novedades_papa', $novedades_papa)->with('novedades_hijo', $novedades_hijo);
	}

	// Crud de papá

	public function add_papaNovedad(){

		$datos = Input::all();

		$id_admin = DB::table('users')
			->select('administrativos.id')
			->join('personas','personas.user_id', '=', 'users.id')
			->join('administrativos','administrativos.persona_id', '=', 'personas.id')
			->where('users.id', '=', Auth::user()->id)
			->first()->id;


		$rules = array(
			'titulo_papa'  => 'required|max:20',
			'pdf'          => 'required'
		);

		$messages = ["mimes" => "el archivo debe ser extensión PDF"];

		$validacion = Validator::make(Input::all(),$rules);

		if($validacion -> fails()){
			return $validacion -> messages();
		}else{

			$nov_papa = new novedadesPapa($datos);
			$nov_papa -> titulo = $datos['titulo_papa'];
			$nov_papa -> pdf = $datos['pdf'] -> getClientOriginalName();
			$nov_papa -> status = (1);
			$nov_papa -> administrativo_id = $id_admin;
			$nov_papa -> save();

			$datos['pdf']->move(public_path()."/packages/docs/novedades", $datos['pdf'] -> getClientOriginalName());

		}
	}

	public function edit_papaNovedad($id){

		$datos = Input::all();

		$id_admin = DB::table('users')
			->select('administrativos.id')
			->join('personas','personas.user_id', '=', 'users.id')
			->join('administrativos','administrativos.persona_id', '=', 'personas.id')
			->first()->id;

		$rules = array(
			'tituloEditar_papa'  => 'required',
			'pdf_edit'           => 'mimes:pdf'
		);

		$validacion = Validator::make(Input::all(),$rules);

		if($validacion -> fails()){
			return $validar -> messages();
		}else{
			$nov_papa = novedadesPapa::find($id);
			$nov_papa -> titulo = $datos['tituloEditar_papa'];
			if(Input::hasFile('pdf_edit')){
				$nov_papa -> pdf = $datos['pdf_edit'] -> getClientOriginalName();
			}
			$nov_papa -> status = (1);
			$nov_papa -> administrativo_id = $id_admin;
			$nov_papa -> save();

			return "Editado";
		}
	}

	public function delete_papaNovedad($id){

		$nov_papa = novedadesPapa::find($id);
		$nov_papa -> status = (0);
		$nov_papa -> save();
		sleep(1);
		return Redirect::back();
	}

	// Crud de hijo

	public function add_hijoNovedad(){

		$datos_hijo = Input::all();

		$id_admin = DB::table('users')
			->select('administrativos.id')
			->join('personas','personas.user_id', '=', 'users.id')
			->join('administrativos','administrativos.persona_id', '=', 'personas.id')
			->first()->id;


		$rules = array(
			'tituloNov_hijo'  => 'required|max:20',
			'link'         	  => 'required'
		);

		$validacion = Validator::make(Input::all(),$rules);

		if($validacion -> fails()){
			return $validacion -> messages();
		}else{

			$nov_hijo = new novedadesHijo($datos_hijo);
			$nov_hijo -> titulo = $datos_hijo['tituloNov_hijo'];
			$nov_hijo -> uri = $datos_hijo['link'];
			$nov_hijo -> status = (1);
			$nov_hijo -> administrativo_id = $id_admin;
			$nov_hijo -> save();

			return "Guardado";
		}

	}

	public function edit_hijoNovedad($id){

		$datos = Input::all();

		$id_admin = DB::table('users')
			->select('administrativos.id')
			->join('personas','personas.user_id', '=', 'users.id')
			->join('administrativos','administrativos.persona_id', '=', 'personas.id')
			->first()->id;

		$rules = array(
			'tituloEditar_hijo'   => 'required',
			'link_edit'           => 'required'
		);

		$validacion = Validator::make(Input::all(),$rules);

		if($validacion -> fails()){
			return $validar -> messages();
		}else{
			$nov_hijo = novedadesHijo::find($id);
			$nov_hijo -> titulo = $datos['tituloEditar_hijo'];
			$nov_hijo -> uri = $datos['link_edit'];
			$nov_hijo -> status = (1);
			$nov_hijo -> administrativo_id = $id_admin;
			$nov_hijo -> save();

			return "Editado";
		}

	}

	public function delete_hijoNovedad($id){

		$nov_papa = novedadesHijo::find($id);
		$nov_papa -> status = (0);
		$nov_papa -> save();
		sleep(1);
		return Redirect::back();

	}

	public static function getNovedadesToDad(){
		return novedadesPapa::where('status', '=', 1)->limit(5)->get();
	}

}
