<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chucvu extends Model
{
    use HasFactory;
    protected $table  = 'chucvu';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'tencv',
    ];
    //khóa chính cho bảng doanvien
    public function doanvien()
    {
        return $this->hasMany(doanvien::class, 'id');
    }
    public $timestamps = false;
}
