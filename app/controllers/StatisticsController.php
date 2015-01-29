<?php
/**
 * Created by PhpStorm.
 * User: bjorn
 * Date: 15-01-29
 * Time: 14:51
 */

class StatisticsController extends Controller
{
    public function userData()
    {
        $user = User::with('raids')->find(1);
        $raids = Raid::all();

        $totalRaids = count($raids);
        $totalUserRaids = count($user->raids);

    }
} 