<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loaidv extends Model
{
    use HasFactory;
    protected $table  = 'loaidv';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'tenloaidv',
    ];
    
//khóa chính cho bảng danhgiadv
    public function danhgiadv()
    {
        return $this->hasMany(danhgiadv::class, 'id');
    }

    public $timestamps = false;
}
