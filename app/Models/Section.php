<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

  protected $fillable = [
    'id',
    'name'
  ];

  protected $keyType = 'string';

  public $incrementing = false;

  public function payloads() {
    return $this->hasMany(Payload::class);
  }
}
