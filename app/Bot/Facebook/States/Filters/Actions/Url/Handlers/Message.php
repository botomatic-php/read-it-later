<?php 

namespace App\Bot\Facebook\States\Filters\Actions\Url\Handlers;

/**
 * Class Message
 * @package  App\Bot\Facebook\States\Filters\Actions\Url\Handlers
 */
class Message extends \Botomatic\Engine\Facebook\Abstracts\States\Message\Handler
{
    /**
     * @return bool
     */
    public function isUrl() : bool
    {
        return filter_var($this->message()->getMessage(), FILTER_VALIDATE_URL);
    }
}
