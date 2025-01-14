<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    public $table = 'gallerys';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [        
        'id',
        'gallery_name',
        'gallery_url',
        'gallery_date',
        'gallery_popularity',
        'gallery_status',
        'created_at',
        'updated_at',        
        'description',
        'type',
        'tags',
        'series',
        'user_id',
        'likes',
        'views',
        'artwork_count'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function artworks()
    {
        return $this->hasMany(ArtWork::class);
    }

    public function usersWhoLiked()
    {
        return $this->belongsToMany(User::class, 'gallery_likes');
    }

    public function isLikedByUser()
    {
        return $this->usersWhoLiked()->where('user_id', auth()->id())->exists();
    }
}