<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $table = 'contact';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [        
        'id',
        'name',
        'email',
        'location',
        'subject',
        'message',
        'status',
        'created_at',
        'updated_at'        
    ];
}