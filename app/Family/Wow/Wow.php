<?php

namespace Family\Wow;


use OAuth2;
use OAuth2\GrantType;
use OAuth2\AuthorizationCode;

class Wow  {

    private $client_id;
    private $client_secret;
    private $region = 'EU';
    private $locale = 'en_GB';
    private $redirect_url = '';
    private $client;
    /**
     * @param $user
     * @return string
     * @throws OAuth2\Exception
     */
    public function getThumbnail($user)
    {
        $this->client_id = getenv('BLIZZARD_CLIENT_ID');
        $this->client_secret = getenv('BLIZZARD_CLIENT_SECRET');
        $parameters = [
            'name'      =>  $user,
            'server'    =>  'Grim-Batol',
            'fields'    =>  ''
        ];
        $type = 'character';
        try
        {
        $this->client = new OAuth2\Client($this->client_id,$this->client_secret,$this->region,$this->locale, $this->redirect_url);

        $data = $this->client->fetch($type, $parameters);
        }
        catch(OAuth2\Exception $e)
        {
            return 'Något gick fel: '. $e;
        }

        return 'http://eu.battle.net/static-render/eu/'.$data['result']['thumbnail'];

    }

    /**
     * @param $user
     * @param $fields
     * @return mixed
     */
    public function getCharacterWithData($user, $fields)
    {
        $this->client_id = getenv('BLIZZARD_CLIENT_ID');
        $this->client_secret = getenv('BLIZZARD_CLIENT_SECRET');

        $parameters = [
            'name'      =>  $user,
            'server'    =>  'Grim-Batol',
            'fields'    =>  $fields
        ];

        $type = 'character';

        try
        {
            $this->client = new OAuth2\Client($this->client_id,$this->client_secret,$this->region,$this->locale, $this->redirect_url);

            $data = $this->client->fetch($type, $parameters);
        }
        catch (OAuth2\Exception $e)
        {
            return 'Något gick fel'. $e;
        }

        return $data['result'];
    }
    public function getFeed($user)
    {
        $this->client_id = getenv('BLIZZARD_CLIENT_ID');
        $this->client_secret = getenv('BLIZZARD_CLIENT_SECRET');
        $parameters = [
            'name'      =>  $user,
            'server'    =>  'Grim-Batol',
            'fields'    =>  'feed'
        ];

        $type = 'character';

        try
        {
        $this->client = new OAuth2\Client($this->client_id,$this->client_secret,$this->region,$this->locale, $this->redirect_url);

        $data = $this->client->fetch($type, $parameters);
        }
        catch(OAuth2\Exception $e)
        {
            return 'Något gick fel: '.$e;
        }
        return $data['result']['feed'];
    }

    /**
     * @param $id
     * @return mixed
     * @throws OAuth2\Exception
     */
    public function getItem($id)
    {
        $this->client_id = getenv('BLIZZARD_CLIENT_ID');
        $this->client_secret = getenv('BLIZZARD_CLIENT_SECRET');
        $parameters = [
              'id'  => $id
        ];

        $type = 'item';
        try
        {
        $this->client = new OAuth2\Client($this->client_id,$this->client_secret,$this->region,$this->locale, $this->redirect_url);

        $item = $this->client->fetch($type, $parameters);
        }
        catch(OAuth2\Exception $e)
        {
            return 'Något gick fel '. $e;
        }
        return $item['result'];

    }

    /**
     * @param $user
     * @return mixed
     * @throws OAuth2\Exception
     */
    public function getGear($user)
    {
        $this->client_id = getenv('BLIZZARD_CLIENT_ID');
        $this->client_secret = getenv('BLIZZARD_CLIENT_SECRET');
        $parameters = [
            'name'      =>  $user,
            'server'    =>  'Grim-Batol',
            'fields'    =>  'items'
        ];

        $type = 'character';
        try
        {
        $this->client = new OAuth2\Client($this->client_id,$this->client_secret,$this->region,$this->locale, $this->redirect_url);

        $gear = $this->client->fetch($type, $parameters);
        }
        catch(OAuth2\Exception $e)
        {
            return 'Något gick fel '. $e;
        }
        return $gear['result']['items'];
    }
}