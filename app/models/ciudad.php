w<?php
/**
 *
 */
class ciudad extends Eloquent
{
    protected $table ='ciudades';
  /*
  *
  ## Una ciudad puede tener muchas direcciones
  */
    public function direccion(){
        return $this->hasMany('direccion','ciudad_id');
    }
  /*
  *
  ## Un video pertenece a una actividad
  */
  public function estado(){
      return $this->belongsTo('estado');
  }

}
