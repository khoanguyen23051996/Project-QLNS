<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class DepartmentModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
    ];
    
    protected $table = 'departments';

    protected $guarded = [];

    public static function getDepartmentCounts()
    {
        // SELECT departments.name, COUNT(users.id) AS total_users 
        // FROM departments 
        // LEFT JOIN users ON departments.id = users.department_id 
        // GROUP BY departments.id;
        return self::select('departments.name', DB::raw('COUNT(users.id) as total_users'))
            ->join('users', 'departments.id', '=', 'users.department_id')
            ->where('users.status', '=', 1)
            ->groupBy('departments.id', 'departments.name')
            ->get();
    }

    public function department(){
        return $this->belongsTo(User::class, 'departmentid')->withTrashed();
    }

    public function users()
    {
        return $this->hasMany(User::class, 'department_id');
    }
}
