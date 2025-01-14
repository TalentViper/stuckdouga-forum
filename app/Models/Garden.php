<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garden extends Model
{
    use HasFactory;

    public $table = 'gardens';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [        
        'id',
        'front_pres',
        'back_pres',
        'condition',
        'front_size',
        'back_size',
        'parking',
        'created_at',
        'updated_at'        
    ];
}
