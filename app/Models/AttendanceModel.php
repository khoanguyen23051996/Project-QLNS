<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceModel extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'attendances';

    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'checkin_at',
        'checkout_at',
    ];

    public function checkin(){
        return $this->belongsTo(User::class, 'userid');
    }

    public function checkout(){
        return $this->belongsTo(User::class, 'userid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
