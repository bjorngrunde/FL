<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class SearchController extends Controller
{
    public function index()
    {

    }

    public function query()
    {
        $query = Input::get('term');
        $users = User::where('username', 'LIKE', "%$query%")->get();
        $result = [];
        foreach($users as $user)
        {
            $result[] = $user->username;
        }
        return Response::json($result);
    }

    public function searchResult()
    {
        $result = Input::get('auto');
        $user = User::whereUsername($result)->firstOrFail();
        return Redirect::to('/profile/'.$user->username);
    }

}