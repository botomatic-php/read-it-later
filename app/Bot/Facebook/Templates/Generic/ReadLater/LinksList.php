<?php 

namespace App\Bot\Facebook\Templates\Generic\ReadLater;

/**
 * Class LinksList
 * @package  App\Bot\Facebook\Templates\Generic\ReadLater
 */
class LinksList extends \Botomatic\Engine\Facebook\Abstracts\States\Response\Templates\Generic
{
    /**
     * @const string
     */
    const PAYLOAD_PAGINATION_NEXT = 'payload_pagination_next';

    /**
     * LinksList constructor.
     *
     * @param array $items
     * @param bool $add_pagination
     */
    public function __construct(array $items, bool $add_pagination = false)
    {
        $this->payloads_templates = [];

        foreach ($items as $item)
        {
            $this->payloads_templates[] =
            [
                'title' => $item->title,
                    'subtitle' => $item->url,
//                    'image_url' => 'image url',
                'buttons' => [
                    [
                        'type' => 'web_url',
                        'url' => $item->url,
                        'title' => 'View',
                    ],
                    [
                        'type' => 'postback',
                        'payload' => 'payload_remove_url_' . $item->id,
                        'title' => 'Remove',
                    ],
                ]
            ];
        }

        if ($add_pagination == true)
        {
            $this->addPaginationPayload();
        }
    }

    /**
     *
     */
    public function addPaginationPayload()
    {
        $this->payloads_templates[] = [
            'title' => 'Next Page',
            'image_url' => url('/images/more_new.png'),
            'buttons' => [
                [
                    'type' => 'postback',
                    'title' => 'Next',
                    'payload' => self::PAYLOAD_PAGINATION_NEXT,
                ]
            ]
        ];
    }

}