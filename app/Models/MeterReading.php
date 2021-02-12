<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeterReading extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id',
        'from_date',
        'present_reading_kwh',
        'to_date',
        'previous_reading_kwh',
        'consumed_kwh',
        'rate',
        'bill',
    ];
    
}