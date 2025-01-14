<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    public $table = 'forums';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [        
        'forum_id',
        'topic',
        'article',
        'user_id',
        'ban_id',
        'article_status',
        'created_at',
        'updated_at'        
    ];
}