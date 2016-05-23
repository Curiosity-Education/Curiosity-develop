<?php
/**
 *
 */
class ciudadController extends BaseController
{
	public function getCiudades(){
		$estado_id = Input::get('estado_id');
		$ciudades = ciudad::where("estado_id","=",$estado_id)->get();
		return $ciudades;
	}

}
