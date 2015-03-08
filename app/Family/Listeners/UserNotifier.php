<?php

namespace Family\Listeners;
use Family\Eventing\EventListener;
use Family\Forum\ThreadWasPosted;
use Family\Forum\ThreadWasUpdated;
use Family\Forum\CommentWasPosted;
use User;
use Auth;
use ForumComment;
use ForumThread;
class UserNotifier extends EventListener
{
    public function whenThreadWasPosted(ThreadWasPosted $event)
    {
        $user = User::find($event->forumThread->author_id);

        $user->newNotification()
            ->withType('ThreadWasPosted')
            ->withSubject('En ny tråd har skapats')
            ->withBody('<span class="'.Auth::user()->profile->klass.'">'.Auth::user()->username.'</span> har skapat en ny tråd, <a href="/forum/thread/'. $event->forumThread->id. '">'. $event->forumThread->title.'</a>')
            ->regarding($event->forumThread)
            ->deliver();
    }

    public function whenThreadWasUpdated(ThreadWasUpdated $event)
    {
        $user = User::find(Auth::user()->id);

        $user->newNotification()
            ->withType('ThreadWasUpdated')
            ->withSubject('En tråd har redigerats')
            ->withBody('<span class="'.Auth::user()->profile->klass.'">'.Auth::user()->username.'</span> har redigerat tråden, <a href="/forum/thread/'. $event->forumThread->id. '">'. $event->forumThread->title.'</a>')
            ->regarding($event->forumThread)
            ->deliver();
    }

    public function whenCommentWasPosted(CommentWasPosted $event)
    {
        $thread = ForumThread::find($event->comment->thread_id);

        $thread_author = User::whereId($thread->author_id)->first();

        if($thread->author->username != Auth::user()->username) {
            $thread_author->newNotification()
                ->from(Auth::user())
                ->withType('CommentWasPosted')
                ->withSubject('En ny kommentar på din tråd!')
                ->withBody('<li><a href="/forum/thread/' . $thread->id . '"> {{users}} har lämnat en kommentar på din tråd: <br />' . $thread->title . '</a></li>')
                ->regarding($event->comment)
                ->deliver();
        }
        $comment_user = User::whereHas('comments', function($q) use($thread){
            $q->where('thread_id', '=', $thread->id);
        })->get();

        foreach($comment_user as $user)
        {
            if(Auth::user()->id != $user->id && $thread_author->id != $user->id)
            {
            $user->newNotification()
                ->from(Auth::user())
                ->withType('CommentWasPosted')
                ->withSubject('En ny kommentar')
                ->withBody('<li><a href="/forum/thread/'.$thread->id.'"> {{users}} har lämnat en kommentar på en tråd du deltar i</a></li>')
                ->regarding($event->comment)
                ->deliver();
            }
        }

    }
} 