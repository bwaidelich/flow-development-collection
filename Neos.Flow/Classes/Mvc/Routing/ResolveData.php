<?php
namespace Neos\Flow\Mvc\Routing;

/*
 * This file is part of the Neos.Flow package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Neos\Flow\Http\Request as HttpRequest;

/**
 * DTO that is sent to RouterInterface::resolve() in order to return an URI according to the Routing setup
 *
 * TODO: Find a better name for this class ;)
 *
 * @api
 */
class ResolveData
{
    /**
     * @var HttpRequest
     */
    protected $httpRequest;

    /**
     * @var array
     */
    protected $routeValues;

    /**
     * @var string
     */
    protected $uriPrefix;

    /**
     * @var bool
     */
    protected $forceAbsoluteUri;

    /**
     * @var string|null
     */
    protected $forceScheme;

    /**
     * @param HttpRequest $httpRequest
     * @param array $routeValues
     * @param string $uriPrefix
     * @param bool $forceAbsoluteUri
     * @param null|string $forceScheme
     */
    public function __construct(HttpRequest $httpRequest, array $routeValues, string $uriPrefix = '', bool $forceAbsoluteUri = false, string $forceScheme = null)
    {
        $this->httpRequest = $httpRequest;
        $this->routeValues = $routeValues;
        $this->uriPrefix = $uriPrefix;
        $this->forceAbsoluteUri = $forceAbsoluteUri;
        $this->forceScheme = $forceScheme;
    }

    public function getRouteValues(): array
    {
        return $this->routeValues;
    }

    public function isSchemeForced(): bool
    {
        return $this->forceScheme !== null;
    }

    public function forcedSchemeEqualsCurrentScheme(): bool
    {
        if (!$this->isSchemeForced()) {
            return true;
        }
        return $this->forceScheme === $this->getCurrentScheme();
    }

    public function getCurrentScheme(): string
    {
        return $this->httpRequest->getUri()->getScheme();
    }

    public function getCurrentHost(): string
    {
        return $this->httpRequest->getUri()->getHost();
    }

    public function isAbsoluteUriForced(): bool
    {
        return $this->forceAbsoluteUri;
    }

    public function getUriPrefix(): string
    {
        return $this->uriPrefix;
    }

    public function getForcedScheme()
    {
        return $this->forceScheme;
    }

}
