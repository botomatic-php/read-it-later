<?php 

namespace App\Bot\Facebook\States\Workflow\ReadList\AddUrl;

use App\Bot\Facebook\BusinessLogic\ReadList\Models\ReadList;
use App\Bot\Facebook\BusinessLogic\ReadList\Services\UrlData;
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
     * @var \App\Bot\Facebook\BusinessLogic\ReadList\Services\UrlData
     */
    protected $readitlater;

    /**
     * @var array
     */
    protected $serializes = ['readitlater', 'step'];

    /**
     * Logic specific to the state
     *
     * @return  \Botomatic\Engine\Facebook\Entities\Response
     */
    protected function process() : Response
    {
        /*--------------------------------------------------------------------------------------------------------------
         *
         * Extract the URL, save the data and ask for confirmation
         *
         -------------------------------------------------------------------------------------------------------------*/
        if ($this->isFirstStep())
        {
            /**
             * Check if the url already exists
             */
            if (ReadList::where('user_id', $this->session->getUser()->getId())->where('url', $this->message->getUrl())->exists())
            {
                return $this->response->urlExists();
            }

            /**
             * Extract information from the URL
             */
            try
            {
                $this->readitlater = new UrlData($this->message->getUrl());
            }
            catch (\Exception $exception)
            {
                return $this->response->invalidUrl($this->message->getUrl());
            }

            // move to the next step
            $this->nextStep();

            /**
             * Show confirmation
             */
            return $this->response->confirmUrl($this->readitlater);
        }
        else
        {
            if ($this->message->isConfirmationToSave())
            {
                $model = new ReadList();

                $model->user_id = $this->session->getUser()->getId();
                $model->url = $this->readitlater->getUrl();
                $model->title = $this->readitlater->getTitle();

                if ($this->readitlater->weHaveExtractedImage())
                {
                    $model->img = $this->readitlater->getPreviewImage();
                }

                $model->save();

                return $this->response->tellIsSaved($model->url);
            }
        }

    }
}