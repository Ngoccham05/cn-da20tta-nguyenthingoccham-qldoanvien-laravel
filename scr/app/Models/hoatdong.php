<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hoatdong extends Model
{
    use HasFactory;
    protected $table  = 'hoatdong';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'tenhd',
        'thoigian',
        'diadiem',
        'mota',
        'minhchung',
    ];

//khóa chính cho tham gia
    public function thamgia()
    {
        return $this->hasMany(thamgia::class, 'id');
    }    
    public $timestamps = false;
}
