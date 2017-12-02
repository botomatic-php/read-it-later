<?php

namespace App\Bot\Facebook\BusinessLogic\ReadList\Services;

class UrlData
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $title = null;

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var null
     */
    protected $image = null;

    /**
     * UrlData constructor.
     *
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;

        $doc = new \DOMDocument();
        @$doc->loadHTMLFile($this->url);

        foreach($doc->getElementsByTagName('meta') as $meta)
        {
            if ($meta->getAttribute('property') =='og:title')
            {
                $this->title = $meta->getAttribute('content');
            }

            if ($meta->getAttribute('property') =='og:description')
            {
                $this->description = $meta->getAttribute('content');
            }

            if ($meta->getAttribute('property') =='og:image')
            {
                $this->image = $meta->getAttribute('content');
            }
        }


        /*--------------------------------------------------------------------------------------------------------------
         *
         * If the Page doesn't have og: meta data find the information in tags
         *
         -------------------------------------------------------------------------------------------------------------*/

        if (is_null($this->title))
        {
            $this->title = $doc->getElementsByTagName('title')->item(0)->nodeValue;
            $this->description = $url;

            // todo: need more logic here to determine the proper image
            $images = $doc->getElementsByTagName('img');

            foreach ($images as $image)
            {
                $img_src = $image->attributes->getNamedItem("src")->value;

                if (substr($img_src, 0, 3) == 'http')
                {
                    $this->image = $img_src;
                    break;
                }
                else
                {
                    if ($img_src[0] != '/')
                    {
                        $img_src .= '/';
                    }
                    $this->image = $this->url . $img_src;
                }
            }
        }
    }

    /**
     * @return string
     */
    public function getUrl() : string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Extract the title of the Page
     *
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }


    /**
     * Extract an image from the url to be used as preview
     *
     * @return string
     */
    public function getPreviewImage() : string
    {
        return $this->image;
    }

    /**
     * @return bool
     */
    public function weHaveExtractedImage() : bool
    {
        return $this->image != null;
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return ['url', 'title', 'image'];
    }
}