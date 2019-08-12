<?php

namespace ThumbnailImageProxy\Site;


class PeingNet extends SiteInterface
{
    use HttpTrait;
    use HtmlFetchTrait;

    public function process(): void
    {
        $html = $this->fetchHtml($this->targetUri);
        $imageUri =
            $html->filter('.eye-catch-wrapper h1 a img')
                ->first()
                ->attr('src');

        $this->redirectTo($imageUri);
    }
}
