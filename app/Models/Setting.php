<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'paypal_email',
        'paypal_api_key',
        'paypal_api_password',
        'stripe_email',
        'stripe_api_key',
        'stripe_api_password',
        'google_api_key',
        'hourly_rate',
        'jumbo_bag_rate'
    ];
}
