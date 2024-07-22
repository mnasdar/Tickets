<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenerateTicket extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function scanticket()
    {
        return $this->hasOne(ScanTicket::class);
    }
}
