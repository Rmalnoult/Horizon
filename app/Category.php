<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'color', 'image'
    ];

    protected $visible = ['topics', 'name', 'color', 'image'];

    public function topics()
    {
        return $this->hasMany('App\Topic')->with('articles');
    }
}
