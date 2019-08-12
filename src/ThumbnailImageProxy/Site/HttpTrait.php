<?php

namespace ThumbnailImageProxy\Site;

use Composer\CaBundle\CaBundle;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

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

    public function redirectTo(string $uri): void
    {
        header("Location: $uri");
    }
}
