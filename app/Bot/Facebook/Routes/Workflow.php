<?php

use App\Bot\Facebook\States\Listener\Listener;
use App\Bot\Facebook\States\Workflow\ReadList\AddUrl\AddUrl;
use App\Bot\Facebook\States\Workflow\ReadList\Paginate\Paginate;
use Botomatic\Engine\Facebook\Entities\Response;

return [
    /*--------------------------------------------------------------------------------------------------------------
     *
     *
     * Listener
     *
     *
     -------------------------------------------------------------------------------------------------------------*/
    Listener::class => [
        Response::STATUS_FINISH => null,
    ],

    AddUrl::class => [
        Response::STATUS_FINISH => Listener::class,
    ],

    Paginate::class => [
        Response::STATUS_FINISH => Listener::class,
    ],

];