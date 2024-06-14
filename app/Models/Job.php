<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = ['job_title', 'job_description', 'employer_id','experience_id', 'job_description','salary_id','job_validity'];

    public function getSkill()
    {
        return $this->hasMany(Job_skill::class, 'job_id', 'id');
    }
    public function getLanguage()
    {
        return $this->hasOne(Job_language::class, 'job_id', 'id');
    }
    public function getEmployer()
    {
        return $this->hasOne(Employer::class, 'employer_id', 'employer_id');
    }
    public function getExperience()
    {
        return $this->hasOne(Experience::class, 'id', 'experience_id');
    }
    public function getSalary()
    {
        return $this->hasOne(Salary::class, 'id', 'salary_id');
    }
    
    public function inquery()
    {
        return $this->hasMany(Job_inquiries::class, 'job_id', 'id');

    }
    

}
