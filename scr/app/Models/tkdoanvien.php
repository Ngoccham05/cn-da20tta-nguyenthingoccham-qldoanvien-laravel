<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class tkdoanvien extends Authenticatable
{
    use HasFactory;
    protected $table  = 'tkdoanvien';
    protected $primaryKey = 'username';

    protected $fillable = [
        'username',
        'password',
        'role',
        'active',
    ];

    //khóa ngoại username từ doanvien(madv)
    public function doanvien()
    {
        return $this->belongsTo(doanvien::class, 'username', 'madv');
    }
    public $timestamps = false;
}
