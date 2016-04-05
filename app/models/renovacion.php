<?php
/**
 *
 */
class renovacion extends Eloquent
{
    protected $table = 'renovaciones';
  /*
  *
  ## Una renovacion pertenece a una membresia
  */
    public function membresia(){
        return $this->belongsTo('membresia');
    }

}
