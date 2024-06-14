<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_language extends Model
{
    use HasFactory;
    protected $table = 'job_languages';
    protected $fillable = ['job_id', 'language_id'];
}
