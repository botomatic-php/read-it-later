<?php 

namespace App\Bot\Facebook\States\Filters\Actions\Url;

use \Botomatic\Engine\Facebook\Entities\Response;

/**
 * Class Url
 * @package  App\Bot\Facebook\States\Filters\Actions\Url
 */
class Url extends \Botomatic\Engine\Facebook\Abstracts\States\Filter
{
    /**
     * @var  \App\Bot\Facebook\States\Filters\Actions\Url\Handlers\Responses
     */
    protected $response;

    /**
     * @var  \App\Bot\Facebook\States\Filters\Actions\Url\Handlers\Message
     */
    protected $message;

    /**
     * Logic specific to the state
     *
     * @return  \Botomatic\Engine\Facebook\Entities\Response
     */
    protected function process() : Response
    {
        if ($this->message->isUrl())
        {
            return $this->jumpToWorkflowState(new \App\Bot\Facebook\States\Workflow\ReadList\AddUrl\AddUrl());
        }

        return $this->response->response();
    }

}