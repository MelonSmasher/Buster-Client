<?php
/**
 * Created by PhpStorm.
 * User: melon
 * Date: 2/6/18
 * Time: 11:30 PM
 */

use GuzzleHttp\Client as HttpClient;

class Client
{

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * @var string
     */
    protected $url = '';

    /**
     * BusterClient constructor.
     * @param string $key
     * @param string $host
     * @param int $port
     * @param bool $useHttps
     */
    public function __construct($key, $host, $port = 80, $useHttps = false)
    {
        $this->url = implode('', [($useHttps) ? 'https' : 'http', '://', $host, ':', strval($port), '/api/bust']);
        $this->headers = ['x-authorization' => $key, 'Accept' => '*/*', 'Cache-Control' => 'no-cache'];
        $this->httpClient = new HttpClient();
    }

    /**
     * @param $pathToPurge
     * @param $schemeId
     * @param string $clientUserName
     * @return \GuzzleHttp\Message\Response
     */
    public function bust($pathToPurge, $schemeId, $clientUserName = '')
    {
        $response = $this->httpClient->request(
            'POST',
            $this->url,
            [
                'debug' => false,
                'http_errors' => false,
                'headers' => $this->headers,
                'form_params' => [
                    'path' => $pathToPurge,
                    'scheme_id' => $schemeId,
                    'client_username' => $clientUserName
                ]
            ]
        );

        return $response;
    }

}