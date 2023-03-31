<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
  use HasFactory;

  protected $table = 'hotel_rooms';
  protected $primaryKey = 'id';
  protected $guarded = [];
  protected $fillable = [
    'hotel_room_uid',
    'room_number',
    'name',
    'folio_number',
    'service_id',
    'default_cron_type',
    'status',
    'edit',
    'change_service_end_time',
    'arrival',
    'departure',
    'no_posting',
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
      $model->hotem_room_uid = str()->uuid();
    });
  }
}
