<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  protected $guarded = [];
  
  public function payload() {
    return $this->belongsTo(Payload::class);
  }

  public function riskEvent () {
    return $this->belongsTo(RiskEvent::class);
  }

   public function options() {
    return $this->belongsToMany(Option::class, 'answer_options');
   }
}
