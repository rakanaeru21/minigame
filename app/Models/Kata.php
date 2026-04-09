<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kata extends Model
{
    public $timestamps = false;

    protected $table = 'kata';

    protected $fillable = ['kata_1', 'kata_2'];
}
