<?php
/**
 *
 */
class escuela extends Eloquent
{
    protected $table='escuelas';
    protected $fillable=['nombre','web','logotipo','active'];
  /*
  *
  ## Una escuela tiene muchos hijos
  */
    public function hijo(){
        return $this->hasMany('hijo','escuela_id');
    }
  /*
  *
  ## A una escuela le pertenece una direccion
  */
    public function direccion(){
        return $this->belongsTo('direccion');
    }
  /*
  *
  ## Una escuela tiene muchos profesores
  */
    public function profesor(){
        return $this->hasMany('profesor','escuela_id');
    }

}
