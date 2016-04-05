<?php
/**
 *
 */
class membresia extends Eloquent
{
    protected $table ='membresias';
    protected $fillable=['token','fecha_registro','active'];
  /*
  *
  ## Una membresia puede tener muchas renovaciones
  */
    public function renovacion(){
        return $this->hasMany('renovacion','membresia_id');
    }
  /*
  *

  ## Un padre tiene una membresia
  */
    public function padre(){
        return $this->hasOne('padre','membresia_id');
    }
    public function membresia_plan(){
      return $this->hasMany("membresia_plan","membresia_id");
    }

}
