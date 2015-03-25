<?php


use Family\Forms\ProfileForm;
use Family\Forms\UserEmail;
use Family\Forms\UserPassword;
use Family\Wow\Facades\Wow;
use Illuminate\Support\Facades\Cache;

class ProfilesController extends Controller
{

    private $profileForm;
    private $userEmail;
    private $userPassword;

    function __construct(ProfileForm $profileForm, UserEmail $userEmail, UserPassword $userPassword)
    {
        $this->profileForm = $profileForm;
        $this->userEmail = $userEmail;
        $this->userPassword = $userPassword;
    }
    public function show($username = null)
	{
        $WowJsonData = [];
        $type = 'feed, items, progression, talents';

        $user = User::with('profile', 'threads', 'comments', 'raids', 'server')->whereUsername($username)->firstOrFail();

        if(Cache::has($user->username. '-profileData')) {
            $WowJsonData = Cache::get($user->username . '-profileData');
        }
        else
        {
            $WowJsonData = Wow::getCharacterWithData($user->username, $type, $user->server->server);
            Cache::add($user->username. '-profileData', $WowJsonData, 600);
        }
        if(Cache::has($user->username. '-feed'))
        {
            $feed = Cache::get($user->username . '-feed');
        }
        else
        {
            $feed = ProfileFeed::feed($WowJsonData['feed']);
            Cache::add($user->username. '-feed', $feed, 600);
        }
        if(Cache::has($user->username. '-gear'))
        {
            $gear = Cache::get($user->username . '-gear');
        }
        else
        {
            $gear = ProfileFeed::gear($WowJsonData['items']);
            Cache::add($user->username. '-feed', $gear, 600);
        }

        if(Cache::has($user->username. '-talents') && Cache::has($user->username. '-glyphs'))
        {
            $talents = Cache::get($user->username. '-talents');
            $glyphs = Cache::get($user->username. '-glyphs');
        }
        else
        {
            if(array_key_exists('selected', $WowJsonData['talents'][0]))
            {
                $talents = ProfileFeed::talents($WowJsonData['talents'][0]);
                Cache::add($user->username. '-talents', $talents, 600);
                $glyphs = ProfileFeed::glyphs($WowJsonData['talents'][0]['glyphs']);
                Cache::add($user->username. '-glyphs', $glyphs, 600);
            }
            else
            {
                $talents = ProfileFeed::talents($WowJsonData['talents'][1]);
                Cache::add($user->username. '-talents', $talents, 600);
                $glyphs = ProfileFeed::glyphs($WowJsonData['talents'][1]['glyphs']);
                Cache::add($user->username. '-glyphs', $glyphs, 600);
            }
        }
        #$progression = $this->profileFeed->progression($this->profileData['progression']);
        $averageItemLevel = $WowJsonData['items']['averageItemLevel'];

        $averageItemLevelEquipped = $WowJsonData['items']['averageItemLevelEquipped'];
        return View::make('profiles.show')->with([
            'user' => $user,
            'feed' => $feed,
            'gear' => $gear,
            'talents' => $talents,
            'glyphs' => $glyphs,
            'averageItemLevel' => $averageItemLevel,
            'averageItemLevelEquipped' => $averageItemLevelEquipped
        ]);
	}

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