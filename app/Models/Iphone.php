<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Iphone extends Model
{
    protected $guarded = [];
    public function bookingDetails() { return $this->hasMany(BookingDetail::class); }
    public function reviews() { return $this->hasMany(Review::class); }
}