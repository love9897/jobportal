<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_inquiries extends Model
{
    use HasFactory;



    protected $fillable = ['job_id', 'employee_id'];
    public function getinqeries()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }
    public function employee()
    {
        return $this->hasOne(User::class, 'id', 'employee_id');
    }
    public function jobs()
    {
        return $this->hasOne(Job::class, 'id', 'job_id');
    }

    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'employee_id');
    }


}
