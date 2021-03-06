<?php

use Config,
    Lang,
    Family\Eventing\EventGenerator,
    Family\Comments\CommentWasPosted;

class Comment extends \Fbf\LaravelComments\Comment
{
    use EventGenerator;
    protected $table = 'fbf_comments';

    protected $fillable = array(
        'commentable_type',
        'commentable_id',
        'comment',
        'user_id',
    );

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function post($commentable_type, $commentable_id, $comment, $user_id)
    {
        $this->commentable_type = $commentable_type;
        $this->commentable_id = $commentable_id;
        $this->comment = $comment;
        $this->user_id = $user_id;

        $this->save();

        $this->raise(new CommentWasPosted($this));

        return $this;
    }
    /**
     * Returns a string representing the record that the comment was on. This is normally the name or title field of the
     * commentable model. E.g. the title of the Blog Post. The method checks to see if the commentable model has a method
     * called getCommentableTitle() first, else it checks for a field called title and then one called name. If none of
     * the cases are met, an exception is thrown.
     *
     * @return string
     * @throws \Exception
     */
    public function getOnTitleAttribute()
    {
        $commentable = $this->commentable;

        if ( ! is_object($commentable) || ! method_exists($commentable, 'getAttributes') )
        {
            return FALSE;
        }

        $attributes = $commentable->getAttributes();

        if (method_exists($commentable, 'getCommentableTitle'))
        {
            $on = $commentable->getCommentableTitle();
        }
        elseif (array_key_exists('title', $attributes))
        {
            $on = $attributes['title'];
        }
        elseif (array_key_exists('name', $attributes))
        {
            $on = $attributes['name'];
        }
        else
        {
            throw new \Exception(sprintf('%s model does not have title or name attribute, nor implements getCommentableTitle() method', get_class($commentable)));
        }

        return \Str::limit($on, 50);

    }

    public function getCommentForAdministratorAttribute($value)
    {
        return \Str::limit(htmlspecialchars($value, null, 'UTF-8'), 50);
    }

    /**
     * Returns the validation rules for the comment
     *
     * @param string $commentableType The namespaced model that is being commented on
     * @return array
     */
    public function getRules($commentableType)
    {
        $commentableObj = new $commentableType;
        $table = $commentableObj->getTable();
        $key = $commentableObj->getKeyName();
        $rules = array(
            'commentable_type' => 'required|in:'.implode(',', Config::get('laravel-comments::commentables')),
            'commentable_id' => 'required|exists:'.$table.','.$key,
            'comment' => 'required',
        );
        return $rules;
    }

    /**
     * Returns the URL of the comment constructed based on the URL of the commentable object, plus the anchor of the
     * comment
     *
     * @return string
     */
    public function getUrl()
    {
        $commentable = $this->commentable;

        $url = false;
        if (method_exists($commentable, 'getUrl'))
        {
            $url = $commentable->getUrl();
        }

        return \URL::to($url.'#C'.$this->id);
    }

    public function getDate()
    {
        $date = $this->created_at;
        if (Lang::has('laravel-comments::messages.date_timezone'))
        {
            $oldTimezone = date_default_timezone_get();
            $newTimezone = Lang::get('laravel-comments::messages.date_timezone');
            $date->setTimezone($newTimezone);
            date_default_timezone_set($newTimezone);
        }
        $locale = \App::getLocale();
        if (Lang::has('laravel-comments::messages.date_locale'))
        {
            $locale = Lang::get('laravel-comments::messages.date_locale');
        }
        setlocale(LC_TIME, $locale);
        $dateFormat = trans('laravel-comments::messages.date_format');
        if ($dateFormat == 'laravel-comments::messages.date_format')
        {
            $dateFormat = '%e %B %Y at %H:%M';
        }
        $date = $date->formatLocalized($dateFormat);
        if (Lang::has('laravel-comments::messages.date_timezone'))
        {
            date_default_timezone_set($oldTimezone);
        }
        return $date;
    }

} 