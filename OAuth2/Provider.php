<?php

namespace SixBySix\Freeagent\OAuth2;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;
use SixBySix\Freeagent\Entity\Company;

/**
 * Class Provider
 * @package SixBySix\Freeagent\OAuth2
 */
class Provider extends AbstractProvider
{
    /**
     * @var
     */
    private static $instance;


    /**
     * @var string
     */
    public $responseType = 'string';

    /**
     * @var string
     */
    public $baseURL = 'https://api.freeagent.com/v2/';

    /**
     * Provider constructor.
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        parent::__construct($options);
        if (isset($options['sandbox']) && $options['sandbox']) {
            $this->baseURL = 'https://api.sandbox.freeagent.com/v2/';
        }
    }

    /**
     * Returns the base URL for authorizing a client.
     *
     * Eg. https://oauth.service.com/authorize
     *
     * @return string
     */
    public function getBaseAuthorizationUrl()
    {
        return $this->baseURL . 'approve_app';
    }

    /**
     * Returns the base URL for requesting an access token.
     *
     * Eg. https://oauth.service.com/token
     *
     * @param array $params
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return $this->baseURL . 'token_endpoint';
    }

    /**
     * Returns the URL for requesting the resource owner's details.
     *
     * @param AccessToken $token
     * @return string
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return $this->baseURL . 'company';
    }

    /**
     * Returns the default scopes used by this provider.
     *
     * This should only be the scopes that are required to request the details
     * of the resource owner, rather than all the available scopes.
     *
     * @return array
     */
    protected function getDefaultScopes()
    {
        return array('default');
    }

    /**
     * Checks a provider response for errors.
     *
     * @throws IdentityProviderException
     * @param  ResponseInterface $response
     * @param  array|string $data Parsed response data
     * @return void
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (!empty($data['error'])) {
            throw new IdentityProviderException($data['error'], 401, $data);
        }
    }

    /**
     * Returns the default headers used by this provider.
     *
     * Typically this is used to set 'Accept' or 'Content-Type' headers.
     *
     * @return array
     */
    protected function getDefaultHeaders()
    {
        return [
            'Accept' => 'application/json',
        ];
    }

    /**
     * Returns the authorization headers used by this provider.
     *
     * @param  mixed|null $token Either a string or an access token instance
     * @return array
     */
    protected function getAuthorizationHeaders($token = null)
    {
        return [
            'Authorization' => 'Bearer ' . $token->getToken(),
        ];
    }

    /**
     * Generates a resource owner object from a successful resource owner
     * details request.
     *
     * @param  array $response
     * @param  AccessToken $token
     * @return Company
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        /** @var array $response */
        $response = (array)($response->company);

        /** @var Company $company */
        $company = new Company($response);

        return $company;
    }
}
