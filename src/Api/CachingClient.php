<?php
declare(strict_types=1);

namespace Barya\Stats\Api;


use Barya\Stats\Api\Models\PostResponse;
use Barya\Stats\Api\Models\RegisterResponse;
use Symfony\Component\HttpClient\Exception\ServerException;
use Symfony\Contracts\Cache\CacheInterface;

final class CachingClient
{
    private const TOKEN_CACHE_ID = 'API_SL_TOKEN';

    private const MAX_ATTEMPTS = 5;

    private CacheInterface $cache;

    private Client $client;

    public function __construct(Client $client, CacheInterface $cache) {
        $this->client = $client;
        $this->cache = $cache;
    }

    public function register(): RegisterResponse {
        /** @var RegisterResponse $response */
        $response = $this->cache->get(self::TOKEN_CACHE_ID, function () {
            return $this->client->register();
        });
        $this->setToken($response);

        return $response;
    }

    public function getPosts($page = 1): PostResponse {
        return $this->request(function () use ($page) {
            return $this->client->getPosts($page);
        });
    }

    public function getToken() {
        return $this->client->getToken();
    }

    public function setToken(RegisterResponse $response): void {
        $this->client->setToken($response);
    }

    /**
     * @return mixed
     */
    private function request(callable $request) {
        $attempts = 0;
        do {
            try {
                $attempts++;
                return $request();
            } catch (ServerException $e) {
                $this->cache->delete(self::TOKEN_CACHE_ID);
                $this->register();
            } catch (\Throwable $e) {
                throw $e;
            }

            if ($attempts >= self::MAX_ATTEMPTS) {
                throw new \RuntimeException(sprintf('Max attempts achieved: %s', self::MAX_ATTEMPTS));
            }
        } while (true);
    }

}
