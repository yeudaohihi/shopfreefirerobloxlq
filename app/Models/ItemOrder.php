<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'type',
    'code',
    'data',
    'payment',
    'discount',
    'status',
    'input_user',
    'input_pass',
    'input_auth',
    'input_ingame',
    'admin_note',
    'order_note',
    'extra_data',
    'user_id',
    'username',
  ];

  protected $hidden = [
    'data',
    'admin_note',
    'input_pass',
    'extra_data',
  ];

  protected $casts = [
    'data'         => 'array',
    'extra_data'   => 'array',
    'input_ingame' => 'array',
  ];
}