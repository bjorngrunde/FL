<?php

namespace Family\Listeners;
use Family\Eventing\EventListener;
use Family\Forum\ThreadWasPosted;
use Family\Forum\ThreadWasUpdated;
use Family\Forum\ForumCommentWasPosted;
use Family\Comments\CommentWasPosted;
use User;
use Auth;
use ForumComment;
use ForumThread;
use Raid;
use Comment;
use Application;
use Album;
use Photo;
use Post;
class UserNotifier extends EventListener
{
    public function whenThreadWasPosted(ThreadWasPosted $event)
    {
        $user = User::find($event->forumThread->author_id);

        $user->newNotification()
            ->withType('ForumThreadWasPosted')
            ->withSubject('En ny tråd har skapats')
            ->withBody('<span class="'.Auth::user()->profile->klass.'">'.Auth::user()->username.'</span> har skapat en ny tråd, <a href="/forum/thread/'. $event->forumThread->id. '">'. $event->forumThread->title.'</a>')
            ->regarding($event->forumThread)
            ->deliver();
    }

    public function whenThreadWasUpdated(ThreadWasUpdated $event)
    {
        $user = User::find(Auth::user()->id);

        $user->newNotification()
            ->withType('ForumThreadWasUpdated')
            ->withSubject('En tråd har redigerats')
            ->withBody('<span class="'.Auth::user()->profile->klass.'">'.Auth::user()->username.'</span> har redigerat tråden, <a href="/forum/thread/'. $event->forumThread->id. '">'. $event->forumThread->title.'</a>')
            ->regarding($event->forumThread)
            ->deliver();
    }

