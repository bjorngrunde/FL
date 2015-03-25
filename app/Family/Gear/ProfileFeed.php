<?php


namespace Family\Gear;


use Family\Wow\Facades\Wow;

class ProfileFeed extends GearToLinks {
    protected $newsFeed = [];
    protected $gearslots = [];
    protected $talents = [];
    protected $glyphsCollection = [];
    protected $forumFeed = [];
    private $i = 0;

    public function feed($feed)
    {
    foreach($feed as $data)
    {
        if($this->i < 16)
        {
            if($data['type'] == 'BOSSKILL')
            {
                array_push($this->newsFeed, $data["quantity"]. 'st <span class="text-warning" rel="achievement='.$data['achievement']['id'].'">' .$data["achievement"]["title"].'</span>');
            }
            elseif($data['type'] == 'ACHIEVEMENT')
            {
                array_push($this->newsFeed, 'Skaffade sig achievement: <span class="text-warning">' .$data["achievement"]["title"].'</span>');
            }
            elseif($data['type'] == 'CRITERIA')
            {
                array_push($this->newsFeed, 'Avslutade steget <span class="text-warning">' .$data["criteria"]["description"]. '</span> för achievement: <span class="text-warning">' .$data["achievement"]["title"].'</span>');
            }
            elseif($data['type'] == 'LOOT')
            {
                $item = Wow::getItem($data['itemId']);
                if(array_key_exists('name', $item))
                {
                $loot = 'Lootade  <a href="#" rel="item=' . $data["itemId"] . '">' . $item["name"] . '</a>';
                array_push($this->newsFeed, $loot);
                }
            }
            $this->i += 1;
        }
    }
    return $this->newsFeed;
    }


    public function gear($gear)
    {
        unset($gear['averageItemLevelEquipped']);
        unset($gear['averageItemLevel']);

       foreach($gear as $item) {
           $slot = $this->getLink($item);
           array_push($this->gearslots, $slot);
       }
        return $this->gearslots;
    }

    public function talents($data)
    {
        unset($data['selected']);

        foreach($data['talents'] as $type)
        {
            array_push($this->talents, '<a href="#" rel="spell=' . $type['spell']['id'] . ';" ><img src="http://eu.media.blizzard.com/wow/icons/36/' . $type['spell']['icon'] . '.jpg" class="img-circle img-responsive border-img" /></a>');
        }
        return $this->talents;
    }

    /**
     * @param $data
     * @return array
     */
    public function glyphs($data)
    {
        foreach($data as $glyphs)
        {
            foreach($glyphs as $glyph)
            {
            array_push($this->glyphsCollection, '<a href="#" rel="item=' . $glyph['item'] . ';" ><img src="http://eu.media.blizzard.com/wow/icons/36/' . $glyph['icon'] . '.jpg" class="img-circle img-responsive border-img" /></a>');
            }
        }
        return $this->glyphsCollection;
    }
} 