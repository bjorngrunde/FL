<?php

use Family\Forms\RaidForm;
use Illuminate\Routing\Controller;

class RaidsInstanceController extends Controller
{
    /**
     * @var RaidForm
     */
    private $raidForm;

    /**
     * @param RaidForm $raidForm
     */
    public function __construct(RaidForm $raidForm)
    {

        $this->raidForm = $raidForm;
    }
	/**
	 * Display a listing of the resource.
	 * GET /raidsinstance
	 *
	 * @return Response
	 */
	public function index()
	{
        $raidInstance = RaidInstance::orderBy('id', 'desc')->paginate(25);

        return View::make('raidInstance.index', compact('raidInstance'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /raidsinstance/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('flrs.add');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /raidsinstance
	 *
	 * @return Response
	 */
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

	/**
	 * Show the form for editing the specified resource.
	 * GET /raidsinstance/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$instance = RaidInstance::find($id);

        return View::make('raidInstance.edit', ['instance' => $instance]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /raidsinstance/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
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

	/**
	 * Remove the specified resource from storage.
	 * DELETE /raidsinstance/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$instance = RaidInstance::find($id);

        $instance->delete();

        return Redirect::back()->withFlashMessage('Instans har nu tagits bort');
	}

}