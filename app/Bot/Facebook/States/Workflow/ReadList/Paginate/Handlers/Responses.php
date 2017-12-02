<?php 

namespace App\Bot\Facebook\States\Workflow\ReadList\Paginate\Handlers;

use App\Bot\Facebook\Templates\Generic\ReadLater\Confirmation;
use App\Bot\Facebook\Templates\Generic\ReadLater\LinksList;
use \Botomatic\Engine\Facebook\Entities\Response;

/**
 * Class Responses
 * @package  App\Bot\Facebook\States\Workflow\ReadList\Paginate\Handlers
 */
class Responses extends \Botomatic\Engine\Facebook\Abstracts\States\Response\Handler
{
    /**
     * @param array $items
     * @param bool $with_pagination
     *
     * @return Response
     */
    public function resultList(array $items, bool $with_pagination = false) : Response
    {
          return $this->response
              ->addGenericTemplate(new LinksList($items, $with_pagination))
              ->sendResponse()
              ->setStatusActive();
    }

    /**
     * @return Response
     */
    public function listIsEmpty() : Response
    {
        return $this->response->addMessage('You don\'t have any links saved, simply give me a link and I will save it for you.')
            ->setStatusFinish()
            ->sendResponse();
    }

    /**
     * @return Response
     */
    public function failSafe() : Response
    {
        return $this->response->addMessage('Hmmmm, not sure what you want from me')
            ->sendResponse();
    }
}
