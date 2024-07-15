<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        return $this->status == 1 ? 'Đang làm việc' : 'Đã nghỉ việc';
    }

    public static function indexSearch($requestData){
        // $page = $requestData['page'] ?? 1;
        // $length = $requestData['length'] ?? 5;
        $name = $requestData['name'] ?? null ;
        $status = $requestData['status'] ?? null ;
        $position = $requestData['position'] ?? null ;
       
        $users = User::query();
        if($name){
            $users->where('name', 'LIKE', "%$name%");
        }
        if($status){
            $users->orwhere('status', $status);
        }

        if($position){
            $users->orwhere('position_id', $position);
        }

        $users = $users->paginate(5);
        return [
            'user' => Auth()->user(),
            'users' => $users,
            'name' => $name,
            'status' => $status,
            'position' => $position,
        ];
    }

    public static function getStatusCounts()
    {
        return self::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();
    }

    public function user(){
        return $this->hasMany(User::class, 'user')->withTrashed();
    }

    public function position()
    {
        return $this->belongsTo(PositionModel::class,'position_id');
    }

    public function department()
    {
        return $this->belongsTo(DepartmentModel::class,'department_id');
    }

    public function attendances()
    {
        return $this->hasMany(AttendanceModel::class, 'user_id');
    }
}
