<?php

namespace Family\Gear;


class GearToLinks {

    /**
     * @param array $data
     * @return string
     */
    public function getLink($data)
    {
        if(array_key_exists('gem0', $data['tooltipParams']) && array_key_exists('gem1', $data['tooltipParams']) && array_key_exists('gem2', $data['tooltipParams']))
        {
            if(array_key_exists('enchant', $data['tooltipParams']))
            {
                $link = '<a href="#" rel="item='. $data['id'].';gems='.$data['tooltipParams']['gem0'].':'.$data['tooltipParams']['gem1'].':'.$data['tooltipParams']['gem2'].';ench='.$data['tooltipParams']['enchant'].';"><img src="http://eu.media.blizzard.com/wow/icons/56/'.$data['icon'].'.jpg" class="img-circle img-responsive border-img" /></a>';
                return $link;
            }
            else
            {
                $link = '<a href="#" rel="item='. $data['id'].';gems='.$data['tooltipParams']['gem0'].':'.$data['tooltipParams']['gem1'].':'.$data['tooltipParams']['gem2'].';"><img src="http://eu.media.blizzard.com/wow/icons/56/'.$data['icon'].'.jpg" class="img-circle img-responsive border-img" /></a>';
                return $link;
            }
        }
        elseif(array_key_exists('gem0', $data['tooltipParams']) && array_key_exists('gem1', $data['tooltipParams']))
        {
            if(array_key_exists('enchant', $data['tooltipParams']))
            {
                $link = '<a href="#" rel="item='. $data['id'].';gems='.$data['tooltipParams']['gem0'].':'.$data['tooltipParams']['gem1'].';ench='.$data['tooltipParams']['enchant'].';"><img src="http://eu.media.blizzard.com/wow/icons/56/'.$data['icon'].'.jpg" class="img-circle img-responsive border-img" /></a>';
                return $link;
            }
            else
            {
                $link = '<a href="#" rel="item='. $data['id'].';gems='.$data['tooltipParams']['gem0'].':'.$data['tooltipParams']['gem1'].';"><img src="http://eu.media.blizzard.com/wow/icons/56/'.$data['icon'].'.jpg" class="img-circle img-responsive border-img" /></a>';
                return $link;
            }
        }
        elseif(array_key_exists('gem0', $data['tooltipParams']))
        {
            if(array_key_exists('enchant', $data['tooltipParams']))
            {
                $link = '<a href="#" rel="item='. $data['id'].';gems='.$data['tooltipParams']['gem0'].';ench='.$data['tooltipParams']['enchant'].';"><img src="http://eu.media.blizzard.com/wow/icons/56/'.$data['icon'].'.jpg" class="img-circle img-responsive border-img" /></a>';
                return $link;
            }
            else
            {
                $link = '<a href="#" rel="item=' . $data['id'] . ';gems=' . $data['tooltipParams']['gem0'] .';"><img src="http://eu.media.blizzard.com/wow/icons/56/' . $data['icon'] . '.jpg" class="img-circle img-responsive border-img" /></a>';
                return $link;
            }
        }
        else
        {
            if(array_key_exists('enchant', $data['tooltipParams']))
            {
                $link = '<a href="#" rel="item='. $data['id'].';ench='.$data['tooltipParams']['enchant'].';"><img src="http://eu.media.blizzard.com/wow/icons/56/'.$data['icon'].'.jpg" class="img-circle img-responsive border-img" /></a>';
                return $link;
            }
            else
            {
                $link = '<a href="#" rel="item=' . $data['id'] . ';"><img src="http://eu.media.blizzard.com/wow/icons/56/' . $data['icon'] . '.jpg" class="img-circle img-responsive border-img" /></a>';
                return $link;
            }
        }
    }
} 