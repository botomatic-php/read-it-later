<?php 

namespace App\Bot\Facebook\States\Filters\Postbacks\Menu;

use \Botomatic\Engine\Facebook\Entities\Response;

/**
 * Class Menu
 * @package  App\Bot\Facebook\States\Filters\Postbacks\Menu
 */
class Menu extends \Botomatic\Engine\Facebook\Abstracts\States\Filter
{
    /**
     * @var  \App\Bot\Facebook\States\Filters\Postbacks\Menu\Handlers\Responses
     */
    protected $response;

    /**
     * @var  \App\Bot\Facebook\States\Filters\Postbacks\Menu\Handlers\Message
     */
    protected $message;

    /**
     * Logic specific to the state
     *
     * @return  \Botomatic\Engine\Facebook\Entities\Response
     */
    protected function process() : Response
    {
        if ($this->message->isList())
        {
            return $this->jumpToWorkflowState(new \App\Bot\Facebook\States\Workflow\ReadList\Paginate\Paginate());
        }

        return $this->response->response();
    }
}