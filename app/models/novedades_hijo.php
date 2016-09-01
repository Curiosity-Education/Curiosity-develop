<?php
/**
 *
 */
class novedades_hijo extends Eloquent
{
    protected $table='novedades_hijo';
<<<<<<< HEAD
	protected $fillable = ['titulo', 'link', 'status'];
	
=======
	protected = array('titulo', 'link', 'status');

>>>>>>> 74c8aae6fcbfb63f892beb29183fcd1076b05963
	/* Una novedad es registrada por un administrativo */
	public function administrativo(){
		return $this->belongsTo('administrativo');
	}

}
