<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'email',
        'password',
        'role',
        'dob',
        'address',
        'phone',
        'image',
        'status',
        'position_id',
        'department_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
        $users = User::query();
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
        return $this->belongsTo(User::class, 'id')->withTrashed();
    }
}
