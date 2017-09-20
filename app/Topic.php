<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'edito', 'published', 'image', 'category_id'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['active'];

    protected $visible = ['articles', 'title', 'edito', 'published', 'image', 'category_id', 'active'];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getActiveAttribute()
    {
        return false;
    }
}
