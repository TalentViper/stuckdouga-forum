<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RubbishItem extends Model
{
    use HasFactory;

    public $table = 'rubbish_items';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
    */
    protected $fillable = [        
        'id',
        'name',
        'price',
        'discount'
    ];
}
