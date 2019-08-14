<?php

namespace ThumbnailImageProxy\Site;

use Composer\CaBundle\CaBundle;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
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

    public function redirect(string $uri): ResponseInterface
    {
        return (new Response())
            ->withStatus(302)
            ->withHeader('Location', $uri);
    }
}
