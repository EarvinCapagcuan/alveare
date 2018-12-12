<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'firstname',
            'middlename',
            'lastname',
            'contact',
            'dob',
            'gender',
            'batch_id',
            'level_id',
            'senior_id',
            'email',
            'password',
            'last_login_at',
            'last_login_ip',
            'user_id', 
        ];
        use SoftDeletes;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'last_login_at',
        'dob',
        ];

    public function level(){
        return $this->belongsTo('App\Level');
    }

    public function project(){
        return $this->belongToMany('App\Project', 'project_users');
    }

    public function senior(){
        return $this->belongsTo('App\User');
    }

    public function batch(){
        return $this->belongsTo('App\Batch');
    }

    public function getFullNameAttribute(){
        return $this->attributes['firstname']." ".$this->attributes['middlename']." ".$this->attributes['lastname'];
    }


}