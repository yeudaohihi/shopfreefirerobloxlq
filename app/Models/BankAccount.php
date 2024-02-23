<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'image',
    'owner',
    'number',
    'branch',
    'status',
  ];

  protected $casts = [
    'status' => 'boolean',
  ];
}