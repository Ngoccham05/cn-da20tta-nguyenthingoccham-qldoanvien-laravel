<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhgiadv extends Model
{
    use HasFactory;
    protected $table  = 'danhgiadv';
    protected $primarykey = ['madv','madot'];

    protected $fillable = [
        'madv',
        'maloaidv',
        'madot'
    ];
//khóa ngoại macd từ chidoan(macd)
    public function doanvien()
    {
        return $this->belongsTo(doanvien::class, 'madv', 'madv');
    }

//khóa ngoại maloaidv từ loaidv(id)
    public function loaidv()
    {
        return $this->belongsTo(loaidv::class, 'maloaidv', 'id');
    }
//khóa ngoại madot từ dotdg(madot)
    public function dotdg()
    {
        return $this->belongsTo(dotdg::class, 'madot', 'madot');
    }

    public $timestamps = false;
}
