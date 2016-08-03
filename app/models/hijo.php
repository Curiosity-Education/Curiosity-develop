<?php
/**
 *
 */
class hijo extends Eloquent{
    protected $table = 'hijos';

  /*
  *
  ## Los datos de una persona le pertenecen a  un hijo
  */
    public function persona(){
        return $this->belongsTo('Persona');
    }
  /*
  *
  ## Un hijo pertenece a una escuela
  */
    public function escuela(){
        return $this->belongsTo('escuela');
    }
  /*
  *
  ## Unhijo realiza muchas actividades
  */
    public function hijo_realiza_actividad(){
        return $this->hasMany('hijo_realiza_actividad');
    }
  /*
  *
  ## Un hijo pertenece  a un padre
  */
    public function padre(){
        return $this->belongsTo('padre');
    }

}
