<?php 

namespace App\Bot\Facebook\States\Workflow\ReadList\Paginate;

use \Botomatic\Engine\Facebook\Entities\Response;
use \Botomatic\Engine\Facebook\Abstracts\States\Workflow\Traits;
use \App\Bot\Facebook\BusinessLogic\ReadList\Models\ReadList as ReadListModel;

/**
 * Class Paginate
 * @package  App\Bot\Facebook\States\Workflow\ReadList\Paginate
 */
class Paginate extends \Botomatic\Engine\Facebook\Abstracts\States\Workflow
{
    use Traits\Steps;

    /**
     * @var  \App\Bot\Facebook\States\Workflow\ReadList\Paginate\Handlers\Responses
     */
    protected $response;

    /**
     * @var  \App\Bot\Facebook\States\Workflow\ReadList\Paginate\Handlers\Message
     */
    protected $message;

    /**
     * @var Services\PaginatedResults
     */
    protected $results;

    /**
     * Paginate constructor.
     */
    public function __construct()
    {
        $this->serializes = ['step', 'results'];
    }


    /**
     * Logic specific to the state
     *
     * @return  \Botomatic\Engine\Facebook\Entities\Response
     */
    protected function process() : Response
    {
        if ($this->isFirstStep())
        {
            // move to next step
            $this->nextStep();

            // Check if we have any links saved
            if ($this->listCount() == 0)
            {
                return $this->response->listIsEmpty();
            }
            else
            {
                $this->results = new Services\PaginatedResults($this->session->getUser());

                return $this->response->resultList($this->results->getFirst(), $this->results->total() > 8);
            }

        }
        // we showed the list, listen for removing items
        else
        {
            if ($this->message->wantsMoreResults())
            {
                return $this->response->resultList($this->results->getNext(), $this->results->results_left() > 0);
            }
            else
            {
                return $this->response->failSafe();
            }
        }
    }

    /**
     * @return int
     */
    protected function listCount() : int
    {
        return ReadListModel::where('user_id', $this->session->getUser()->getId())->count();
    }
}