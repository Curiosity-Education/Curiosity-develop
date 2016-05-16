<?php
/**
 *
 */
class direccion extends Eloquent
{
    protected $table='direcciones';
    protected $fillable= ['calle','colonia','numero','codigo_postal','ciudad_id'];
  /*
  *
  ## Una direccion teiene una escuela
  */
    public function escuela(){
        return $this->hasOne('escuela','direccion_id');
    }
  /*
  *
  ## una direccion tiene a un padre
  */
    public function padre(){
        return $this->hasOne('padre','direccion_id');
    }
  /*
  *
  ## Una direccion tiene un administrativo
  */
    public function administrativo(){
        return $this->hasMany('administrativo','direccion_id');
    }
  /*
  *
  ## Una direccion pertenece a una ciudad
  */
    public function ciudad(){
        return $this->belongsTo('ciudad');
    }


}
