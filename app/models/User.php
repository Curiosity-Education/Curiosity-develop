<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use HasRole;
	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
    protected $fillable =['username','password','active','token'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');




    /**
     *
     * El usuario tiene una persona
     *
     */
    public function persona(){
        return $this->hasOne('persona','user_id');
    }
    /*
     *
     *Al usuario le pertenece un skin
     *
     */
    public function skin(){
        return $this->belongsTo('Skin');
    }
    /**
     *
     *##Un usuario tiene un perfil
     *
     */
    public function perfil(){
        return $this->hasOne('perfil','users_id');
    }

	public static function get_imagen_perfil($id){
		$foto = User::where('users.id', '=', $id)
		->join('perfiles', 'users.id', '=', 'perfiles.users_id')
		->select('perfiles.foto_perfil')->get();
		return "/packages/images/perfil/".$foto[0]['foto_perfil'];
	}

}
