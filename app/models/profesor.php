<?php
/**
 *
 */
class profesor extends Eloquent
{
    protected $table = 'profesores';
    protected $fillable =['nombre','apellido_paterno','apellido_materno','email','gustos','foto','active', 'escuela_id'];
  /*
  *
  ## Un profesor puede tener muchos videos
  */
    public function video(){
        return $this->hasMany('video','profesor_id');
    }
  /*
  *
  ## Un profesor pertenece a una escuela
  */
    public function escuela(){
        return $this->belongsTo('escuela');
    }
}
