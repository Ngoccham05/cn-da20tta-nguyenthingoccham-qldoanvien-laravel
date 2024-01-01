<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhgiacd extends Model
{
    use HasFactory;
    protected $table  = 'danhgiacd';
    protected $primarykey = ['macd','madot'];

    protected $fillable = [
        'macd',
        'maloaicd',
        'madot',
    ];
//khóa ngoại macd từ chidoan(macd)
    public function chidoan()
    {
        return $this->belongsTo(chidoan::class, 'macd', 'macd');
    }

//khóa ngoại maloaicd từ loaicd(id)
    public function loaicd()
    {
        return $this->belongsTo(loaicd::class, 'maloaicd', 'id');
    }
    
//khóa ngoại madot từ dotdg(madot)
public function dotdg()
{
    return $this->belongsTo(dotdg::class, 'madot', 'madot');
}

    public $timestamps = false;
}
