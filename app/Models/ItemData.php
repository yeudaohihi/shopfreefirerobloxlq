<?php

namespace App\Models;

use Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemData extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'type',
    'code',
    'image',
    'price',
    'discount',
    'status',
    'sold_count',
    'highlights',
    'currency',
    'description',
    'extra_data',
    'priority',
    'group_id'
  ];

  protected $casts = [
    'status'     => 'boolean',
    'highlights' => 'array',
    'sold_count' => 'integer',
  ];

  protected $appends = [
    'payment',
    'price_str',
    'price_discount',
  ];

  public function getPaymentAttribute()
  {
    $payment = $this->price;

    if ($this->discount > 0) {
      $payment = $this->price - ($this->price * $this->discount / 100);
    }

    return $payment;
  }

  public static function generateCode()
  {
    $code = Helper::randomNumber(8);

    if (self::where('code', $code)->exists()) {
      $code = Helper::randomNumber(8);
    }

    return $code;
  }

  public function getPriceStrAttribute()
  {
    $totalPrice = $this->price;

    if ($this->discount > 0) {
      $totalPrice = $this->price - ($this->price * $this->discount / 100);
    }

    return Helper::formatCurrency($totalPrice);
  }

  public function getPriceDiscountAttribute()
  {
    if ($this->discount === 0) {
      return 0;
    }

    $discount = $this->price - ($this->price * $this->discount / 100);

    return Helper::formatCurrency($discount);
  }

  public function group()
  {
    return $this->belongsTo(ItemGroup::class, 'group_id', 'id');
  }
}