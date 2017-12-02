<?php 

namespace App\Bot\Facebook\States\Filters\General\ShowList;

use \Botomatic\Engine\Facebook\Entities\Response;

/**
 * Class ShowList
 * @package  App\Bot\Facebook\States\Filters\General\ShowList
 */
class ShowList extends \Botomatic\Engine\Facebook\Abstracts\States\Filter
{
    /**
     * @var  \App\Bot\Facebook\States\Filters\General\ShowList\Handlers\Responses
     */
    protected $response;

    /**
     * @var  \App\Bot\Facebook\States\Filters\General\ShowList\Handlers\Message
     */
    protected $message;

    /**
     * Logic specific to the state
     *
     * @return  \Botomatic\Engine\Facebook\Entities\Response
     */
    protected function process() : Response
    {
        if ($this->message->wantsToSeeTheList())
        {
            return $this->jumpToWorkflowState(new \App\Bot\Facebook\States\Workflow\ReadList\Paginate\Paginate());
        }

        return $this->response->response();
    }

}