<?php



class Application extends Eloquent
{
    protected $table = 'applications';

    protected $fillable = [
        'name',
        'lastName',
        'username',
        'email',
        'server',
        'talents',
        'armory',
        'choices',
        'played',
        'playClass',
        'bio',
        'raidExperience',
        'reasonToApplyFl',
        'oldGuild',
        'progressRaid',
        'attendance',
        'screenshot',
        'other',
        'klass'
    ];

    protected $guarded = ['id'];

    /**
     * @return mixed
     */
    public function status()
    {
        return $this->belongsTo('Status');
    }
    public function comments()
    {
        return $this->morphMany('Fbf\LaravelComments\Comment', 'commentable');
    }
}
