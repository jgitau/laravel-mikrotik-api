<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumVoucherBatches extends Model
{
  use HasFactory;

  protected $table = 'premium_voucher_batches';
  protected $primaryKey = 'id';
  protected $guarded = [];
  protected $fillable = [
    'premium_voucher_batches_uid',
    'service_id',
    'quantity',
    'created',
    'created_by',
    'note',
    'premium_service_end_time',
    'status',
    'type',
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
      $model->premium_voucher_batches_uid = str()->uuid();
    });
  }
}
