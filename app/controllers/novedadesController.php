<?php

/**
 *
 */
class novedadesController extends BaseController{
<<<<<<< HEAD
	
	// Validaciones remotas
	
	public function tituloNov_papa(){
		$novedad = DB::table('novedades_papa')->where("titulo","=",Input::get("titulo_papa"))->first();
		$novedadEdit = DB::table('novedades_papa')->where("titulo","=",Input::get("tituloEdit_papa"))->first();
		
		if($novedad || $novedadEdit){
			return "false";
		}else{
			return "true";
		}
	}
	
	public function tituloNov_hijo(){
		$novedad = DB::table('novedades_hijo')->where("titulo","=",Input::get("titulo_hijo"))->first();
		$novedadEdit = DB::table('novedades_hijo')->where("titulo","=",Input::get("tituloEdit_hijo"))->first();
		
		if($novedad || $novedadEdit){
			return "false";
		}else{
			return "true";
		}
	}
	
	// Traer las novedades del papá
	public function getnovedades_papa(){
		$novedades_papa = DB::table('novedades_papa')
			->select('*')
			->where('status', '=', '1')
			->get();
		
		return $novedades_papa;
	}
	
	// Traer las novedades del hijo
	public function getnovedades_hijo(){
		$novedades_hijo = DB::table('novedades_hijo')
			->select('*')
			->where('status', '=', '1')
			->get();
		
		return $novedades_hijo;
	}
	
	public function getViewNovedad(){
		
		$novedades_papa = DB::table('novedades_papa')
			->select('*')
			->where('status', '=', '1')
			->get();
		
		
		return View::make('vista_gestion_novedades')->with('novedades_papa', $novedades_papa);
	}
	
	// Crud de papá
	
	public function add_papaNovedad(){
		
		$datos = Input::all(); 
		
		$id_admin = DB::table('users')
			->select('administrativos.id')
			->join('personas','personas.user_id', '=', 'users.id')
			->join('administrativos','administrativos.persona_id', '=', 'personas.id')
			->first()->id;
		
		
		$rules = array(
			'titulo_papa'  => 'required',
			'pdf'          => 'required|mimes:pdf'
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
			
			return "Guardado";
		}
	}
	
	public function edit_papaNovedad(){
		
		$datos = Input::get('data');        
		
		$rules = array(
			'tituloEditar_papa'  => 'required',
			'pdf_edit'           => 'required|mimes:pdf'
		);
		
		$validacion = Validator::make(Input::all(),$rules);
		
		if($validacion -> fail()){
			return $validar -> messages();
		}else{
			$nov_papa = novedades_papa::find(Input::get('id_nov'));
			$nov_papa -> titulo = $datos['tituloEditar_papa'];
			$nov_papa -> pdf = $datos['pdf_edit'];
			$nov_papa -> status = (1);
			$nov_papa -> administrativo_id = Auth::user()->id;
			$nov_papa -> save();
			
			return "Editado";
		}
	}
	
	public function delete_papaNovedad(){
		
		$nov_papa = novedades_papa::find(Input::get('id_nov'));
		$nov_papa -> status = (0);
		$nov_papa -> save();
		
	}
	
	// Crud de hijo
	
	public function add_hijoNovedad(){
		
	}
	
	public function edit_hijoNovedad(){
		
	}
	
	public function delete_hijoNovedad(){
		
=======

	function getViewNovedad(){
		return View::make('vista_gestion_novedades');
>>>>>>> 74c8aae6fcbfb63f892beb29183fcd1076b05963
	}

}
