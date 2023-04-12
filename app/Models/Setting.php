<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'module_id',
        'setting',
        'value',
        'flag_module',
    ];
}
