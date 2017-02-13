<?php

namespace ShittyAdvice\MicroBlog\Models;

use Microizer\User;
use Illuminate\Database\Eloquent\Model;
use ShittyAdvice\MicroBlog\Presenters\PostPresenter;
use McCool\LaravelAutoPresenter\HasPresenter;

class Post extends Model implements HasPresenter
{
    protected $fillable = ['title', 'slug', 'body', 'excerpt', 'author_id', 'published_at'];

    protected $dates = ['published_at'];

	public function scopeWhereSlug($query, $slug)
	{
        return $query->where('slug', $slug);
	}

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = $value ?: null;
    }

    public function getPresenterClass()
    {
        return PostPresenter::class;
    }
}
