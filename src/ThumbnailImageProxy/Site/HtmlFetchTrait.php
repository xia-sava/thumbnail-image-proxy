<?php


namespace ThumbnailImageProxy\Site;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

trait HtmlFetchTrait
{
    use HttpTrait;

    /**
     * @var Client
     */
    private $goutteClient;

    /**
     * @param string $uri
     * @param string $method
     * @return Crawler
     */
    public function fetchHtml(string $uri, string $method = 'GET'): Crawler
    {
        $client = $this->getGoutteClient();
        return $client->request($method, $uri);
    }

    /**
     * @return Client
     */
    public function getGoutteClient(): Client
    {
        if ($this->goutteClient === null) {
            $this->goutteClient = new Client();
            $this->goutteClient->setClient($this->getGuzzleClient());
        }
        return $this->goutteClient;
    }
}
