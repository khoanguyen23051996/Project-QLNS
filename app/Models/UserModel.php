<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

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

    public static function indexSearch($requestData){
        $page = $requestData['page'] ?? 1;
        $length = $requestData['length'] ?? 5;
        $name = $requestData['name'] ?? null ;
        $status = $requestData['status'] ?? null ;
        $users = UserModel::query();
        if($name){
            $users->where('name', 'LIKE', "%$name%");
        }
        if($status){
            $users->where('status', $status);
        }
        $totalUser = $users->count();   
        $totalPage = (floor($totalUser / $length) + (($totalUser % $length) ? 1 : 0) );
        $users = $users->offset(($page-1)*$length)->limit($length)->get();
        return [
            'users' => $users,
            'page' => $page,
            'length' => $length,
            'totalUser' => $totalUser,
            'totalPage' => $totalPage,
            'name' => $name,
            'status' => $status,
        ];
    }

    public function user(){
        return $this->belongsTo(UserModel::class, 'id')->withTrashed();
    }
}
