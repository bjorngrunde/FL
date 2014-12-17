<?php

use Family\Forms\RegistrationForm;
use Family\Forms\RegistrationAutoForm;
use Family\Mailer\UserMailer as Mailer;
use Family\Wow\Wow;
use Illuminate\Routing\Controller;

class RegistrationController extends BaseController
{
    /**
     * @var RegistrationForm
     */
    private $registrationForm;
    
    private $registrationAutoForm;
    /**
     * @var Mailer
     */
    private $mailer;
    /**
     * @var Wow
     */
    private $wow;

    /**
     * @param RegistrationForm $registrationForm
     * @param RegistrationAutoForm $registrationAutoForm
     * @param Mailer $mailer
     * @param Wow $wow
     */
    function __construct(RegistrationForm $registrationForm , RegistrationAutoForm $registrationAutoForm, Mailer $mailer, Wow $wow)
   {
       $this->registrationForm = $registrationForm;

       $this->registrationAutoForm = $registrationAutoForm;

       $this->mailer = $mailer;
       $this->wow = $wow;
   }

    /**
     * @return mixed
     * @throws \Laracasts\Validation\FormValidationException
     */
    public function store()
    {
       /**if(Input::get('role') == 'Utvecklare')
        {
            if(!Auth::user()->hasRole('Utvecklare'));

            return Redirect::back()->withFlashMessage('Du har inte behörighet att ange den rollen');
        }**/
            #Standard behörighet för nya användare
            $member = Role::whereName(Input::get('role'))->firstOrFail();
            #Hämtar vår input
            $input = Input::only('username', 'email', 'name', 'lastName', 'rank', 'klass');
            #Validerar med serviceklassen laracasts\validator
            $this->registrationAutoForm->validate($input);
            #Genererar lösenord
            $password = str_random(12);
            #Hämtar länk från Armory
            if ($img = $this->wow->getThumbnail(Input::get('username')))
            {
                $avatar = str_replace('avatar', 'profilemain',$img);

                $user = new User;
                $user->username = Input::get('username');
                $user->email = Input::get('email');
                $user->password = $password;

                $user->save();

                $profile = new Profile;
                $profile->name = Input::get('name');
                $profile->lastName = Input::get('lastName');
                $profile->rank = Input::get('rank');
                $profile->klass = Input::get('klass');
                $profile->thumbnail =$img;

                $profile->avatar = $avatar;


                $profile->save();

                #Associerar profil med user
                $user->profile()->save($profile);
                #lägger till en roll
                $user->roles()->attach($member->id);
                #Välkomstmail, se Mailer klassen
                $this->mailer->welcome($user, $password);

                return Redirect::back()->withFlashMessage('Användare skapades, email har skickats med användaruppgifter!');
            }
            else{
                return Redirect::back()->withFlashMessage('Något gick fel hos Blizzards servrar. Försök igen om en liten stund');
            }
    }


    /**
     * @return mixed
     */
    public function create()
    {
        return View::make('registration.create');
    }

}