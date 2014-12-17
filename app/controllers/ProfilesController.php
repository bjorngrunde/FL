<?php


use Family\Forms\ProfileData;
use Family\Forms\UserEmail;
use Family\Forms\UserPassword;
use Family\Gear\GearToLinks;
use Family\Wow\Wow;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

class ProfilesController extends BaseController
{
    /**
     * @var Wow
     * @var UserPassword
     * @var ProfileData
     * @var UserEmail
     * @var GearToLinks
     * @array newsFeed
     * @array gearSlots
     */
    private $wow;
    private $gearToLinks;
    private $i = 0;
    private $newsFeed = [];
    private $gearSlots = [];
    private $userPassword;
    private $userEmail;
    private $profileData;

    /**
     * @param Wow $wow
     * @param GearToLinks $gearToLinks
     * @param UserPassword $userPassword
     * @param UserEmail $userEmail
     * @param ProfileData $profileData
     * @internal param RegistrationForm $registrationForm
     */
    public function  __construct(Wow $wow, GearToLinks $gearToLinks, UserPassword $userPassword, UserEmail $userEmail, ProfileData $profileData)
    {

        $this->wow = $wow;
        $this->gearToLinks = $gearToLinks;
        $this->userPassword = $userPassword;
        $this->userEmail = $userEmail;
        $this->profileData = $profileData;
    }
    /**
     * @param $username
     * @return mixed
     */
    public function show($username = null)
	{
        try
        {
            $user = User::with('profile')->whereUsername($username)->firstOrFail();
        }
        catch(ModelNotFoundException $e)
        {
            return View::make('404')->withFlashMessage('Ingen användare med detta namn kunde hittas!');
        }

        if(Cache::has($user->username. '-feed'))
        {
             $feed = Cache::get($user->username. '-feed');
        }
        else
        {
           $feed = $this->wow->getFeed($user->username);

            Cache::add($user->username. '-feed', $feed, 600);
        }
        /**
         *  Går igenom varje "typ" i dataflödet
         *  Lägger till data i newsFeed array
         *  Cache på items , så vi laddar sidan snabbt
         *  Använder variabeln $i för att begränsa flödet till 7 items
         *  Bör flyttas till en service klass när tid finns.
         */

        foreach($feed as $data)
        {
        if($this->i < 7)
        {
            if($data['type'] == 'BOSSKILL')
            {
                array_push($this->newsFeed, $data["quantity"]. 'st <span class="text-warning" rel="achievement='.$data['achievement']['id'].'">' .$data["achievement"]["title"].'</span>');
            }
            elseif($data['type'] == 'ACHIEVEMENT')
            {
                array_push($this->newsFeed, 'Skaffade sig achievement: <span class="text-warning">' .$data["achievement"]["title"].'</span>');
            }
            elseif($data['type'] == 'CRITERIA')
            {
                array_push($this->newsFeed, 'Avslutade steget <span class="text-warning">' .$data["criteria"]["description"]. '</span> för achievement: <span class="text-warning">' .$data["achievement"]["title"].'</span>');
            }
            elseif($data['type'] == 'LOOT')
            {
                if(Cache::has($data['itemId'].'-item'))
                {
                    $item = Cache::get($data['itemId'].'-item');
                }
                else
                {
                    $item = $this->wow->getItem($data['itemId']);

                    Cache::add($data['itemId'].'-item', $item, 600);
                }
                if(array_key_exists('name', $item))
                {
                    $loot = 'Lootade  <a href="#" rel="item=' . $item["id"] . '">' . $item["name"] . '</a>';
                    array_push($this->newsFeed, $loot);
                }
            }
            $this->i += 1;
        }
        }
        if(Cache::has($user->username. '-gear'))
        {
            $gear = Cache::get($user->username. '-gear');
        }
        else
        {
            $gear = $this->wow->getGear($user->username);
            Cache::add($user->username. '-gear', $gear, 600);
        }
        /**
         * Skapade en service klass som extraherar data från varje item och returnerar en ikon med länk med gems enchants osv om de existerar
         * se Family\Gear\GearToLinks
         */
        if(array_key_exists('head', $gear))
        {
            $head = $this->gearToLinks->getLink($gear['head']);
            array_push($this->gearSlots, $head);
        }
        if(array_key_exists('neck', $gear))
        {
            $neck = $this->gearToLinks->getLink($gear['neck']);
            array_push($this->gearSlots, $neck);
        }
        if(array_key_exists('shoulder', $gear))
        {
            $shoulder = $this->gearToLinks->getLink($gear['shoulder']);
            array_push($this->gearSlots, $shoulder);
        }
        if(array_key_exists('back', $gear))
        {
            $back = $this->gearToLinks->getLink($gear['back']);
            array_push($this->gearSlots, $back);
        }
        if(array_key_exists('chest', $gear))
        {
            $chest = $this->gearToLinks->getLink($gear['chest']);
            array_push($this->gearSlots, $chest);
        }
        if(array_key_exists('wrist', $gear))
        {
            $wrist = $this->gearToLinks->getLink($gear['wrist']);
            array_push($this->gearSlots, $wrist);
        }
        if(array_key_exists('hands', $gear))
        {
            $hands = $this->gearToLinks->getLink($gear['hands']);
            array_push($this->gearSlots, $hands);
        }
        if(array_key_exists('waist', $gear))
        {
            $waist = $this->gearToLinks->getLink($gear['waist']);
            array_push($this->gearSlots, $waist);
        }
        if(array_key_exists('legs', $gear))
        {
            $legs = $this->gearToLinks->getLink($gear['legs']);
            array_push($this->gearSlots, $legs);
        }
        if(array_key_exists('feet', $gear))
        {
            $feet = $this->gearToLinks->getLink($gear['feet']);
            array_push($this->gearSlots, $feet);
        }
        if(array_key_exists('finger1', $gear))
        {
            $finger1 = $this->gearToLinks->getLink($gear['finger1']);
            array_push($this->gearSlots, $finger1);
        }
        if(array_key_exists('finger2', $gear))
        {
            $finger2 = $this->gearToLinks->getLink($gear['finger2']);
            array_push($this->gearSlots, $finger2);
        }
        if(array_key_exists('trinket1', $gear))
        {
            $trinket1 = $this->gearToLinks->getLink($gear['trinket1']);
            array_push($this->gearSlots, $trinket1);
        }
        if(array_key_exists('trinket2', $gear))
        {
            $trinket2 = $this->gearToLinks->getLink($gear['trinket2']);
            array_push($this->gearSlots, $trinket2);
        }
        if(array_key_exists('mainHand', $gear))
        {
            $mainHand = $this->gearToLinks->getLink($gear['mainHand']);
            array_push($this->gearSlots, $mainHand);
        }
        if(array_key_exists('offHand', $gear))
        {
            $offhand = $this->gearToLinks->getLink($gear['offHand']);
            array_push($this->gearSlots, $offhand);
        }
        return View::make('profiles.show')->with(['user' => $user, 'newsFeed' => $this->newsFeed, 'gearSlots' => $this->gearSlots]);
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
     * @throws \Laracasts\Validation\FormValidationException
     */
    public function update($username)
    {
        $checkPassword = Input::get('password');
        $checkEmail = Input::get('email');
        if(!empty($checkPassword))
        {

            $user = User::whereUsername($username)->first();

            $input = Input::only('password', 'password_confirmation');
            $this->userPassword->validate($input);

            $user->password = Input::get('password');
            $user->save();

            return Redirect::back()->with('flash_message','Lösenord uppdaterat');
        }
        elseif(!empty($checkEmail))
        {
            $user = User::whereUsername($username)->first();

            $input = Input::only('email');
            $this->userEmail->validate($input);

            $user->email = Input::get('email');
            $user->save();

            return Redirect::back()->with('flash_message', 'Din email har uppdaterats!');
        }
        else
        {
            $user = User::with('profile')->whereUsername($username)->first();

            $input = Input::only('name', 'lastName', 'phone');
            $this->profileData->validate($input);

            $user->profile->name = Input::get('name');
            $user->profile->lastname = Input::get('lastName');
            $user->profile->phone = Input::get('phone');

            $user->profile->save();

            return Redirect::back()->with('flash_message', 'Din profil har uppdaterats');
        }
   }
}