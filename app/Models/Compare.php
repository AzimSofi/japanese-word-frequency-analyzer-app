<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compare extends Model
{
    protected $table = 'compares';
    protected $fillable = ['content'];
    use HasFactory;
}
