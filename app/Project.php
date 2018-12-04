<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function student(){
        return $this->belongsToMany('App\User', 'project_users')->withPivot('status_id')->withTimestamps();
    }
    public function instructor(){
    	return $this->belongsTo('App\User');
    }

    public function status(){
    	return $this->belongsTo('App\ProjectStatus');
    }

    public function batch(){
    	return $this->belongsTo('App\Batch');
    }
    public function projectUser(){
    	return $this->belongsToMany('App\ProjectUser');
    }
}