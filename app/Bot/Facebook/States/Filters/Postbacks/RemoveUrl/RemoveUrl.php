<?php 

namespace App\Bot\Facebook\States\Filters\Postbacks\RemoveUrl;

use \Botomatic\Engine\Facebook\Entities\Response;
use \App\Bot\Facebook\BusinessLogic\ReadList\Models\ReadList as ReadListModel;

/**
 * Class RemoveUrl
 * @package  App\Bot\Facebook\States\Filters\Postbacks\RemoveUrl
 */
class RemoveUrl extends \Botomatic\Engine\Facebook\Abstracts\States\Filter
{
    /**
     * @var  \App\Bot\Facebook\States\Filters\Postbacks\RemoveUrl\Handlers\Responses
     */
    protected $response;

    /**
     * @var  \App\Bot\Facebook\States\Filters\Postbacks\RemoveUrl\Handlers\Message
     */
    protected $message;

    /**
     * Logic specific to the state
     *
     * @return  \Botomatic\Engine\Facebook\Entities\Response
     */
    protected function process() : Response
    {
        if ($this->message->wantsToRemoveLink())
        {
            $url = ReadListModel::find($this->message->getIdToRemove());

            if (!empty($url))
            {
                $url_value = $url->url;

                $url->delete();

                return $this->response->removedLink($url_value);
            }
            else
            {
                return $this->response->linkToBeRemovedDoesntExist();
            }
        }
        return $this->response->response();
    }
}