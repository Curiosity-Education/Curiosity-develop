<?php
/**
 *
 */
class novedades_papa extends Eloquent
{
    protected $table='novedades_papa';
	protected = array('titulo', 'pdf', 'status');
	
	/* Una novedad es registrada por un administrativo */
	public function administrativo(){
		return $this->belongsTo('administrativo');
	}
 
}