<?php
class hijoCalificaActividad extends Eloquent{
    protected $table ='hijo_califica_actividades';
    public $timestamps = false;
  /*
  *
  ## Una actividad puede ser realizada por muchos hijos
  */
    public function hijo(){
        return $this->belongsTo('hijo');
    }
  /*
  *
  ## Una actividad puede ser realizada por muchos hijos
  */
    public function actividad(){
        return $this->belongsTo('actividad');
    }

}
