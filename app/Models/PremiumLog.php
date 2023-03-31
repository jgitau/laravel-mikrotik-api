<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumLog extends Model
{
  use HasFactory;

  protected $table = 'premium_logs';
  protected $primaryKey = 'id';
  protected $guarded = [];
  protected $fillable = [
    'premium_log_uid',
    'voucher_batch_id',
    'date',
    'operator',
    'quantity',
    'service',
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
      $model->premium_log_uid = str()->uuid();
    });
  }
}
