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
}
