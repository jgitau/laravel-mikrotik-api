<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumSession extends Model
{
  use HasFactory;

  protected $table = 'premium_sessions';
  protected $primaryKey = 'id';
  protected $guarded = [];
  protected $fillable = [
    'premium_session_uid',
    'username',
    'expiration',
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
      $model->premium_session_uid = str()->uuid();
    });
  }
}
