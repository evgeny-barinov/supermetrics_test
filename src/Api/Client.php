<?php
declare(strict_types=1);

namespace Barya\Stats\Api;

use Barya\Stats\Api\Models\PostResponse;
use Barya\Stats\Api\Models\RegisterResponse;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class Client {

    private const BASE_URI = 'https://api.supermetrics.com/assignment/';

    private HttpClientInterface $client;

    private Credentials $creds;

    private string $slToken;

    public function __construct(Credentials $creds, ?HttpClientInterface $client = null) {
        $this->creds = $creds;

        if ($client === null) {
            $this->client = HttpClient::create([
                'base_uri' => self::BASE_URI,
                'headers' => [
                    'User-Agent' => 'Test PHP Client',
                ]
            ]);
        }
    }

    public function register(): RegisterResponse {
        $response =  $this->client->request('POST', 'register', [
            'json' => [
                'client_id' => $this->creds->getClientId(),
                'name' => $this->creds->getName(),
                'email' => $this->creds->getEmail()
            ]
        ]);
        $response  = new RegisterResponse($response->toArray());
        $this->setToken($response);

        return $response;
    }

    public function getPosts(int $page = 1): PostResponse {
        $response = $this->request('GET', 'posts', [
           'query' => [
               'page' => $page
           ]
        ]);
        return new PostResponse($response->toArray());
    }

    public function setToken(RegisterResponse $response): void {
        $this->slToken = $response->getData()->getSlToken();
    }

    public function getToken(): string {
        return $this->slToken;
    }

    public function request(string $method, string $url, array $options): ResponseInterface {
        $this->ensureTokenIsSet();
        $options['query'] = array_merge($options['query'], [
            'sl_token' => $this->slToken
        ]);

        return $this->client->request($method, $url, $options);
    }

    private function ensureTokenIsSet(): void {
        if ($this->slToken === null) {
            throw new \RuntimeException('Register the client before making a requests');
        }
    }
}
