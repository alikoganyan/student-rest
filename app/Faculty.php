<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = ['name'];

    protected $table = 'faculties';

    public function get_group()
    {
        return $this->hasMany('App\Group');
    }
}
