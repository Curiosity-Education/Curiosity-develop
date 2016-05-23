<?php
/**
 *
 */
class video extends Eloquent{
  protected $table="videos";
  protected $fillable=array('code_embed', 'profesores_id');
  /*
  *
  ## Un video pertenece a una actividad
  */
  public function actividad(){
      return $this->belongsTo('actividad');
  }
  /*
  *
  ## Un video pertenece a un profesor
  */
  public function profesor(){
      return $this->belongsTo('profesor');
  }


}
