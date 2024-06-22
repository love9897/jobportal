<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['employer_id', 'employee_id', 'msg', 'is_read', 'role', 'origin'];


    public function chatToEmployee()
    {
        return $this->hasOne(User::class, 'id', 'employee_id');
    }
    public function chatToEmployer()
    {
        return $this->hasOne(User::class, 'id', 'employer_id');
    }
}
