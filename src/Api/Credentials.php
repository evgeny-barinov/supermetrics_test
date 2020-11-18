<?php
declare(strict_types=1);

namespace Barya\Stats\Api;


class Credentials
{
    private string $clientId;

    private string $name;

    private string $email;

    public function __construct(string $clientId, string $name, string $email) {
        $this->clientId = $clientId;
        $this->name = $name;
        $this->email = $email;
    }

    public function getClientId(): string {
        return $this->clientId;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }
}
