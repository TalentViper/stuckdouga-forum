<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public $table = 'teams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'employee_ids',
        'description',
        'status',
        'availablity',
        'total_jobs',
        'pending_jobs',
        'created_at',
        'updated_at'        
    ];
}
