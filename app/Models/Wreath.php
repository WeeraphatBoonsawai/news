<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FuneralNews;

class Wreath extends Model
{
    use HasFactory;
    protected $table = 'wreath';
    protected $fillable = ['wreath_images'];

    public function funeralNews()
    {
    return $this->belongsTo(FuneralNews::class, 'funeral_news_id');
    }
}
