<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadGroupReply extends Model
{
    use HasFactory;

  protected $table = 'radgroupreply';
  protected $primaryKey = 'id';
  protected $guarded = [];
  protected $fillable = [
    'groupname',
    'attribute',
    'op',
    'value',
  ];


  public $timestamps = false;
}
