<?php

class CommentsController extends Controller
{
    public function deleteComment($id = null)
    {
        if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Utvecklare') ) {

            $comment = \Fbf\LaravelComments\Comment::find($id);

            if ($comment == Null) {
                return Redirect::back()->withFlashMessage('Kommentaren existerar inte');
            }

            if ($comment->delete()) {
                return Redirect::back()->withFlashMessage('Kommentaren har tagits bort');
            }
            return Redirect::back()->withFlashMessage('Något gick fel. :');
        }
    }
}