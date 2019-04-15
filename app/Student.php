<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name','last_name','email','phone','group_id','faculty_id'];
    protected $table = 'students';

    public function get_faculty()
    {
        return $this->belongsTo('App\Faculty','faculty_id','id');
    }

    public function get_group()
    {
        return $this->hasMany('App\Group','id','group_id');
    }
}
