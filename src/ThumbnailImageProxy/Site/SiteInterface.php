<?php


namespace ThumbnailImageProxy\Site;


use Psr\Http\Message\ResponseInterface;

abstract class SiteInterface
{
    /**
     * @var string
     */
    protected $targetUri;

    /**
     * AbstractSite constructor.
     * @param string $targetUri
     */
    public function __construct(string $targetUri)
    {
        $this->targetUri = $targetUri;
    }

    /**
     * @return ResponseInterface
     */
    abstract public function process(): ResponseInterface;
}
