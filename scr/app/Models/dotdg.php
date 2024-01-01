<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dotdg extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table  = 'dotdg';
    protected $primarykey = 'madot';

    protected $fillable = [
        'madot',
        'tendot',
        'tgbatdau',
        'tgketthuc',
        'trangthai',
    ];

//khóa chính cho bảng danhgiadv
    public function danhgiadv()
    {
        return $this->hasMany(danhgiadv::class, 'madot');
    }

//khóa chính cho danhgiacd
    public function danhgiacd()
    {
        return $this->hasMany(danhgiacd::class, 'madot');
    }
//khóa chính cho bảng danhgiadv
    public function dattc()
    {
        return $this->hasMany(dattc::class, 'madot');
    }

    public $timestamps = false;
}
