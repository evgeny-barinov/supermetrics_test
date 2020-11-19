#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Console\Application;
use Barya\Stats\Command\FetchPostsCommand;
use Barya\Stats\Api\Client;
use Barya\Stats\Api\Credentials;
use Barya\Stats\Api\CachingClient;
use Barya\Stats\Api\PostFetcher;
use Barya\Stats\Storage\MySql\PostStorage;
use Barya\Stats\Metric\MySql;
use Barya\Stats\Metric\SimpleMetricsPool;
use Barya\Stats\Command\ShowStatsCommand;
$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__ . '/.env');

$creds = new Credentials(
    $_ENV['API_CLIENT_ID'],
    $_ENV['API_CLIENT_NAME'],
    $_ENV['API_CLIENT_EMAIL']
);

$dbHost = $_ENV['DB_HOST'];
$dbPort = $_ENV['DB_PORT'];
$dbName = $_ENV['DB_NAME'];
$dbUser = $_ENV['DB_USER'];
$dbPassword = $_ENV['DB_PASSWORD'];

$pdo = new PDO(sprintf('mysql:host=%s;port=%s;dbname=%s', $dbHost, $dbPort, $dbName), $dbUser, $dbPassword);

$metricsPool = new SimpleMetricsPool([
        new MySql\AverageNumberOfPostsPerUserPerMonth($pdo),
        new MySql\AverageCharLengthPerMonth($pdo),
        new MySql\TotalPostsSplitByWeekNumber($pdo),
        new MySql\LongestPostByCharLengthPerMonth($pdo)
]);

$apiClient = new CachingClient(
        new Client($creds),
        new FilesystemAdapter('', 0, __DIR__ . '/runtime/cache')
);

$fetcher = new PostFetcher($apiClient);
$storage = new PostStorage($pdo);

$application = new Application();
$application->add(new FetchPostsCommand($fetcher, $storage));
$application->add(new ShowStatsCommand($metricsPool));

$application->run();
