<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
     
         protected $guard = 'admin';
         
         protected $fillable=[
             'name',
             'username',
             'email',
             'access',
             'role'];
             
             
    protected $hidden = [
        'password', 'remember_token',
    ];

}
