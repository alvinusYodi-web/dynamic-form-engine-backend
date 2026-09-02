<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
  protected $keyType = 'string';

  public $incrementing = false;

  protected $fillable = [
    'id',
    'payload_id',
    'label',
    'value',
  ];

  public function payload() {
    return $this->belongsTo(Payload::class);
  }

  public function answers() {
    return $this->belongsToMany(Answer::class, 'answer_options');
  }
}
