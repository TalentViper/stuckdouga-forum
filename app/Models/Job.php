<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    public $table = 'jobs';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [        
        'id',
        'booking_id',
        'team_id',
        'scheduled_date_time',
        'job_started_date_time',
        'job_hours',
        'job_stopwatch',
        'job_extras',
        'total_job_price',
        'amount_to_pay',
        'payment_method',
        'payment_date_time',
        'payment_history',
        'before_job_photos',
        'after_job_photos',
        'job_ranking',
        'job_comments',
        'employee_earning',
        'reported_problem',
        'invoice',
        'status',
        'created_at',
        'updated_at'        
    ];
    
    public function team()
    {
        return $this->belongsTo(\App\Models\Team::class, 'team_id', 'id');
    }

    public function booking()
    {
        return $this->belongsTo(\App\Models\Booking::class, 'booking_id', 'id');
    }

    public function rating()
    {
        return $this->belongsTo(\App\Models\Rating::class, 'job_ranking', 'id');
    }
}
