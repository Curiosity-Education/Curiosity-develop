<?php
/**
 *
 */
class hijoRealizaActividad extends Eloquent
{
    protected $table ='hijo_realiza_actividades';
    protected $fillable =['puntaje','eficiencia','intervalo','promedio'];
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
