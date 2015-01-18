<?php
use Family\Applys\PostApplicationCommand;
use Family\Applys\UpdateApplicationCommand;
use Family\Applys\RemoveApplicationCommand;

class ApplicationsController extends BaseController
{

    public function index()
    {
        $applications = Application::with('status', 'comments')->orderBy('id','DESC')->paginate(25);
        return View::make('applications.index', compact('applications'));
    }

    public function create()
    {
        return View::make('applications.create');
    }

    public function store()
    {
        $input = Input::all();

        $command = new PostApplicationCommand(
            $input['name'],
            $input['lastName'],
            $input['username'],
            $input['email'],
            $input['server'],
            $input['talents'],
            $input['klass'],
            $input['armory'],
            $input['played'],
            $input['playClass'],
            $input['bio'],
            $input['raidExperience'],
            $input['reasonToApplyFl'],
            $input['oldGuild'],
            $input['progressRaid'],
            $input['attendance'],
            $input['screenshot']
        );
        $this->CommandBus->execute($command);
        return Redirect::back()->withFlashMessage('Tack för din ansökan, vi hör av oss via mail eller in-game när vi fattat ett beslut.');
    }

    public function show($id = null)
    {
        $application = Application::with('status')->findOrFail($id);
        return View::make('applications.show', ['application' => $application]);
    }

    public function edit($id = null)
    {
        $application = Application::with('status')->findOrFail($id);
        return View::make('applications.edit', ['application' => $application]);
    }

    public function update($id = null)
    {
        $input = Input::all();
        $command = new UpdateApplicationCommand(
            $id,
            $input['name'],
            $input['lastName'],
            $input['username'],
            $input['email'],
            $input['server'],
            $input['talents'],
            $input['klass'],
            $input['armory'],
            $input['played'],
            $input['playClass'],
            $input['bio'],
            $input['raidExperience'],
            $input['reasonToApplyFl'],
            $input['oldGuild'],
            $input['progressRaid'],
            $input['attendance'],
            $input['screenshot'],
            $input['app_status']
        );
        $this->CommandBus->execute($command);
        return Redirect::back()->with('Success','Du har nu uppdaterat ansökan.');
    }

    public function destroy($id = null)
    {
        $command = new RemoveApplicationCommand($id);
        $this->CommandBus->execute($command);

        return Redirect::back()->with('flash_message', 'Ansökan bortagen!');
    }

}