<?php


namespace ThumbnailImageProxy\Site;


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
     * @return void
     */
    abstract public function process(): void;
}