    public function whenForumCommentWasPosted(ForumCommentWasPosted $event)
    {
        $thread = ForumThread::find($event->comment->thread_id);

        $thread_author = User::whereId($thread->author_id)->first();

        if($thread->author->username != Auth::user()->username) {
            $thread_author->newNotification()
                ->from(Auth::user())
                ->withType('CommentWasPosted')
                ->withSubject('En ny kommentar på din tråd!')
                ->withBody('<li><a href="/forum/thread/' . $thread->id . '"> {{users}} har lämnat en kommentar på din tråd: <br /><span class="blue">' . $thread->title . '</span></a></li>')
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
                ->withBody('<li><a href="/forum/thread/'.$thread->id.'"> {{users}} har lämnat en kommentar på:<br /><span class="blue">'.$thread->title.'</span></a></li>')
                ->regarding($event->comment)
                ->deliver();
            }
        }
        $author = Auth::user();
        $author->newNotification()
            ->withType('ForumCommentWasPosted')
            ->withSubject('En ny kommentar')
            ->withBody('<span class="'.Auth::user()->profile->klass.'">'.Auth::user()->username.'</span> har lämnat en kommentar på tråden, <a href="/forum/thread/'. $thread->id. '">'. $thread->title.'</a>')
            ->regarding($event->comment)
            ->deliver();

    }

    public function whenCommentWasPosted(CommentWasPosted $event)
    {
        switch($event->comment->commentable_type) {
            case 'Raid':
                $commenter = Comment::whereCommentable_id($event->comment->commentable_id)->whereCommentable_type($event->comment->commentable_type)->get();
                $raid = Raid::find($event->comment->commentable_id);
                foreach ($commenter as $author) {
                    $user = User::find($author->user_id);
                    if ($user->id != $event->comment->user_id) {
                        $user->newNotification()
                            ->from(Auth::user())
                            ->withType('RaidCommentWasPosted')
                            ->withSubject('En ny kommentar')
                            ->withBody('<li><a href="/flrs/show/' . $event->comment->commentable_id . '"> {{users}} har lämnat en kommentar på:<br /><span class="blue">' . $raid->title . ' med datum ' . $raid->time . '</span></a></li>')
                            ->regarding($event->comment)
                            ->deliver();
                    }
                }
                break;
            case 'Application':

                $commenter = Comment::whereCommentable_id($event->comment->commentable_id)->whereCommentable_type($event->comment->commentable_type)->get();
                $application = Application::find($event->comment->commentable_id);
                foreach ($commenter as $author) {
                    $user = User::find($author->user_id);
                    if ($user->id != $event->comment->user_id) {
                        $user->newNotification()
                            ->from(Auth::user())
                            ->withType('ApplicationCommentWasPosted')
                            ->withSubject('En ny kommentar')
                            ->withBody('<li><a href="/admin/applications/' . $event->comment->commentable_id . '"> {{users}} har lämnat en kommentar på:<br /><span class="blue">' . $application->name . ' ' . $application->lastName . 's ansökan </span></a></li>')
                            ->regarding($event->comment)
                            ->deliver();
                    }
                }
                break;
            case 'Album':

                $commenter = Comment::whereCommentable_id($event->comment->commentable_id)->whereCommentable_type($event->comment->commentable_type)->get();
                $album = Album::find($event->comment->commentable_id);
                foreach ($commenter as $author) {
                    $user = User::find($author->user_id);
                    if ($user->id != $event->comment->user_id && $user->id != $album->user_id) {
                        $user->newNotification()
                            ->from(Auth::user())
                            ->withType('AlbumCommentWasPosted')
                            ->withSubject('En ny kommentar')
                            ->withBody('<li><a href="/gallery/album/' . $event->comment->commentable_id . '"> {{users}} har lämnat en kommentar på:<br /><span class="blue">' . $album->album_name . ' </span></a></li>')
                            ->regarding($event->comment)
                            ->deliver();
                    }
                }
                $user = User::find($album->user_id);
                if($user->id != Auth::user()->id){
                $user->newNotification()
                    ->from(Auth::user())
                    ->withType('AlbumCommentWasPosted')
                    ->withSubject('En ny kommentar')
                    ->withBody('<li><a href="/gallery/album/' . $event->comment->commentable_id . '"> {{users}} har lämnat en kommentar på ditt Album:<br /><span class="blue">' . $album->album_name . '</span></a></li>')
                    ->regarding($event->comment)
                    ->deliver();
                }
                break;
            case 'Photo':
                $commenter = Comment::whereCommentable_id($event->comment->commentable_id)->whereCommentable_type($event->comment->commentable_type)->get();
                $photo = Photo::find($event->comment->commentable_id);
                foreach ($commenter as $author) {
                    $user = User::find($author->user_id);
                    if ($user->id != $event->comment->user_id && $user->id != $photo->user_id) {
                        $user->newNotification()
                            ->from(Auth::user())
                            ->withType('PhotoCommentWasPosted')
                            ->withSubject('En ny kommentar')
                            ->withBody('<li><a href="/gallery/album/' . $photo->album_id . '/photo/' . $event->comment->commentable_id . '"> {{users}} har lämnat en kommentar på bilden:<br /><span class="blue">' . $photo->photo_name . ' </span></a></li>')
                            ->regarding($event->comment)
                            ->deliver();
                    }
                }
                $user = User::find($photo->user_id);
                if($user->id != Auth::user()->id){
                $user->newNotification()
                    ->from(Auth::user())
                    ->withType('PhotoCommentWasPosted')
                    ->withSubject('En ny kommentar')
                    ->withBody('<li><a href="gallery/album/' . $photo->album_id . '/photo/' . $event->comment->commentable_id . '"> {{users}} har lämnat en kommentar på ditt foto:<br /><span class="blue">' . $photo->photo_name . '</span></a></li>')
                    ->regarding($event->comment)
                    ->deliver();
                }
                break;
            case 'Post':
                $commenter = Comment::whereCommentable_id($event->comment->commentable_id)->whereCommentable_type($event->comment->commentable_type)->get();
                $post = Post::find($event->comment->commentable_id);
                foreach ($commenter as $author) {
                    $user = User::find($author->user_id);
                    if ($user->id != $event->comment->user_id && $user->id != $post->user_id) {
                        $user->newNotification()
                            ->from(Auth::user())
                            ->withType('PostCommentWasPosted')
                            ->withSubject('En ny kommentar')
                            ->withBody('<li><a href="/news/post/' . $event->comment->commentable_id . '"> {{users}} har lämnat en kommentar på nyheten:<br /><span class="blue">' . $post->title . ' </span></a></li>')
                            ->regarding($event->comment)
                            ->deliver();
                    }
                }
                $user = User::find($post->user_id);
                if (Auth::user()->id != $post->user_id){
                    $user->newNotification()
                        ->from(Auth::user())
                        ->withType('PostCommentWasPosted')
                        ->withSubject('En ny kommentar')
                        ->withBody('<li><a href="/news/post/' . $event->comment->commentable_id . '"> {{users}} har lämnat en kommentar på din nyhet:<br /><span class="blue">' . $post->title . '</span></a></li>')
                        ->regarding($event->comment)
                        ->deliver();
                }
                break;
        }

    }
} 