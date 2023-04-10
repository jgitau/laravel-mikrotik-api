<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'name',
        'title',
        'is_parent',
        'show_to',
        'url',
        'extensible',
        'active',
        'icon_class',
        'root',
    ];

    public $timestamps = false;

    public function pages()
    {
        return $this->hasMany(Page::class, 'module_id', 'id');
    }


    public function parent()
    {
        return $this->belongsTo(Module::class, 'root', 'id');
    }
}
