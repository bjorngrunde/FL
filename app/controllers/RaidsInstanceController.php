<?php

use Family\Forms\RaidForm;
use Illuminate\Routing\Controller;

class RaidsInstanceController extends Controller
{

    private $raidForm;


    public function __construct(RaidForm $raidForm)
    {

        $this->raidForm = $raidForm;
    }

	public function index()
	{
        $raidInstance = RaidInstance::orderBy('id', 'desc')->paginate(25);

        return View::make('raidInstance.index', compact('raidInstance'));
	}

	public function create()
	{
		return View::make('flrs.add');
	}


	public function store()
	{
        $input = Input::all();

        $this->raidForm->validate($input);

        $raid = new RaidInstance;

        if(Input::hasFile('backgroundImg'))
        {
            try
            {
                $file = Input::file('backgroundImg');
                $filename = time() . '-raid.jpg';
                $filepath = '/img/raids/';
                $file = $file->move(public_path($filepath),$filename);

                $raid->backgroundImg = $filepath.$filename;
            }
            catch(Exception $e)
            {
                return 'Något gick snett mannen: ' .$e;
            }
        }

        $raid->title = Input::get('title');
        $raid->save();

            return Redirect::back()->withFlashMessage('Raid har skapats. Gå till "Skapa evenemang" för att lägga till den i kalendern');

	}

	public function edit($id)
	{
		$instance = RaidInstance::find($id);

        return View::make('raidInstance.edit', ['instance' => $instance]);
	}


	public function update($id)
	{
		$input = Input::all();

        $this->raidForm->validate($input);

        $raid = RaidInstance::find($id);

        if(Input::hasFile('backgroundImg'))
        {
            try
            {
                $file = Input::file('backgroundImg');
                $filename = time() . '-raid.jpg';
                $filepath = '/img/raids/';
                $file = $file->move(public_path($filepath),$filename);

                $raid->backgroundImg = $filepath.$filename;
            }
            catch(Exception $e)
            {
                return 'Något gick snett mannen: ' .$e;
            }
        }

        $raid->title = Input::get('title');
        $raid->save();

        return Redirect::back()->withFlashMessage('Raid har updaterats. Gå till "Skapa evenemang" för att lägga till den i kalendern');
	}


	public function destroy($id)
	{
		$instance = RaidInstance::find($id);

        $instance->delete();

        return Redirect::back()->withFlashMessage('Instans har nu tagits bort');
	}

}