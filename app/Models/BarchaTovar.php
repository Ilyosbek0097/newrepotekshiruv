<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarchaTovar extends Model
{
    use HasFactory;
    protected $fillable = [
        'tovar_kodi',
        'tovar_nomi',
        
    ];
    protected $table = 'barcha_tovarlar';
    
    public $timestamps = false;
}
