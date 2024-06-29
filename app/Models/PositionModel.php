<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PositionModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'positions';

    protected $guarded = [];

    protected $fillable = [
        'name',
        'code',
    ];

    public function position(){
        return $this->hasMany(User::class, 'id')->withTrashed();
    }
}
