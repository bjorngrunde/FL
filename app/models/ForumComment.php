<?php

use Family\Eventing\EventGenerator;
use Family\Forum\ForumCommentWasPosted;
class ForumComment extends Eloquent
{
    use EventGenerator;

    protected $table = 'forum_comments';
	protected $fillable = ['body', 'author_id', 'group_id', 'category_id'];

    public function post($body, $author, $groupId, $threadId, $categoryId)
    {
        $this->body = $body;
        $this->author_id = $author;
        $this->group_id = $groupId;
        $this->thread_id = $threadId;
        $this->category_id = $categoryId;

        $this->save();

        $this->raise(new ForumCommentWasPosted($this));

        return $this;
    }
    protected $touches = ['thread'];

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
    public function thread()
    {
        return $this->belongsTo('ForumThread');
    }
}