<?php
/**
 *
 */
class bloque extends Eloquent
{
    protected $table ='bloques';
    protected $fillable=['nombre','estatus','active','descripcion', 'bg_color', 'imagen', 'inteligencia_id'];
  /*
  *
  ## Un bloque pertenece a una inteligencia
  */
    public function inteligencia(){
        return $this->belongsTo('inteligencia');
    }
  /*
  *
  ## Un bloque puede tener muchas temas
  */
    public function tema(){
        return $this->hasMany('tema','bloque_id');
    }
}
