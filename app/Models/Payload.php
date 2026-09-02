<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payload extends Model
{
  protected $keyType = 'string';

  public $incrementing = false;

  protected $fillable = [
    'id',
    'section_id',
    'label',
    'type',
    'sub_type',
    'description'
  ];

  public function section() {
    return $this->belongsTo(Section::class);
  }

  public function options()
  {
    return $this->hasMany(Option::class);
  }
}
