<?php

use Family\Eventing\EventGenerator;
use Family\Forum\ThreadWasPosted;
use Family\Forum\ThreadWasUpdated;

class ForumThread extends Eloquent
{
    use EventGenerator;

    protected $table = 'forum_threads';
	protected $fillable = ['title', 'body', 'group_id', 'category_id', 'author_id'];

    public function post($title, $body, $category_id, $author_id, $group_id)
    {
        $this->title = $title;
        $this->body = $body;
        $this->category_id = $category_id;
        $this->author_id = $author_id;
        $this->group_id = $group_id;

        $this->save();

        $locked = new ForumLocked;
        $locked->locked = false;
        $locked->thread_id = $this->id;
        $locked->save();

        $sticky = new Sticky;
        $sticky->forum_thread_id = $this->id;
        $sticky->isSticky = false;
        $sticky->save();

        $this->locked()->save($locked);
        $this->sticky()->save($sticky);

        $this->raise(new ThreadWasPosted($this));

        return $this;

    }

    public function edit($title, $body)
    {
        $this->title = $title;
        $this->body = $body;
        $this->save();

        $this->raise(new ThreadWasUpdated($this));
        return $this;
    }
    public function author()
    {
        return $this->belongsTo('User', 'author_id');
    }
    public function group()
    {
        return $this->belongsTo('ForumGroup');
    }

    public function category()
    {
        return $this->belongsTo('ForumCategory');
    }

    public function comments()
    {
        return $this->hasMany('ForumComment', 'thread_id')->orderBy('created_at', 'desc');
    }
    public function locked()
    {
        return $this->hasOne('ForumLocked', 'thread_id');
    }
    public function sticky()
    {
        return $this->hasOne('Sticky')->orderBy('isSticky', 'asc');
    }
}