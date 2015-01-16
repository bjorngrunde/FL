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
     * @param $server
     * @return string
     */
    public function getThumbnail($user, $server)
    {
        $this->client_id = getenv('BLIZZARD_CLIENT_ID');
        $this->client_secret = getenv('BLIZZARD_CLIENT_SECRET');
        $corServer = str_replace(' ', '-',  $server);

        $parameters = [
            'name'      =>  $user,
            'server'    =>  $corServer,
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
    public function getCharacterWithData($user, $fields, $server)
    {
        $this->client_id = getenv('BLIZZARD_CLIENT_ID');
        $this->client_secret = getenv('BLIZZARD_CLIENT_SECRET');
        $corServer = str_replace(' ', '-', $server);
        $parameters = [
            'name'      =>  $user,
            'server'    =>  $corServer,
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
}