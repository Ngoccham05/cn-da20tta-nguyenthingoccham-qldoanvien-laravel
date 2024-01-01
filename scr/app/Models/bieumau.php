<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bieumau extends Model
{
    use HasFactory;
    protected $table  = 'bieumau';
    protected $primarykey = 'id';

    protected $fillable = [
        'id',
        'tenbm',
        'duongdan'
    ];
    public $timestamps = false;
}
