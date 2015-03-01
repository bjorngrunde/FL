<?php


class ConversationsController extends Controller {

    public function __construct()
    {
        #parent::__construct();

        $this->beforeFilter('auth');
    }

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
        return Redirect::back()->withFlashMessage($user->username.' har lagts till i konversationen');
    }

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
                    if($oldParticipants = Participant::where('conversation_id', '=', $conversation->id)->get())
                    {
                        foreach($oldParticipants as $oldParticipant)
                        {
                            $oldParticipant->delete();
                        }
                    }
                    if($oldMessages = Message::where('conversation_id', '=', $conversation->id)->get())
                    {
                        foreach($oldMessages as $oldMessage)
                        {
                            $oldMessage->delete();
                        }
                    }
                    $conversation->delete();

                    return Redirect::back()->withFlashMessage('Skapandet av konversationen avbröts, en användare kunde inte hittas.');
                }
                elseif($recipient->username == Auth::user()->username)
                {
                    if($oldParticipants = Participant::where('conversation_id', '=', $conversation->id)->get())
                    {
                        foreach($oldParticipants as $oldParticipant)
                        {
                            $oldParticipant->delete();
                        }
                    }
                    if($oldMessages = Message::where('conversation_id', '=', $conversation->id)->get())
                    {
                        foreach($oldMessages as $oldMessage)
                        {
                            $oldMessage->delete();
                        }
                    }
                    $conversation->delete();

                    return Redirect::back()->withFlashMessage('Du kan inte lägga till dig själv i konversationen. Skapandet avbröts.');
                }
                else
                {
                    Participant::create([
                    'conversation_id' => $conversation->id,
                    'user_id' => $recipient->id,
            ]);
                }
            }
        }

        return Redirect::to('/conversations/index');
    }

    public function show($id)
    {
        $user = Auth::user();
        $newMessages    = Conversation::withNewMessages()->get();
        $conversations = Conversation::forUser()->orderBy('updated_at', 'desc')->paginate(5);
        $conversation  = Conversation::find($id);

        $me = Participant::me()->where('conversation_id', $conversation->id)->first();
        $me->last_read = new DateTime;
        $me->save();

        return View::make('conversations.show', compact('conversations', 'conversation', 'newMessages'));
    }

    public function createMessage($conversation)
    {
        return View::make('conversations.create');
    }

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

    public function destroyParticipant($id)
    {
        $conversation = Conversation::find($id);

        $participant = Participant::where('conversation_id', '=', $conversation->id)->where('user_id', '=', Auth::user()->id)->firstOrFail();
        $participant->delete();

        return Redirect::to('/conversations/index')->withFlashMessage('Du har nu lämnat konversationen '. $conversation->subject);
    }

}