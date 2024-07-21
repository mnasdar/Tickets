<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function startDate(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->translatedFormat('d M y'),
            set: fn($value) => Carbon::parse($value)->translatedFormat('Y-m-d'),
        );
    }
    public function endDate(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->translatedFormat('d M y'),
            set: fn($value) => Carbon::parse($value)->translatedFormat('Y-m-d'),
        );
    }
}
