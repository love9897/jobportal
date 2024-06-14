<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function getCity()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
    public function getState()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }
    public function getCountry()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }
    public function getExperience()
    {
        return $this->hasOne(Experience::class, 'id', 'experience_id');
    }

    public function getProfileSkills()
    {
        return $this->hasMany(Job_skill::class, 'employee_id', 'employee_id');
    }

    

}
