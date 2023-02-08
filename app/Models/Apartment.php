<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'room_number', 'bed_number', 'bathroom_number', 'surface_sqm', 'full_address', 'image', 'is_visible', 'slug', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
