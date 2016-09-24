<?php
/**
 * */
class padre extends Eloquent
{
    protected $table ='padres';
    protected $fillable =["email","telefono"];

  /*
  *
  ## Una padre pertenece a una membresia
  */
    public function membresia(){
        return $this->belongsTo('membresia');
    }
  /*
  *
  ## Un padre puede tener  muchos hijos
  */
    public function hijo(){
        return $this->hasMany('hijo','padre_id');
    }
  /*
  *
  ## Los datos de un padre pertenences a una persona
  */
    public function persona(){
        return $this->belongsTo('persona');
    }
  /*
  *
  ## a un padre le pertenece una direccion
  */
    public function direccion(){
        return $this->belongsTo('direccion');
    }

}
