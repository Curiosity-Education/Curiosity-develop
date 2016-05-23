<?php
/**
 *
 */
class pais extends Eloquent
{
    protected $table ='paises';
  /*
  *
  ## Un pais tiene muchos estados
  */
    public function estado(){
        return $this->hasMany('estado');
    }
}
