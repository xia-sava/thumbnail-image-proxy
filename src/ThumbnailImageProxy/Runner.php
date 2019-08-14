<?php

namespace ThumbnailImageProxy;


use Psr\Http\Message\ResponseInterface;

class Runner
{
    /**
     * @var string[]
     */
    private $siteConfig = [
        'peing.net' => Site\PeingNet::class,
    ];

    /**
     * entry point.
     */
    public function main(): void
    {
        [$domain, $targetUri] = $this->parseArgs();
        $site = $this->siteConfig[$domain] ?: '';
        if ($site !== '') {
            /** @var Site\SiteInterface $siteProc */
            $siteProc = new $site($targetUri);
            $response = $siteProc->process();
            $this->response($response);
        }
    }

    /**
     * @param ResponseInterface $response
     */
    public function response(ResponseInterface $response): void
    {
        $headers = [
            'content-type',
            'location',
        ];
        foreach ($headers as $header) {
            $value = $response->getHeaderLine($header);
            if ($value !== '') {
                header("{$header}: {$value}");
            }
        }
        header("Status: {$response->getStatusCode()}");
        print $response->getBody()->getContents();
    }

    /**
     * @return string[]
     */
    private function parseArgs(): array
    {
        if (preg_match('#^.*?/-/(.+)$#', $_SERVER['REQUEST_URI'], $match)) {
            $targetUri = $match[1];
            $domain = parse_url($targetUri, PHP_URL_HOST);
            return [(string)$domain, (string)$targetUri];
        }
        return ['', ''];
    }
}
