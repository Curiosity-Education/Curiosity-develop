<?php
/**
 *
 */
class novedadesPapa extends Eloquent
{
    protected $table='novedades_papa';
	protected $fillable = ['titulo', 'pdf', 'status', 'administrativo_id'];
	
	/* Una novedad es registrada por un administrativo */
	public function administrativo(){
		return $this->belongsTo('administrativo');
	}
 
}