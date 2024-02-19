<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Debt;
use App\Models\Salary;
use App\Models\User;
use App\Models\EmployeeSalary;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function debt()
    {
        return $this->hasMany(Debt::class);
    }

    public function salary()
    {
        return $this->belongsTo(Salary::class, 'salary_id');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function employeeSalary()
    {
        return $this->hasMany(EmployeeSalary::class);
    }
}
