<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class tkadmin extends Authenticatable
{
    use HasFactory;
    protected $table  = 'tkadmin';
    protected $primaryKey = 'username_admin';
    protected $keyType = 'string';

    protected $fillable = [
        'username_admin',
        'password',
        'role',
        'active',
    ];
    
    public $timestamps = false;
}
