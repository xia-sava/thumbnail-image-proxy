<?php

namespace ThumbnailImageProxy;


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
            $siteProc->process();
        }
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
