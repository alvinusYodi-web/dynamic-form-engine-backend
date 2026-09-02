<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiskEvent extends Model
{
  protected $guarded = [];
  
  public function answers() {
    return $this->hasMany(Answer::class);
  }
}
