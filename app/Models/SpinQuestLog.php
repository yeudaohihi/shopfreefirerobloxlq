<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpinQuestLog extends Model
{
  use HasFactory;

  protected $fillable = [
    'unit',
    'prize',
    'price',
    'status',
    'content',
    'user_id',
    'username',
    'spin_quest_id',
  ];
}
