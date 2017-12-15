<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gun extends Model{

    protected $table = 'gun';
    protected $fillable = ['imagen', 'nombre', 'calibre','tipo','balas','retroceso'];

}