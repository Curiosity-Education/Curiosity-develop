<?php
/**
 *
 */
class administrativo extends Eloquent
{
    protected $table='administrativos';
  /*
  *
  ## un administrativo pertenece a una persona
  */
    public function persona(){
        return $this->belongsTo('persona');
    }
  /*
  *
  ## un administrativo pertenece a una direccion
  */
    public function direccion(){
        return $this->belongsTo('direccion');
    }

	/*
  *
  ## un administrativo registra muchas novedades
  */
	public function novedades_papa(){
        return $this->hasMany('novedades_papa');
    }

	public function novedades_hijo(){
        return $this->hasMany('novedades_hijo');
    }

}
