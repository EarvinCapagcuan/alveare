<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    public function project(){
    	return $this->belongsTo('App\Project');
    }
    public function userProject(){
    	return $this->belongsToMany('App\User');
    }
}
