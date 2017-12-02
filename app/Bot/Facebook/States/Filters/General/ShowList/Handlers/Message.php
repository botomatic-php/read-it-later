<?php 

namespace App\Bot\Facebook\States\Filters\General\ShowList\Handlers;

use Botomatic\Engine\Facebook\Abstracts\States\Message\Traits;

/**
 * Class Message
 * @package  App\Bot\Facebook\States\Filters\General\ShowList\Handlers
 */
class Message extends \Botomatic\Engine\Facebook\Abstracts\States\Message\Handler
{
    use Traits\Normalize;

    /**
     * @return bool
     */
    public function wantsToSeeTheList() : bool
    {
        return $this->normalizeMessage() == 'show me the list';
    }

}
