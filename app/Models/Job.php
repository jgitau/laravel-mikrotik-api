<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'job_uid',
        'command',
        'username',
        'nasipaddress',
        'framedipaddress',
        'payload',
        'attempts',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->job_uid = str()->uuid();
        });
    }
}
