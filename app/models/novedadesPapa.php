<?php
/**
 *
 */
class novedadesPapa extends Eloquent
{
    protected $table='novedades_papa';
<<<<<<< HEAD:app/models/novedadesPapa.php
	protected $fillable = ['titulo', 'pdf', 'status', 'administrativo_id'];
	
=======
	protected = array('titulo', 'pdf', 'status');

>>>>>>> 74c8aae6fcbfb63f892beb29183fcd1076b05963:app/models/novedades_papa.php
	/* Una novedad es registrada por un administrativo */
	public function administrativo(){
		return $this->belongsTo('administrativo');
	}

}
