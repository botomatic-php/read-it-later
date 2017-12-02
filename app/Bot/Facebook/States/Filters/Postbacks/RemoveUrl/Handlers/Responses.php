<?php 

namespace App\Bot\Facebook\States\Filters\Postbacks\RemoveUrl\Handlers;

use \Botomatic\Engine\Facebook\Entities\Response;

/**
 * Class Responses
 * @package  App\Bot\Facebook\States\Filters\Postbacks\RemoveUrl\Handlers
 */
class Responses extends \Botomatic\Engine\Facebook\Abstracts\States\Response\Handler
{
    /**
     * @param string $link
     *
     * @return Response
     */
    public function removedLink(string $link) : Response
    {
        return $this->response->addMessage('I removed "' . $link . '" from the list')
            ->sendResponse();
    }

    /**
     * @return Response
     */
    public function linkToBeRemovedDoesntExist() : Response
    {
        return $this->response->addMessage('I can\'t find this link in my database... I think I removed it already.')
            ->sendResponse();
    }
}
