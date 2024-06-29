<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'department';

    protected $guarded = [];

    public function department(){
        return $this->hasMany(User::class, 'departmentid')->withTrashed();
    }
}
