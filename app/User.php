<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','path_image_profile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public static $login_validation_rules=[
        'email'=>'required|email|exists:users',
        'password'=>'required'
    ];
    public static $create_validation_rules=[
        'name'=>'required|unique:users',     /*Esto significa que no pueden haber 2 personas con el mismo usuario
        con el mismo nombre de usuario*/
        'email'=>'required|email|unique:users',
        'password'=>'required'
    ];
}
