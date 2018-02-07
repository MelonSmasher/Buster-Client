<?php
/**
 * Created by PhpStorm.
 * User: melon
 * Date: 2/6/18
 * Time: 11:30 PM
 */

namespace Buster;

class Client
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * BusterClient constructor.
     * @param string $key
     * @param string $host
     * @param int $port
     * @param bool $useHttps
     */
    public function __construct($key, $host, $port = 80, $useHttps = false)
    {
        $url = implode('', [($useHttps) ? 'https' : 'http', '://', $host, ':', strval($port), '/api/']);
        $headers = ['x-authorization' => $key, 'Accept' => '*/json', 'Cache-Control' => 'no-cache'];
        $this->httpClient = new \GuzzleHttp\Client([
            'base_uri' => $url,
            'debug' => false,
            'http_errors' => false,
            'headers' => $headers
        ]);
    }

    /**
     * @param $pathToPurge
     * @param $schemeId
     * @param string $clientUserName
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function bust($pathToPurge, $schemeId, $clientUserName = '')
    {
        $response = $this->httpClient->request(
            'POST',
            'bust',
            [
                'form_params' => [
                    'path' => $pathToPurge,
                    'scheme_id' => $schemeId,
                    'client_username' => $clientUserName
                ]
            ]
        );
        return $response;
    }

    /**
     * @param int $schemeId
     * @param int $page
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function history($schemeId, $page = 1)
    {
        $response = $this->httpClient->request(
            'GET',
            implode(['history/', strval($schemeId), '?page=', strval($page)])
        );
        return $response;
    }
}