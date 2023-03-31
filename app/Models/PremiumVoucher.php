<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumVoucher extends Model
{
  use HasFactory;

  protected $table = 'premium_vouchers';
  protected $primaryKey = 'id';
  protected $guarded = [];
  protected $fillable = [
    'premium_voucher_uid',
    'voucher_batch_id',
    'username',
    'password',
    'valid_until',
    'first_use',
    'status',
    'clean_up',
    'time_limit',
  ];

  /**
   * boot
   *
   * @return void
   */
  protected static function boot()
  {
    parent::boot();

    static::creating(function ($model) {
      $model->premium_voucher_uid = str()->uuid();
    });
  }
}
