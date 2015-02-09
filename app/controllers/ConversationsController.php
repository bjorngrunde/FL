<?php


class ConversationsController extends Controller {

    /**
     * Create a BaseController instance.
     *
     * @return void
     */
    public function __construct()
    {
        #parent::__construct();

        $this->beforeFilter('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $conversations = Conversation::forUser()->get();

        if ($conversations->isEmpty())
        {
            return Redirect::to('/conversations/create');
        }

        return Redirect::route('conversations.show', [$conversations->last()->id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user = Auth::user();
        $conversations = Conversation::forUser()->orderBy('updated_at', 'desc')->get();

        return View::make('conversations.create', compact('conversations'));
    }

    public function addMember($id)
    {
        $conversation = Conversation::find($id);

        $input = Input::get('hidden-recipient');
        $members = explode(',',$input);
        foreach($members as $member)
        {
            $user = User::whereUsername($member)->first();
            if($user == null)
            {
                return Redirect::back()->withFlashMessage('En användare kunde inte hittas. Försök igen');
            }
            elseif(Participant::where('conversation_id', '=', $conversation->id)->where('user_id', '=', $user->id)->first())
            {
                return Redirect::back()->withFlashMessage('Användaren '. $user->username. ' finns redan i konversationen');
            }
            else
            {
            $participant = new Participant;
            $participant->conversation_id = $id;
            $participant->user_id = $user->id;
            $participant->save();
            }
        }
        return Redirect::back()->withFlashMessage('Användare har lagts till i konversationen');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();

        $conversation = Conversation::create([
            'subject' => $input['subject'],
        ]);

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'user_id' => Auth::user()->id,
            'body' => $input['message'],
        ]);

        $sender = Participant::create([
            'conversation_id' => $conversation->id,
            'user_id' => Auth::user()->id
        ]);

        if (Input::has('hidden-recipient'))
        {
            $hidden = Input::get('hidden-recipient');
            $users = explode(',', $hidden);

            foreach($users as $user)
            {
            $recipient = User::where('username', $user)->first();

                if($recipient == null)
                {

                }
                else{
                    Participant::create([
                    'conversation_id' => $conversation->id,
                    'user_id' => $recipient->id,
            ]);
                }
            }
        }

        return Redirect::to('/conversations/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $newMessages    = Conversation::withNewMessages()->get();
        $conversations = Conversation::forUser()->orderBy('updated_at', 'desc')->get();
        $conversation  = Conversation::find($id);

        $me = Participant::me()->where('conversation_id', $conversation->id)->first();
        $me->last_read = new DateTime;
        $me->save();

        return View::make('conversations.show', compact('conversations', 'conversation', 'newMessages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createMessage($conversation)
    {
        return View::make('conversations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeMessage($conversation)
    {

        $message = Message::create([
            'conversation_id' => $conversation,
            'user_id' => Auth::user()->id,
            'body' => Input::get('message'),
        ]);

        $me = Participant::me()->where('conversation_id', $conversation)->first();
        $me->last_read = new DateTime;
        $me->save();

        return Redirect::route('conversations.show', $conversation);
    }

}