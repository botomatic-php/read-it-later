<?php 

namespace App\Bot\Facebook\States\Workflow\ReadList\AddUrl;

use \Botomatic\Engine\Facebook\Entities\Response;
use \Botomatic\Engine\Facebook\Abstracts\States\Workflow\Traits;

/**
 * Class AddUrl
 * @package  App\Bot\Facebook\States\Workflow\ReadList\AddUrl
 */
class AddUrl extends \Botomatic\Engine\Facebook\Abstracts\States\Workflow
{

    use Traits\Steps;

    /**
     * @var  \App\Bot\Facebook\States\Workflow\ReadList\AddUrl\Handlers\Responses
     */
    protected $response;

    /**
     * @var  \App\Bot\Facebook\States\Workflow\ReadList\AddUrl\Handlers\Message
     */
    protected $message;

    /**
     * Logic specific to the state
     *
     * @return  \Botomatic\Engine\Facebook\Entities\Response
     */
    protected function process() : Response
    {
        return $this->response->responseDefault();
    }
}