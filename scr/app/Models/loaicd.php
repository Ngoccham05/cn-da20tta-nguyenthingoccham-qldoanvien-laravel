<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loaicd extends Model
{
    use HasFactory;
    protected $table  = 'loaicd';
    protected $primarykey = 'id';

    protected $fillable = [
        'id',
        'tenloaicd',
    ];

//khóa chính cho bảng danhgiacd
    public function danhgiacd()
    {
        return $this->hasMany(danhgiacd::class, 'id');
    }

    public $timestamps = false;
}
