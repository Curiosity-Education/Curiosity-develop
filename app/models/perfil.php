<?php
/**
 *
 */
class perfil extends Eloquent
{
    protected $table='perfiles';
    public $timestamps=false;
  /*
  *
  ## Un perfil pertenece a un usuario
  */

   public function User(){
        return $this->belongsTo('User');
    }
}
