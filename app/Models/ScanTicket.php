<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScanTicket extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function generateTicket()
    {
        return $this->belongsTo(GenerateTicket::class);
    }
}
