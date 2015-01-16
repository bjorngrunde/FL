<?php


namespace Family\Gear;
use Family\Wow\Wow;
use Illuminate\Support\Facades\Cache;

class ProfileFeed extends GearToLinks {
    protected $newsFeed = [];
    protected $gearslots = [];
    protected $talents = [];
    protected $glyphsCollection = [];
    protected $forumFeed = [];
    private $i = 0;
    /**
     * @var
     */
    private $wow;

    /**
     * @param Wow $wow
     */
    public function __construct(Wow $wow)
    {
        $this->wow = $wow;
    }
    /**
     * @param $feed
     * @return array
     */
    public function feed($feed)
    {


    foreach($feed as $data)
    {
        if($this->i < 7)
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
                $item = $this->wow->getItem($data['itemId']);
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

    /**
     * @param $gear
     * @return array
     */
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

    /** public function title($data)
     * {
     * foreach ($data as $title) {
     * if (array_key_exists('selected', $title)) {
     * $untrimmed = $title['name'];
     * $title = ltrim($untrimmed, '%s,');
     *
     * return $title;
     * }
     * }
     * }
     * @param $threads
     * @param $comments
     * @param $raids
     * @return array
     */
    public function forumFeed($threads, $comments, $raids)
    {
        $threadsArray   =   $threads->toArray();
        $commentsArray  =   $comments->toArray();
        $raidsArray     =   $raids->toArray();

        array_slice($threadsArray, 0, 3);
        array_slice($commentsArray, 0, 3);
        array_slice($raidsArray, 0, 3);

        foreach($threadsArray as $thread)
        {
            $pushThread = 'Skapade tråden: <a href="/forum/thread/'.$thread['id'].'">'.$thread['title'].'</a>';
            array_push($this->forumFeed, $pushThread);
        }
        foreach($commentsArray as $comment)
        {
            $body = strip_tags($comment['body']);
            if(strlen($body) > 20)
            {
               $body = substr($body, 0, 20);
            }
            $pushComment = 'Lämnade en kommentar: <a href="/forum/thread/'.$comment['thread_id'].'">'.$body.'..</a>';
            array_push($this->forumFeed, $pushComment);
        }
        foreach($raidsArray as $raid)
        {
            $pushRaid = 'Signade upp på: <a href="/flrs/show/'.$raid['id'].'">'.$raid['title']. ' ( '. $raid['mode']. ' ) </a>';
            array_push($this->forumFeed, $pushRaid);
        }

        shuffle($this->forumFeed);

        return $this->forumFeed;
    }
} 