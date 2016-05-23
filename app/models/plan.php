<?php
/**
 *
 */
class plan extends Eloquent
{
    protected $table='planes';
    protected $fillable=['name','amount','currency','interval','active'];
  /*
  *
  ## Un plan tiene una membresia
  */
  public function membresia_plan(){
  	return $this->hasMany("membresia_plan","plan_id");
  }
}
