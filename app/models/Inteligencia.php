<?php

/**
 * EL nombre del archivo en minuscula si lo buscas asi!
 */
class inteligencia extends Eloquent
{
  protected $table = 'inteligencias';
  protected $fillable = array('nombre', 'estatus', 'active', 'descripcion', 'bg_color', 'nivel_id', 'imagen');

  /*
  *
  ## Un tipo de inteligencia pertenece  a un nivel
  */
    public function nivel(){
        return $this->belongsTo('nivel');
    }
  /*
  *
  ## Una inteligencia puede tenet varios bloques
  */
    public function bloque(){
        return $this->hasMany('bloque','inteligencia_id');
    }


}
