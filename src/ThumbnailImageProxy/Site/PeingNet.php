<?php

namespace ThumbnailImageProxy\Site;


use Psr\Http\Message\ResponseInterface;

class PeingNet extends SiteInterface
{
    use HttpTrait;
    use HtmlFetchTrait;

    public function process(): ResponseInterface
    {
        $html = $this->fetchHtml($this->targetUri);
        $imageUri =
            $html->filter('.eye-catch-wrapper h1 a img')
                ->first()
                ->attr('src');

        return $this->passthru($imageUri);
    }
}
