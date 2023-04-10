<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModule extends Model
{
    use HasFactory;

    protected $table = 'admin_module';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'admin_id',
        'module_id',
    ];

    public $timestamps = false;


    public function modules()
    {
        return $this->belongsToMany(Module::class, 'admin_module', 'admin_id', 'module_id');
    }

}
