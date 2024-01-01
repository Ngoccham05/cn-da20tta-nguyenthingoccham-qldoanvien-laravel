<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chidoan extends Model
{
    use HasFactory;
    protected $table  = 'chidoan';
    protected $primarykey = 'macd';

    protected $fillable = [
        'macd',
        'tencd',
        'manganh'
    ];

//khóa ngoại manganh cho nganh(id)
    public function nganh()
    {
        return $this->belongsTo(nganh::class, 'manganh', 'id');
    }

//khóa chính cho bảng doanvien
    public function chidoan()
    {
        return $this->hasMany(doanvien::class, 'macd');
    }
//khóa chính cho danhgiacd
    public function danhgiacd()
    {
        return $this->hasMany(danhgiacd::class, 'macd');
    }

    public $timestamps = false;
}
