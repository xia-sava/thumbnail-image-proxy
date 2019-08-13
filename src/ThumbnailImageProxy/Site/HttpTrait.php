<?php

namespace ThumbnailImageProxy\Site;

use Composer\CaBundle\CaBundle;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

trait HttpTrait
{
    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * @return Client
     */
    public function getGuzzleClient(): Client
    {
        if ($this->guzzleClient === null) {
            $this->guzzleClient = new Client([
                RequestOptions::VERIFY => CaBundle::getSystemCaRootBundlePath()
            ]);
        }
        return $this->guzzleClient;
    }

    public function passthru(string $uri): ResponseInterface
    {
        return $this->getGuzzleClient()->get($uri);
    }
}
