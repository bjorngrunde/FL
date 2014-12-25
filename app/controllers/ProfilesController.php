<?php


use Family\Forms\ProfileForm;
use Family\Forms\UserEmail;
use Family\Forms\UserPassword;
use Family\Gear\ProfileFeed;
use Family\Wow\Wow;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

class ProfilesController extends Controller
{
    /**
     * @var Wow
     * @var UserPassword
     * @var ProfileData
     * @var UserEmail
     */
    private $wow;
    private $userPassword;
    private $userEmail;
    private $profileData;
    /**
     * @var ProfileFeed
     */
    private $profileFeed;
    /**
     * @var ProfileForm
     */
    private $profileForm;

    /**
     * @param Wow $wow
     * @param UserPassword $userPassword
     * @param UserEmail $userEmail
     * @param ProfileFeed $profileFeed
     * @param ProfileForm $profileForm
     *
     */
    public function  __construct(Wow $wow, UserPassword $userPassword, UserEmail $userEmail, ProfileFeed $profileFeed, ProfileForm $profileForm)
    {

        $this->wow = $wow;
        $this->userPassword = $userPassword;
        $this->userEmail = $userEmail;
        $this->profileFeed = $profileFeed;
        $this->profileForm = $profileForm;
    }
    /**
     * @param $username
     * @return mixed
     */
    public function show($username = null)
	{
        $type = 'feed, items, progression, talents';

        try
        {
            $user = User::with('profile', 'threads', 'comments', 'raids')->whereUsername($username)->firstOrFail();
        }
        catch(ModelNotFoundException $e)
        {
            return View::make('404')->withFlashMessage('Ingen användare med detta namn kunde hittas!');
        }

        if(Cache::has($user->username. '-profileData')) {
            $this->profileData = Cache::get($user->username . '-profileData');
        }
        else
        {
            $this->profileData = $this->wow->getCharacterWithData($user->username, $type);
            Cache::add($user->username. '-profileData', $this->profileData, 600);
        }
        if(Cache::has($user->username. '-feed'))
        {
            $feed = Cache::get($user->username . '-feed');
        }
        else
        {
            $feed = $this->profileFeed->feed($this->profileData['feed']);
            Cache::add($user->username. '-feed', $feed, 600);
        }
        if(Cache::has($user->username. '-gear'))
        {
            $gear = Cache::get($user->username . '-gear');
        }
        else
        {
            $gear = $this->profileFeed->gear($this->profileData['items']);
            Cache::add($user->username. '-feed', $gear, 600);
        }

        if(Cache::has($user->username. '-talents') && Cache::has($user->username. '-glyphs'))
        {
            $talents = Cache::get($user->username. '-talents');
            $glyphs = Cache::get($user->username. '-glyphs');
        }
        else
        {
            if(array_key_exists('selected', $this->profileData['talents'][0]))
            {
                $talents = $this->profileFeed->talents($this->profileData['talents'][0]);
                Cache::add($user->username. '-talents', $talents, 600);
                $glyphs = $this->profileFeed->glyphs($this->profileData['talents'][0]['glyphs']);
                Cache::add($user->username. '-glyphs', $glyphs, 600);
            }
            else
            {
                $talents = $this->profileFeed->talents($this->profileData['talents'][1]);
                Cache::add($user->username. '-talents', $talents, 600);
                $glyphs = $this->profileFeed->glyphs($this->profileData['talents'][1]['glyphs']);
                Cache::add($user->username. '-glyphs', $glyphs, 600);
            }
        }
        $forumFeed = $this->profileFeed->forumFeed($user->threads, $user->comments, $user->raids);
        #$progression = $this->profileFeed->progression($this->profileData['progression']);

        return View::make('profiles.show')->with(['user' => $user, 'feed' => $feed, 'gear' => $gear, 'talents' => $talents, 'glyphs' => $glyphs, 'forumFeed' => $forumFeed]);
	}

    /**
     * @param $username
     * @return mixed
     */
    public function edit($username)
    {
        if(Auth::user()->username == $username)
        {
            $user = User::with('profile')->whereUsername($username)->firstOrFail();
            return View::make('profiles.edit')->withUser($user);
        }
        else
        {
            return Redirect::to('/dashboard');
        }
    }

    /**
     * @param $username
     * @return mixed
     */
    public function update($username)
    {
        $checkPassword = Input::get('password');
        $checkEmail = Input::get('email');
        if(!empty($checkPassword))
        {
            $user = User::whereUsername($username)->first();
            if($user == null)
            {
                return Redirect::back()->withFlashMessage('Något gick fel.');
            }
            $input = Input::only('password', 'password_confirmation');
            $this->userPassword->validate($input);

            $user->password = Input::get('password');
            $user->save();

            return Redirect::back()->with('flash_message','Lösenord uppdaterat');
        }
        elseif(!empty($checkEmail))
        {
            $user = User::whereUsername($username)->first();
            if($user == null)
            {
                return Redirect::back()->withFlashMessage('Något gick fel.');
            }
            $input = Input::only('email');
            $this->userEmail->validate($input);

            $user->email = Input::get('email');
            $user->save();

            return Redirect::back()->with('flash_message', 'Din email har uppdaterats!');
        }
        else
        {
            $user = User::with('profile')->whereUsername($username)->first();
            if($user == null)
            {
                return Redirect::back()->withFlashMessage('Något gick fel.');
            }
            $input = Input::only('name', 'lastName', 'phone');

            $this->profileForm->validate($input);

            $user->profile->name = Input::get('name');
            $user->profile->lastname = Input::get('lastName');
            $user->profile->phone = Input::get('phone');

            $user->profile->save();

            return Redirect::back()->with('flash_message', 'Din profil har uppdaterats');
        }
   }
}