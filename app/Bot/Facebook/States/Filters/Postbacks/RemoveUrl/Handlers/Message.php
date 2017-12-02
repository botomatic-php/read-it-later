<?php 

namespace App\Bot\Facebook\States\Filters\Postbacks\RemoveUrl\Handlers;

/**
 * Class Message
 * @package  App\Bot\Facebook\States\Filters\Postbacks\RemoveUrl\Handlers
 */
class Message extends \Botomatic\Engine\Facebook\Abstracts\States\Message\Handler
{
    /**
     * @return bool
     */
    public function wantsToRemoveLink() : bool
    {
        return str_contains($this->message()->postback()->getPayload(), 'payload_remove_url_');
    }

    /**
     * @return int
     */
    public function getIdToRemove() : int
    {
        return preg_replace('/\D/', '', $this->message()->postback()->getPayload());
    }

}
