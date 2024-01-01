<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doanvien extends Model
{
    use HasFactory;

    protected $table  = 'doanvien';
    protected $primaryKey = 'madv';

    protected $fillable = [
        'madv',
        'hoten',
        'gioitinh',
        'ngaysinh',
        'sdt',
        'diachi',
        'ngayvaodoan',
        'noivaodoan',
        'macd',
        'macv',
    ];

//khóa ngoại macd từ chidoan(macd)
    public function chidoan()
    {
        return $this->belongsTo(chidoan::class, 'macd', 'macd');
    }

//khóa ngoại macv từ chucvu(id)
    public function chucvu()
    {
        return $this->belongsTo(chucvu::class, 'macv', 'id');
    }
//khóa chính cho bảng đạt tc
    public function dattc()
    {
        return $this->hasMany(dattc::class, 'madv');
    }    

//khóa chính cho bảng tham gia
    public function thamgia()
    {
        return $this->hasMany(thamgia::class, 'madv');
    }    

//khóa chính cho bảng tkdoanvien
    public function tkdoanvien()
    {
        return $this->hasMany(tkdoanvien::class, 'madv');
    }

//khóa chính cho bảng danhgiadv
        public function danhgiadv()
        {
            return $this->hasMany(danhgiadv::class, 'madv');
        }
    public $timestamps = false;
}
