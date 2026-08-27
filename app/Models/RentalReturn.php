<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RentalReturn extends Model
{
    protected $guarded = [];
    public function bookingDetail() { return $this->belongsTo(BookingDetail::class); }
}