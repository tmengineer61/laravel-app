<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'm_genres'; // ここで任意の名前を設定

    protected $primaryKey = 'genre_code';

    // auto increment じゃないPrimaryKeyの場合は、stringに設定する
    // PrimaryKeyの値が勝手にintにキャストされてしまうのを防ぐ
    protected $keyType = 'string';


}
