<?php
class membresiaPlan extends Eloquent{

    protected $table = 'membresias_planes';
    public $timestamps =false;

    public function membresia(){
		return $this->belongsTo("membresia");
	}
	public function plan(){
		return $this->belongsTo("plan");
	}
	public function hijo(){
		return $this->belongsTo("hijo");
	}
}
