<?php 

namespace App\Bot\Facebook\States\Workflow\ReadList\Paginate\Handlers;

/**
 * Class Message
 * @package  App\Bot\Facebook\States\Workflow\ReadList\Paginate\Handlers
 */
class Message extends \Botomatic\Engine\Facebook\Abstracts\States\Message\Handler
{

    /**
     * Pagination next
     *
     * @return bool
     */
    public function wantsMoreResults() : bool
    {
        return $this->message()->postback()->getPayload() == \App\Bot\Facebook\Templates\Generic\ReadLater\LinksList::PAYLOAD_PAGINATION_NEXT;
    }
}
