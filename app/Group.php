<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name','faculty_id'];

    protected $table = 'groups';

    public function get_faculty()
    {
        return $this->belongsTo('App\Faculty','faculty_id','id');
    }

}
