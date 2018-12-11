<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    public function instructor(){
    	return $this->belongsTo('App\User');
    }
}
