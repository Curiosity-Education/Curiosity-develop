<?php
/**
 *
 */
class tema extends Eloquent
{
    protected $table='temas';
    protected $fillable=['nombre','estatus','active','descripcion', 'bloque_id', 'bg_color', 'isPremium'];
  /*
  *
  ## un tema puede tener muchas actividades
  */
    public function actividad(){
        return $this->hasMany('actividad','tema_id');
    }
    public function bloque(){
        return $this->belongsTo('bloque');
    }


}
