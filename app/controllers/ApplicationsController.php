<?php
use Family\Forms\ApplicationForm;
use Illuminate\Routing\Controller;

class ApplicationsController extends Controller
{

    private $applicationForm;

    /**
     * @param ApplicationForm $applicationForm
     */
    function __construct(ApplicationForm $applicationForm)
    {
        $this->applicationForm = $applicationForm;
    }

    /**
     * Display a listing of the resource.
     * GET /applications
     *
     * @return Response
     */
    public function index()
    {
        $applications = Application::with('status', 'comments')->orderBy('id','DESC')->paginate(25);

        return View::make('applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /applications/create
     *
     * @return Response
     */
    public function create()
    {
        return View::make('applications.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /applications
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $this->applicationForm->validate($input);

        $application = new Application;
        $application->name = Input::get('name');
        $application->lastName = Input::get('lastName');
        $application->username = Input::get('username');
        $application->email = Input::get('email');
        $application->server = Input::get('server');
        $application->talents = Input::get('talents');
        $application->klass = Input::get('klass');
        $application->armory = Input::get('armory');
        $application->played = Input::get('played');
        $application->playClass = Input::get('playClass');
        $application->bio = Input::get('bio');
        $application->raidExperience = Input::get('raidExperience');
        $application->reasonToApplyFl = Input::get('reasonToApplyFl');
        $application->oldGuild = Input::get('oldGuild');
        $application->progressRaid = Input::get('progressRaid');
        $application->attendance = Input::get('attendance');

        if (Input::hasFile('screenshot'))
        {
            try
            {
                $file = Input::file('screenshot');
                $filepath = '/img/applications/';
                $filename =  time() . '-application.jpg';
                $file = $file->move(public_path($filepath),$filename);

                $application->screenshot = $filepath.$filename;
            }
            catch (Exception $e)
            {
                return $e->getMessage();
            }
        }

        $application->save();

        $status = new Status;
        $status->app_status = 'default';
        $status->save();

        $status->applications()->save($application);
        return Redirect::back()->withFlashMessage('Tack för din ansökan, vi hör av oss via mail eller in-game när vi fattat ett beslut.');
    }

    /**
     * Display the specified resource.
     * GET /applications/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id = null)
    {
        $application = Application::with('status')->findOrFail($id);
        return View::make('applications.show', ['application' => $application]);
    }

    /**
     * Show the form for editing the specified resource.
     * GET /applications/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id = null)
    {
        $application = Application::with('status')->findOrFail($id);
        return View::make('applications.edit', ['application' => $application]);
    }

    /**
     * Update the specified resource in storage.
     * PUT /applications/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id = null)
    {
        $application = Application::with('status')->findOrFail($id);

        $input = Input::all();
        $this->applicationForm->validate($input);

        $application->name = Input::get('name');
        $application->lastName = Input::get('lastName');
        $application->username = Input::get('username');
        $application->email = Input::get('email');
        $application->server = Input::get('server');
        $application->talents = Input::get('talents');
        $application->armory = Input::get('armory');
        $application->klass = Input::get('klass');
        $application->played = Input::get('played');
        $application->playClass = Input::get('playClass');
        $application->bio = Input::get('bio');
        $application->raidExperience = Input::get('raidExperience');
        $application->reasonToApplyFl = Input::get('reasonToApplyFl');
        $application->oldGuild = Input::get('oldGuild');
        $application->progressRaid = Input::get('progressRaid');
        $application->attendance = Input::get('attendance');
        $application->status->app_status = Input::get('app_status');

        if (Input::hasFile('screenshot'))
        {
            try
            {
                $file = Input::file('screenshot');
                $filepath = '/img/applications/';
                $filename =  time() . '-application.jpg';
                $file = $file->move(public_path($filepath),$filename);

                $application->screenshot = $filepath.$filename;
            }
            catch (Exception $e)
            {
                return $e->getMessage();
            }
        }

        $application->status->save();

        return Redirect::back()->with('Success','Du har nu uppdaterat ansökan.');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /applications/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id = null)
    {
        $application = Application::with('status')->findOrFail($id);

        $application->status->delete();
        $application->delete();

        return Redirect::to('/admin/applications')->with('flash_message', 'Ansökan bortagen!');
    }

}