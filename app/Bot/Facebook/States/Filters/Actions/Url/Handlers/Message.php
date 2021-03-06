<?php 

namespace App\Bot\Facebook\States\Filters\Actions\Url\Handlers;

use Botomatic\Engine\Facebook\Abstracts\States\Message\Traits;


/**
 * Class Message
 * @package  App\Bot\Facebook\States\Filters\Actions\Url\Handlers
 */
class Message extends \Botomatic\Engine\Facebook\Abstracts\States\Message\Handler
{
    use Traits\Normalize;

    /**
     * @return bool
     */
    public function isUrl() : bool
    {
        return filter_var($this->normalizeMessage(), FILTER_VALIDATE_URL);
    }
}
