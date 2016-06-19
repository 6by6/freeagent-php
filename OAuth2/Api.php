<?php

namespace SixBySix\Freeagent\OAuth2;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use SixBySix\Freeagent\Entity\AbstractEntity;
use SixBySix\Freeagent\Entity\AbstractEntityFilter;
use SixBySix\Freeagent\Entity\BankAccount;
use SixBySix\Freeagent\Entity\BankTransaction;
use SixBySix\Freeagent\Entity\BankTransactionExplanation;
use SixBySix\Freeagent\Entity\Bill;
use SixBySix\Freeagent\Entity\CapitalAsset;
use SixBySix\Freeagent\Entity\Company;
use SixBySix\Freeagent\Entity\Contact;
use SixBySix\Freeagent\Entity\Estimate;
use SixBySix\Freeagent\Entity\Invoice;
use SixBySix\Freeagent\Entity\InvoiceTimelineItem;
use SixBySix\Freeagent\Entity\JournalSet;
use SixBySix\Freeagent\Entity\Note;
use SixBySix\Freeagent\Entity\RecurringInvoice;
use SixBySix\Freeagent\Entity\StockItem;
use SixBySix\Freeagent\Entity\Task;
use SixBySix\Freeagent\Entity\Project;
use SixBySix\Freeagent\Entity\Timeslip;
use SixBySix\Freeagent\Entity\User;
use SixBySix\Freeagent\Exception;
use SixBySix\Freeagent\OAuth2\Provider as OAuthProvider;

/**
 * Class Api
 * @package SixBySix\Freeagent\OAuth2
 */
class Api
{
    /**
     *
     */
    const PER_PAGE = 100;

    /** @var  Provider */
    protected $provider;

    /** @var  string */
    protected $clientId;

    /** @var  string */
    protected $clientSecret;

    /** @var  boolean */
    protected $sandbox;

    /** @var  string */
    protected $refreshToken;

    /** @var  \League\OAuth2\Client\Token\AccessToken */
    protected $accessToken;

    /** @var  Serializer */
    protected $serializer;

    /**
     * Api constructor.
     * @param $clientId
     * @param $clientSecret
     * @param $refreshToken
     * @param bool $sandbox
     */
    public function __construct($clientId, $clientSecret, $refreshToken, $sandbox = false)
    {
        $this->setSerializer(
            SerializerBuilder::create()->build()
        );

        $this->setClientId($clientId);
        $this->setClientSecret($clientSecret);
        $this->setRefreshToken($refreshToken);
        $this->setIsSandbox($sandbox);
    }

    /**
     *
     */
    public function connect()
    {
        /** @var OAuthProvider $provider */
        $this->setProvider(
            new OAuthProvider([
                'sandbox' => $this->isSandbox(),
                'clientId' => $this->getClientId(),
                'clientSecret' => $this->getClientSecret(),
                'responseType' => "JSON"
            ])
        );

        $this->setAccessToken(
            $this->provider->getAccessToken("refresh_token", [
                'refresh_token' => $this->getRefreshToken(),
            ])
        );
    }

    /**
     * @return Provider
     */
    public function getProvider()
    {
        if (!$this->provider) {
            $this->connect();
        }

        return $this->provider;
    }

    /**
     * @param Provider $provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return boolean
     */
    public function isSandbox()
    {
        return $this->sandbox;
    }

