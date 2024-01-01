<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nganh extends Model
{
    use HasFactory;
    protected $table  = 'nganh';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tennganh',
    ];
    public function chidoan()
    {
        return $this->hasMany(chidoan::class, 'id');
    }
    public $timestamps = false;
}
