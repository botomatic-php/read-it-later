<?php 

namespace App\Bot\Facebook\States\Workflow\ReadList\AddUrl\Handlers;

use App\Bot\Facebook\Templates\Generic\ReadLater\Confirmation;

/**
 * Class Message
 * @package  App\Bot\Facebook\States\Workflow\ReadList\AddUrl\Handlers
 */
class Message extends \Botomatic\Engine\Facebook\Abstracts\States\Message\Handler
{
    /**
     * @return string
     */
    public function getUrl() : string
    {
        return $this->message()->getMessage();
    }

    /**
     * @return bool
     */
    public function isConfirmationToSave() : bool
    {
        return $this->message()->postback()->getPayload() == Confirmation::PAYLOAD_SAVE;
    }
}
