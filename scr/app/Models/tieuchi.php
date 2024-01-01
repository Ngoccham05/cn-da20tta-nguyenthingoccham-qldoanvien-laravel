<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tieuchi extends Model
{
    use HasFactory;
    protected $table  = 'tieuchi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'tentc',
    ];
    public function dattc()
    {
        return $this->hasMany(dattc::class, 'id');
    }
    public $timestamps = false;
}
