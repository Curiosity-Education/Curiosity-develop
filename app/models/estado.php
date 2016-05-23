<?php
/**
 *
 */
class estado extends Eloquent
{
    protected $table='estados';
  /*
  *
  ## Un estado puede tiene muchas ciudades
  */
    public function ciudad(){
        return $this->hasMany('ciudad','estado_id');
    }
  /*
  *
  ## Un estado pertenece a una pais
  */
    public function pais(){
        return $this->belongsTo('pais');
    }


}
