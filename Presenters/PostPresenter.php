<?php

namespace Microizer\Plugins\MicroBlog\Presenters;

use Microizer\Plugins\MicroBlog\Models\Post;
use McCool\LaravelAutoPresenter\BasePresenter;

class PostPresenter extends BasePresenter
{
    public function __construct(Post $resource)
    {
        $this->wrappedObject = $resource;
    }

    public function published_date()
    {
        if($this->published_at){
            return $this->published_at->toFormattedDateString();
        }
        return 'Not Published';
    }

    public function published_diff()
    {
        if($this->published_at){
            return $this->published_at->diffForHumans();
        }
        return 'Not Published';
    }

    public function published_highlight()
    {
        if($this->published_at && $this->published_at->isFuture())
        {
            return 'info';
        }
        else if(! $this->published_at)
        {
            return 'warning';
        }
    }
}
