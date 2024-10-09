<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputText extends Model
{
    use HasFactory;
    protected $table = 'input_texts';
    protected $fillable = ['content'];
    public function wordFrequencies()
    {
        return $this->hasMany(WordFrequency::class);
    }

}
