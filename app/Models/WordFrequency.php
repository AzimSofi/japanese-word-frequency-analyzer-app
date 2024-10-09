<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordFrequency extends Model
{
    use HasFactory;
    protected $table = 'word_frequency';

    protected $fillable = ['input_text_id', 'word', 'frequency'];
    public function inputText()
    {
        return $this->belongsTo(InputText::class);
    }
}
