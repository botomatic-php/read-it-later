<?php 

namespace App\Bot\Facebook\States\Filters\Postbacks\Menu\Handlers;

use \App\Bot\Facebook\States\Filters\Postbacks\Menu\BusinessModel\Payloads;


/**
 * Class Message
 * @package  App\Bot\Facebook\States\Filters\Postbacks\Menu\Handlers
 */
class Message extends \Botomatic\Engine\Facebook\Abstracts\States\Message\Handler
{
    /**
     * @return bool
     */
    public function isList() : bool
    {
        return $this->message()->postback()->getPayload() == Payloads::PAYLOAD_LIST;
    }
}
