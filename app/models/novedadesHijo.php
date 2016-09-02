<?php
/**
 *
 */
class novedades_hijo extends Eloquent
{
    protected $table='novedades_hijo';
	protected $fillable = ['titulo', 'link', 'status', 'administrativo_id'];
	


	/* Una novedad es registrada por un administrativo */
	public function administrativo(){
		return $this->belongsTo('administrativo');
	}

}
