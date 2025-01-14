<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtWorkItem extends Model
{
    use HasFactory;

    public $table = 'artworkitems';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [        
        'id',
        'artwork_id',
        'type',
        'img',
        'visible',
        'title',
    ];
}