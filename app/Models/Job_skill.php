<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_skill extends Model
{
    use HasFactory;
    protected $table = 'job_skills';
    protected $fillable = ['job_id', 'skill_id', 'employee_id'];

    public function getSkillName()
    {
        return $this->hasOne(Skill::class, 'id', 'skill_id');
    }
}
