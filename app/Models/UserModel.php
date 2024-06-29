<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'position',
        'status',
    ];

    public $timestamps = true;

    protected $table = 'users';

    protected $guarded = [];

    public function getStatusTextAttribute() {
        return $this->status == 1 ? 'Đang hoạt động' : 'Không hoạt động';
    }
}
