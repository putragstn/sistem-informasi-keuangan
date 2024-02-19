<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Salary;

class EmployeeSalary extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'karyawan_id');
    }

    public function salary()
    {
        return $this->belongsTo(Salary::class, 'gaji_id');
    }
}
