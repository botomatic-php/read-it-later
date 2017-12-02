<?php 

namespace App\Bot\Facebook\States\Workflow\ReadList\AddUrl\Handlers;

use App\Bot\Facebook\Templates\Generic\ReadLater\Confirmation;

use \Botomatic\Engine\Facebook\Entities\Response;

/**
 * Class Responses
 * @package  App\Bot\Facebook\States\Workflow\ReadList\AddUrl\Handlers
 */
class Responses extends \Botomatic\Engine\Facebook\Abstracts\States\Response\Handler
{
    /**
     * @param \App\Bot\Facebook\BusinessLogic\ReadList\Services\UrlData $data
     * @return Response
     */
    public function confirmUrl(\App\Bot\Facebook\BusinessLogic\ReadList\Services\UrlData $data) : Response
    {
          return $this->response
              ->addGenericTemplate(new Confirmation($data))
              ->setStatusActive()
              ->sendResponse();
    }

    /**
     * @param string $url
     *
     * @return Response
     */
    public function invalidUrl(string $url) : Response
    {
          return $this->response
              ->addMessage('There is something wrong with "' . $url .'". I can not read it...')
              ->setStatusActive()
              ->sendResponse();
    }

    /**
     * @return Response
     */
    public function tellIsSaved(string $url) : Response
    {
        return $this->response
            ->addMessage('I added "' . $url .'" to the list.')
            ->sendResponse()
            ->setStatusFinish();
    }

    /**
     * @return Response
     */
    public function urlExists() : Response
    {
        return $this->response
            ->addMessage('I already added this url on the list.')
            ->sendResponse()
            ->setStatusFinish();
    }
}
