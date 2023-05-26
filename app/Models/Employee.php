<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'birth_date',
        'department_id',
        'country',
        'city',
        'address',
        'zip_code',
        'date_hired',
    ];

    public function tasks() {
        return $this->hasMany(Task::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

}
