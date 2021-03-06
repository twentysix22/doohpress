<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

  public $default_profile_pic = "/images/profilepics/avatar-team-default.gif";


  public function users() {
    return $this->belongsToMany('App\User')->withPivot('role_id');
  }

  public function invitations() {
    return $this->hasMany('App\Invitation');
  }

  public function jobs() {
    return $this->hasMany('App\Job');
  }
}
