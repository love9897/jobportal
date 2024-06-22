<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    public function getState()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }
    public function jobs()
    {
        return $this->hasMany(Job::class, 'employer_id', 'id');

    }

    public function employerToUser()
    {
        return $this->hasOne(User::class, 'id', 'employer_id');
    }



}
