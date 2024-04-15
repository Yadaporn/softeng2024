<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    // If you have a different table name, you can specify it like this:
    protected $table = 'tb_build';

    // If your primary key is not 'id' or you have a non-incrementing
    // or a non-numeric primary key, you need to define it in your model:
    protected $primaryKey = 'crs_id';

    // You can specify default attribute values like this:
    protected $attributes = [
        'status' => 'active',
    ];

    // If you want to make all attributes mass assignable, you can define:
    protected $guarded = [];
    public $timestamps = true;
    // Or, if you want to make only specific attributes mass assignable, you can define:
    protected $fillable = ['crs_room', 'crs_build', 'crs_Number_of_students'];
}
