<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    public $table = 'discounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'title',
        'code',
        'type',
        'visibility',
        'amount',
        'valid_from',
        'valid_until',
        'usage',
        'status',
        'send_email',
        'created_at',
        'updated_at'
    ];
}
