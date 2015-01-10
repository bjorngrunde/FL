<?php

use Family\Forms\EventValidation;
use Illuminate\Routing\Controller;

class RaidsController extends Controller
{
    /**
     * @var EventValidation
     */
    private $eventValidation;

    /**
     * @param EventValidation $eventValidation
     */

    public function __construct(EventValidation $eventValidation)
    {

        $this->eventValidation = $eventValidation;
    }

    /**
     * @return mixed
     */
    public function index()
	{
        $raids = Raid::all();

        $events = [];

       foreach($raids as $raid)
       {
          if($events = array_add($events, $raid->time,[]))
          {
              $newlink = '<a href="/flrs/show/'.$raid->id.'" >'.$raid->title. ' ('. $raid->mode.')</a>';
              array_push($events[$raid->time], $newlink);
          }
          else
          {
               $newlink = '<a href="/flrs/show/'.$raid->id.'" >'.$raid->title. ' ('. $raid->mode.')</a>';
               array_push($events[$raid->time], $newlink);
          }
       }
        $cal = generateCalendar($events);


        return View::make('flrs.index', ['cal' => $cal]);
	}


	public function create()
	{
        $raids = RaidInstance::all();
		return View::make('flrs.create', ['raids' => $raids]);
	}


	public function store()
	{
		$input = Input::all();

        $this->eventValidation->validate($input);

        $raid = RaidInstance::whereId(Input::get('id'))->firstOrFail();

        $event = new Raid;
        $event->title = $raid->title;
        $event->backgroundImg = $raid->backgroundImg;
        $event->description = Input::get('description');
        $event->mode = Input::get('mode');
        $event->time = Input::get('time');
        $event->startTime = Input::get('startTime');
        $event->endTime = Input::get('endTime');
        $event->save();

        return Redirect::back()->withFlashMessage('Raiden har skapats!');

	}
    public function signup($id)
    {
        $raid = Raid::find($id);

        $role = Input::get('role');
        $status = Input::get('status');
        $raid->users()->attach(Auth::user()->id, ['raid_role' => $role, 'raid_status' => $status]);

        return Redirect::back()->withFlashMessage('Du har nu signat upp!');
    }

    public function change($id)
    {
        $raid = Raid::find($id);
        if($raid == null)
        {
            return Redirect::back()->withFlashMessage('Något gick fel. Instansen existerar inte.');
        }

        $user = User::with('raids')->find(Auth::user()->id);
        if($user == null)
        {
            return Redirect::back()->withFlashMessage('Något gick fel. Användaren existerar inte.');
        }

        $role = Input::get('role');
        $status = Input::get('status');

        $user->raids()->updateExistingPivot($raid->id,['raid_role' => $role, 'raid_status' => $status]);

        return Redirect::back()->withFlashMessage('Du har nu ändrat din status!');
    }

    public function createRaid($id)
    {

        $raid = Raid::with('users')->find($id);

        return View::make('flrs.raidgroup',['raid' => $raid]);
    }

    public function saveRaid($id)
    {
        $raid = Raid::with('users')->find($id);

        if($raid == null)
        {
            return Redirect::back()->withFlashMessage();
        }

        foreach($raid->users as $user)
        {

            if(Input::has($user->username))
            {

                $user->raids()->updateExistingPivot($raid->id,['raid_status' => Input::get($user->username)]);
            }
        }
        return Redirect::to('/flrs/show/'. $raid->id)->withFlashMessage('Raid har skapats');
    }
    public function adminIndex()
    {
        $raids = Raid::orderBy('id', 'desc')->paginate(25);

        return View::make('flrs.adminIndex', compact('raids'));
    }
	/**
	 * Display the specified resource.
	 * GET /event/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        #Har användaren en raid?
        $hasRaid = false;
        #Är användaren med i en raidgrupp
        $raidgroup = false;

        $raid = Raid::with('users')->find($id);
        if($raid == null)
        {
            return Redirect::to('/dashboard')->withFlashMessage('Denna raid existerar inte');
        }
        #Snyggar till datum lite
        list($year, $month, $day ) = explode('-',$raid->time);
        switch($month)
        {
            case 1:
                $month = 'Januari';
                break;
            case 2:
                $month = 'Februari';
                break;
            case 3:
                $month  = 'Mars';
                break;
            case 4:
                $month  = 'April';
                break;
            case 5:
                $month  = 'Maj';
                break;
            case 6:
                $month  = 'Juni';
                break;
            case 7:
                $month  = 'Juli';
                break;
            case 8:
                $month  = 'Augusti';
                break;
            case 9:
                $month  = 'September';
                break;
            case 10:
                $month  = 'Oktober';
                break;
            case 11:
                $month  = 'November';
                break;
            case 12:
                $month  = 'December';
                break;

        }
        $day = ltrim($day, '0');
        $datum = [];
        array_push($datum, $year);
        array_push($datum, $month);
        array_push($datum, $day);

        #Användaren har raiden i sin pivot, då sätter vi hasRaid till sant
        if( $user = Auth::user()->raids->find($id))
        {
            $hasRaid = true;
            #om användarens status är selected sätter vi radgroup till sant
            if($user->pivot->raid_status == 'selected')
            {
                $raidgroup =true;

                return View::make('flrs.show', ['raid' => $raid, 'hasRaid' => $hasRaid,'datum' => $datum, 'raidgroup' => $raidgroup]);
            }

            return View::make('flrs.show', ['raid' => $raid, 'hasRaid' => $hasRaid,'datum' => $datum, 'raidgroup' => $raidgroup]);
        }

        return View::make('flrs.show', ['raid' => $raid, 'hasRaid' => $hasRaid, 'datum' => $datum]);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /event/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */


	public function edit($id)
	{
        $raid = Raid::with('comments')->find($id);

        return View::make('flrs.edit', ['raid' => $raid]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /event/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();

        $this->eventValidation->validate($input);

        $raid = Raid::find($id);
        $raid->fill($input);
        $raid->save();

        return Redirect::back()->withFlashMessage('Evenemanget har uppdaterats!');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /event/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$raid = Raid::find($id);
        $raid->users()->detach();
        $raid->delete();

        return Redirect::back()->withFlashMessage('Evenemang har tagits bort.');
	}

}