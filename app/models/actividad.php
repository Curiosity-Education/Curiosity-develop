<?php
/**
 *
 */
class actividad extends Eloquent
{
    protected $table='actividades';
    protected $fillable=['nombre','objetivo','estatus','active', 'tema_id', 'bg_color', 'imagen', 'pdf'];
  /*
  *
  ## Una actividad tiene un video
  */
    public function video(){
        return $this->hasOne('video','actividad_id');
    }
  /*
  *
  ## Una actividad tiene un archivo
  */
    public function archivo(){
        return $this->hasOne('archivo','actividad_id');
    }
  /*
  *
  ## Una dactividad puede ser reailizada por muchos hijos
  */
    public function hijo_realiza_actividad(){
        return $this->hasMany('hijo_realiza_actividad','actividad_id');
    }
  /*
  *
  ## Una actividad pertenece a un tema
  */
    public function tema(){
        return $this->belongsTo('tema');
    }
}
