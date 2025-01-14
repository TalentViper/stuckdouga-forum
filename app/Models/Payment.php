<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $table = 'payments';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'job_id',
        'user_id',
        'rubbish_id',
        'booking_id',
        'payment_amount',
        'customerName',
        'address',
        'method',
        'created_date'
    ];

    public function rubbish()
    {
        return $this->belongsTo(\App\Models\Rubbish::class, 'rubbish_id', 'id');
    }

    public function booking()
    {
        return $this->belongsTo(\App\Models\Booking::class, 'booking_id', 'id');
    }

    public function job()
    {
        return $this->belongsTo(\App\Models\Job::class, 'job_id', 'id');
    }

}
