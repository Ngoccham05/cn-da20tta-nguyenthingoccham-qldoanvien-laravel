<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thamgia extends Model
{
    use HasFactory;
    protected $table  = 'thamgia';
    protected $primarykey = ['madv', 'mahd'];

    protected $fillable = [
        'madv',
        'mahd',
    ];

//khóa ngoại madv từ doanvien(madv)    
    public function doanvien()
    {
        return $this->belongsTo(doanvien::class, 'madv', 'madv');
    }
    
//Khóa ngoại mahd từ hoatdong(mahd)   
    public function hoatdong()
    {
        return $this->belongsTo(hoatdong::class, 'mahd', 'id');
    }
    public $timestamps = false;
}
