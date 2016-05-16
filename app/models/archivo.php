<?php
/**
 *
 */
class archivo extends Eloquent
{
  protected $table='archivos';
  protected $fillable = ['archivos'];
  /*
  *
  ## Un archivo pertenece a una actividad
  */
  public function actividad(){
      return $this->belongsTo('actividad');
  }



}
