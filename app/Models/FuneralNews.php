<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Wreath;
use App\Models\Note;

class FuneralNews extends Model
{
    use HasFactory;
    protected $table = 'funeral_news';
    protected $fillable = ['officer_name'
                        ,'officer_location'
                        ,'deceased'
                        ,'relationship'
                        ,'funeral_location'
                        ,'start_funeral'
                        ,'end_funeral'
                        ,'pray_funeral'
                        ,'cremation_ceremony'
                        ,'cremation_ceremon_location'
                        ,'funeral_news_status'
                        ,'wreath_id'];

    public function wreath()
    {
        return $this->belongsTo(Wreath::class, 'wreath_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'funeral_news_id', 'id');
    }
}
