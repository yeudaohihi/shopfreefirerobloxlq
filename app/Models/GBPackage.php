<?php

namespace App\Models;

use Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GBPackage extends Model
{
  use HasFactory;

  protected $fillable = [
    'code',
    'name',
    'image',
    'input',
    'price',
    'descr',
    'status',
    'priority',
    'group_id',
    'sold_count'
  ];

  protected $casts = [
    'status'   => 'boolean',
    'group_id' => 'integer',
    'priority' => 'integer',
  ];

  public function group()
  {
    return $this->belongsTo(GBGroup::class);
  }

  public static function generateCode()
  {
    $code = Helper::randomNumber(8);

    if (self::where('code', $code)->exists()) {
      $code = Helper::randomNumber(8);
    }

    return $code;
  }

}