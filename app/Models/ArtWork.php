<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtWork extends Model
{
    use HasFactory;

    public $table = 'artworks';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [        
        'id',
        'img_main',
        'thumbnail',
        'desc',
        'type',
        'section',
        'info',
        'visibility',
        'layers',
        'sketch',
        'snb',
        'condition',
        'oversize',
        'source',
        'background',
        'stype',
        'keyart',
        'bookart',
        'endart',
        'pdesc',
        'players',
        'psketch',
        'psnb',
        'created_at',
        'updated_at',
        'id',
        'gallery_id'
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function usersWhoLiked()
    {
        return $this->belongsToMany(User::class, 'artwork_likes');
    }

    public function isLikedByUser()
    {
        return $this->usersWhoLiked()->where('user_id', auth()->id())->exists();
    }
}