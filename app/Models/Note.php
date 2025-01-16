<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FuneralNews;

class Note extends Model
{
    use HasFactory;
    protected $table = 'notes';
    protected $fillable = ['note_text','funeral_news_id'];

    public function funeralNews()
    {
        return $this->belongsTo(FuneralNews::class, 'funeral_news_id', 'id');
    }
}
