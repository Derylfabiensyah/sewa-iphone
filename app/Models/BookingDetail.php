<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected $guarded = [];
    public function booking() { return $this->belongsTo(Booking::class); }
    public function iphone() { return $this->belongsTo(Iphone::class); }
    public function rentalReturn() { return $this->hasOne(RentalReturn::class); }
}