<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialGenre extends Model
{
    use HasFactory;

    protected $table = 'm_special_genres'; // ここで任意の名前を設定

    protected $primaryKey = 'genre_code';

    protected $keyType = 'string';

}
