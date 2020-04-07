<?php

namespace App\Services;

use simplehtmldom\HtmlWeb;

class FetchMetaData
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getTitle()
    {
        $doc = (new HtmlWeb())->load($this->url);

        return $doc->getElementByTagName('title')->innertext;
    }
}
