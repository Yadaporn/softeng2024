<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    // If you have a different table name, you can specify it like this:
    protected $table = 'subjects';

    // If your primary key is not 'id' or you have a non-incrementing
    // or a non-numeric primary key, you need to define it in your model:
    protected $primaryKey = 'id';

    // If you want to make all attributes mass assignable, you can define:
    protected $guarded = [];
    // Or, if you want to make only specific attributes mass assignable, you can define:
    protected $fillable = ['sbj_course', 'sbj_year', 'sbj_semester', 'sbj_name', 'sbj_number_of_students', 'sbj_day', 'sbj_start', 'sbj_end', 'sbj_sec', 'sbj_major', 'sbj_teacher'];
}