    /**
     * @param boolean $sandbox
     */
    public function setIsSandbox($sandbox)
    {
        $this->sandbox = (bool) $sandbox;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @param string $refreshToken
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     * @return \League\OAuth2\Client\Token\AccessToken
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param \League\OAuth2\Client\Token\AccessToken $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return Serializer
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * @param Serializer $serializer
     */
    public function setSerializer($serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @return Company
     */
    public function getCompany()
    {
        return $this->getOneResourceByUrl(
            $this->getUrl('company')
        );
    }

    /**
     * @return BankAccount
     */
    public function bankAccount()
    {
        return $this->entityFactory(new BankAccount());
    }

    /**
     * @return BankTransaction
     */
    public function bankTransaction()
    {
        return $this->entityFactory(new BankTransaction());
    }

    /**
     * @return BankTransactionExplanation
     */
    public function bankTransactionExplanation()
    {
        return $this->entityFactory(new BankTransactionExplanation());
    }

    /**
     * @return Bill
     */
    public function bill()
    {
        return $this->entityFactory(new Bill());
    }

    /**
     * @return CapitalAsset
     */
    public function capitalAsset()
    {
        return $this->entityFactory(new CapitalAsset());
    }

    /**
     * @return Company
     */
    public function company()
    {
        return $this->entityFactory(new Company());
    }

    /**
     * @return Contact
     */
    public function contact()
    {
        return $this->entityFactory(new Contact());
    }

    /**
     * @return Estimate
     */
    public function estimate()
    {
        return $this->entityFactory(new Estimate());
    }

    /**
     * @return Invoice
     */
    public function invoice()
    {
        return $this->entityFactory(new Invoice());
    }

    /**
     * @return InvoiceTimelineItem
     */
    public function invoiceTimeline()
    {
        return $this->entityFactory(new InvoiceTimelineItem());
    }

    /**
     * @return JournalSet
     */
    public function journalSet()
    {
        return $this->entityFactory(new JournalSet());
    }

    /**
     * @return Note
     */
    public function note()
    {
        return $this->entityFactory(new Note());
    }

    /**
     * @return Project
     */
    public function project()
    {
        return $this->entityFactory(new Project());
    }

    /**
     * @return RecurringInvoice
     */
    public function recurringInvoice()
    {
        return $this->entityFactory(new RecurringInvoice());
    }

    /**
     * @return StockItem
     */
    public function stockItem()
    {
        return $this->entityFactory(new StockItem());
    }

    /**
     * @return Task
     */
    public function task()
    {
        return $this->entityFactory(new Task());
    }

    /**
     * @return Timeslip
     */
    public function timeslip()
    {
        return $this->entityFactory(new Timeslip());
    }

    /**
     * @return User
     */
    public function user()
    {
        return $this->entityFactory(new User());
    }

    /**
     * @param null $resourceName
     * @param array $params
     * @return string
     */
    public function getUrl($resourceName = null, array $params = [])
    {
        /** @var string $url */
        $url = $this->getProvider()->baseURL;

        if ($resourceName) {
            $url .= $resourceName;
        }

        /** @var mixed[] $oParams */
        $oParams = array();

        /** @var mixed[] $urlParts */
        $urlParts = parse_url($url);

        if (isset($urlParts['query'])) {
            parse_str($urlParts['query'], $oParams);
        }

        $oParams = array_replace_recursive($oParams, $params);

        $urlParts['query'] = http_build_query($oParams);

        $url = "{$urlParts['scheme']}://{$urlParts['host']}{$urlParts['path']}?{$urlParts['query']}";

        return $url;
    }

    /**
     * @param $url
     * @return mixed
     * @throws Exception
     */
    public function getOneResourceByUrl($url)
    {
        /** @var mixed[] $response */
        $response = $this->sendRequest('GET', $url);

        /** @var string $resourceName */
        $resourceName = key($response);

        /** @var AbstractEntity $entity */
        $entity = $this->mapResponseToEntityType($resourceName);

        return $entity->deserialize($response[$resourceName]);
    }

    /**
     * @param $url
     * @param AbstractEntityFilter|null $filter
     * @return \mixed[]
     * @throws Exception
     */
    public function GET($url, AbstractEntityFilter $filter = null)
    {
        // @todo $filter params
        return $this->sendRequest('GET', $url);
    }

    /**
     * @param $url
     * @param null $data
     * @param array $headers
     * @return \mixed[]
     * @throws Exception
     */
    public function POST($url, $data = null, array $headers = [])
    {
        /** @var array $origHeaders */
        $origHeaders = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];

        $headers = array_merge($origHeaders, $headers);

        return $this->sendRequest('POST', $url, [
            'headers' => $headers,
            'body' => $data,
        ]);
    }

    /**
     * @param $url
     * @param null $data
     * @param array $headers
     * @return \mixed[]
     * @throws Exception
     */
    public function PUT($url, $data = null, array $headers = [])
    {
        /** @var array $origHeaders */
        $origHeaders = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];

        $headers = array_merge($origHeaders, $headers);

        return $this->sendRequest('PUT', $url, [
            'headers' => $headers,
            'body' => $data,
        ]);
    }

    /**
     * @param $url
     * @return \mixed[]
     * @throws Exception
     */
    public function DELETE($url)
    {
        /** @var mixed[] $response */
        $response = $this->sendRequest('DELETE', $url);

        return $response;
    }

    /**
     * @param $model
     * @return mixed
     */
    protected function entityFactory($model)
    {
        $model->setApi($this);
        return $model;
    }

    /**
     * @param $method
     * @param $url
     * @param array $options
     * @return \mixed[]
     * @throws Exception
     */
    protected function sendRequest($method, $url, $options = [])
    {
        /** @var \Psr\Http\Message\RequestInterface $request */
        $request = $this->getProvider()->getAuthenticatedRequest(
            $method,
            $url,
            $this->getAccessToken(),
            $options
        );

        /** @var mixed[] $response */
        $response = $this->getProvider()->getResponse($request);

        if (is_array($response)) {
            // api entity error encountered
            if (isset($response['errors'])) {
                /** @var string $err */
                $err = "";

                if (isset($response['errors']['error'])) {
                    // ['errors' => ['error' => 'XXXX']]
                    $err = $response['errors']['error']['message'];
                } else {
                    // ['errors' => [['message' => 'XXXX'], ['message' => 'YYYY']]]
                    $err = [];
                    foreach ($response['errors'] as $error) {
                        $err[] = $error['message'];
                    }
                    $err = implode(', ', $err);
                }

                $err = "$err ($url [$method])";

                throw new Exception($err, Exception::API_RESOURCE_ERROR);
            }
        }

        return $response;
    }

    /**
     * @param $name
     * @return mixed
     * @throws Exception
     */
    protected function mapResponseToEntityType($name)
    {
        /** @var string[] $types */
        $types = [
            'bank_account' => 'SixBySix\Freeagent\Entity\BankAccount',
            'bank_transaction' => 'SixBySix\Freeagent\Entity\BankTransaction',
            'bank_transaction_explanation' => 'SixBySix\Freeagent\Entity\BankTransactionExplanation',
            'bill' => 'SixBySix\Freeagent\Entity\Bill',
            'capital_asset' => 'SixBySix\Freeagent\Entity\CapitalAsset',
            'company' => 'SixBySix\Freeagent\Entity\Company',
            'contact' => 'SixBySix\Freeagent\Entity\Contact',
            'project' => 'SixBySix\Freeagent\Entity\Project',
            'user'    => 'SixBySix\Freeagent\Entity\User',
        ];

        if (!isset($types[$name])) {
            throw new Exception(
                sprintf('Unable to map "%s" to any freeagent entity', $name),
                Exception::API_UNKNOWN_MAP_TYPE
            );
        }

        return new $types[$name];
    }
}