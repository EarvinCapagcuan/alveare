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
        'firstname', 'middlename', 'lastname', 'contact', 'dob', 'gender', 'batch_id', 'level_id', 'senior', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function level(){
        return $this->belongsTo('App\Level');
    }

    public function project(){
        return $this->belongsToMany('App\Project')->withTimestamps();
    }

    public function projectUser(){
        return $this->belongsToMany('App\ProjectUser');
    }

    public function batch(){
        return $this->belongsTo('App\Batch');
    }
    public function getFullNameAttribute(){
        return $this->attributes['firstname']." ".$this->attributes['middlename']." ".$this->attributes['lastname'];
    }
}