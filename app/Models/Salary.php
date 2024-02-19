<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\EmployeeSalary;

class Salary extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function employee()
    {
        return $this->hasMany(Employee::class, 'salary_id');
    }

    public function employeeSalary()
    {
        return $this->hasMany(EmployeeSalary::class, 'gaji_id');
    }
}
