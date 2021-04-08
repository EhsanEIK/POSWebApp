<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable=['title'];

    public function User()
    {
    	return $this->hasMany(User::class);
    }

    public static function arrayForSelect()
    {
    	$groups=Group::all();
        $arr= [];
        foreach ($groups as $group)
        {
            $arr[$group->id]=$group->title;
        }
        return $arr;
    }
}
