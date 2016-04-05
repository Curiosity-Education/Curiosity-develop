<?php
/**
 *
 *All imports here
 */
class persona extends Eloquent{

    protected $table = 'personas';
    protected $fillable = ['nombre','apellido_paterno','apellido_materno','fecha_nacimiento','sexo','telefono'];
    /*
     *
     ## Una persona le pertenece un usuario
    */
    public function User(){
        return $this->belongsTo('User');
    }
    /*
     *
     ## Una persona tiene datos de hijo
    */
    public function hijo(){
        return $this->hasOne('hijo','persona_id');
    }
    /*
     *
     ## Una persona le pertenece un administrativo
    */
    public function administrativo(){
        return $this->hasOne('administrativo','persona_id');
    }
    public function padre(){
      return $this->hasOne('padre','persona_id');
    }
}
