<?php 

namespace App\Bot\Facebook\Templates\Generic\ReadLater;

/**
 * Class Confirmation
 * @package  App\Bot\Facebook\Templates\Generic\ReadLater
 */
class Confirmation extends \Botomatic\Engine\Facebook\Abstracts\States\Response\Templates\Generic
{
    const PAYLOAD_SAVE = 'readlater_confirmation_save';

    /**
     * Confirmation constructor.
     *
     * @param \App\Bot\Facebook\BusinessLogic\ReadList\Services\UrlData $data
     */
    public function __construct(\App\Bot\Facebook\BusinessLogic\ReadList\Services\UrlData $data)
    {
        $element = [
            'title' => $data->getTitle(),
                'subtitle' => $data->getDescription(),
//                'image_url' => 'image url',
            'buttons' => [
                [
                    'type' => 'postback',
                    'title' => 'Save',
                    'payload' => self::PAYLOAD_SAVE,
                ]
            ]
        ];

        if ($data->weHaveExtractedImage())
        {
            $element['image_url'] = $data->getPreviewImage();
        }

        $this->payloads_templates = [
            $element,
        ];
    }

}