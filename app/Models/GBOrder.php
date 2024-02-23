<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GBOrder extends Model
{
  use HasFactory;

  protected $fillable = [
    'code',
    'name',
    'input_user',
    'input_pass',
    'input_extra',
    'payment',
    'user_id',
    'username',
    'status',
    'package_id',
    'group_id',
    'admin_note',
    'order_note'
  ];

  protected $casts = [
    'user_id'    => 'integer',
    'package_id' => 'integer',
    'group_id'   => 'integer',
  ];

  public function getInputPassAttribute($value)
  {
    if ($this->status === 'Processing') {
      return $value;
    }

    return '********';
  }


  public function package()
  {
    return $this->belongsTo(GBPackage::class);
  }

  public function group()
  {
    return $this->belongsTo(GBGroup::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}