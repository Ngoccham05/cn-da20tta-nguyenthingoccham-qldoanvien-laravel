<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dattc extends Model
{
    use HasFactory;
    protected $table  = 'dattc';
    protected $primarykey = ['madv','madot'];

    protected $fillable = [
        'madv',
        'matc',
        'madot', 
        'minhchung'
    ];
    //khóa ngoại madv từ doanvien(madv)
    public function doanvien()
    {
        return $this->belongsTo(doanvien::class, 'madv', 'madv');
    }
    //khóa ngoại đotg(madot)
    public function dotdg()
    {
        return $this->belongsTo(dotdg::class, 'madot', 'madot');
    }
    //khóa ngoại tieuchi(matc)
    public function tieuchi()
    {
        return $this->belongsTo(tieuchi::class, 'matc', 'id');
    }
    public $timestamps = false;
}
