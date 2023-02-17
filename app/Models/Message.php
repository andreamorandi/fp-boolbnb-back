<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['lead_first_name', 'lead_last_name', 'lead_email', 'text'];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
