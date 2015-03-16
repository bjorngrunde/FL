<?php

use Family\Comments\PostCommentCommand;
class CommentsController extends BaseController
{


    public function create()
    {
        $return = Input::get('return');
        if (empty($return))
        {
            return Redirect::to('/');
        }



            $commentable = Input::get('commentable');
            if (empty($commentable))
            {
                throw new Exception();
            }
            $commentable = Crypt::decrypt($commentable);
            if (strpos($commentable, '.') == false)
            {
                throw new Exception();
            }
            list($commentableType, $commentableId) = explode('.', $commentable);
            if (!class_exists($commentableType))
            {
                throw new Exception();
            }

            $commentable_type = $commentableType;
            $commentable_id = $commentableId;
            $comment = Input::get('comment');
            $user_id = Auth::user()->id;

            $command = new PostCommentCommand(
                $commentable_type,
                $commentable_id,
                $comment,
                $user_id
            );
            $this->CommandBus->execute($command);
            /*$rules = $this->comment->getRules($commentableType);
            $validator = Validator::make($data, $rules);
            if ($validator->fails())
            {
                return Redirect::to($return)->withErrors($validator);
            }
            $this->comment->fill($data);
            $this->comment->save();
            $newCommentId = $this->comment->id; */



            return Redirect::back()->withFlashMessage('Du har kommenterat');

       /*catch (\Exception $e) {

            return Redirect::to($return.'#'.trans('laravel-comments::messages.add_form_anchor'))
                ->with('laravel-comments::error', trans('laravel-comments::messages.unexpected_error'));

        } */

    }

}