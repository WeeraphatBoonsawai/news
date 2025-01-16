<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NewsType;
use App\Models\NewsFile;
use App\Models\Agency;
use App\Models\User;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $fillable = ['news_title',
                            'news_link',
                            'news_detail',
                            'news_status',
                            'start_announcing',
                            'end_announcing',
                            'news_type_id',
                            'agency_id',
                            'user_id'
                        ];

    public function news_type()
    {
       return $this->belongsTo(NewsType::class,'news_type_id');
    }

    public function news_file()
    {
       return $this->hasMany(NewsFile::class, 'news_id');
    }

    public function agency()
    {
       return $this->belongsTo(Agency::class, 'agency_id');
    }

    public function newsFiles()
   {
    return $this->hasMany(NewsFile::class, 'news_id');
   }

   public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
