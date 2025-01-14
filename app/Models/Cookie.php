<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Justijndepover\CookieConsent\Concerns\InteractsWithCookies; // add this line

class Cookie extends Model
{
    use InteractsWithCookies; // add this line

    public $table = 'cookies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'length',
        'content',
        'created_at',
        'updated_at'
    ];
}
