<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
  use HasFactory;

  protected $table = 'user_data';
  protected $primaryKey = 'id';
  protected $guarded = [];
  protected $fillable = [
    'user_data_uid',
    'name',
    'email',
    'phone_number',
    'room_number',
    'date',
    'first_name',
    'last_name',
    'location',
    'gender',
    'birthday',
    'login_with',
    'mac',
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
      $model->user_data_uid = str()->uuid();
    });
  }
}
