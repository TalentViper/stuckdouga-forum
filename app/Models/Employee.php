<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $table = 'employees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'team_id',
        'first_name',
        'last_name',
        'email',        
        'phone',
        'password',
        'address',        
        'postcode',
        'city',
        'age',
        'van',
        'about',
        'cv',
        'id_document',
        'photo',
        'admin_comments',
        'extra_files',                  
        'status',
        'primary',
        'created_at',
        'updated_at'        
    ];
}
