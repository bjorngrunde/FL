<?php
/**
 * Created by PhpStorm.
 * User: bjorn
 * Date: 15-01-29
 * Time: 14:51
 */

class StatisticsController extends Controller
{
    public function attendance($id)
    {
        if(Request::ajax())
        {
            $input = Input::all();
            $char = User::find($id);
            $raids = Raid::with('users')->where('time', '>=', $input['date1'])->where('time', '<=', $input['date2'])->get();

            $totalUserRaids = 0;

            foreach($raids as $raid)
            {
                foreach($raid->users as $user)
                {
                    if($user->pivot->user_id == $char->id)
                    {
                        if($user->pivot->raid_status != 'unsure' && $user->pivot->raid_status != 'no')
                        {
                            $totalUserRaids += 1;
                        }

                    }
                }
            }
            $totalRaids = count($raids);
            $calc = $totalUserRaids/$totalRaids;
            $percentage = number_format($calc * 100, 2). '%';

            $message = [
                'msg'                       =>  'success',
                'totalRaids'                =>  $totalRaids,
                'totalUserRaids'            =>  $totalUserRaids,
                'percentage'                =>  $percentage
            ];

            return Response::json($message);

        }
    }
} 