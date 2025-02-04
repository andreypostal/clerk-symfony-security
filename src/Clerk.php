<?php

namespace Andrey\Clerk;

use Andrey\Clerk\Value\Membership;
use Andrey\Clerk\Value\User;
use Andrey\JsonHandler\JsonHydrator;
use JsonException;
use ReflectionException;
use RuntimeException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Clerk implements ClerkInterface
{
    private const string GetUserEndpoint = '/v1/users/%s';
    private const string GetMembershipsEndpoint = '/v1/users/%s/organization_memberships';

    public function __construct(
        private HttpClientInterface $client,
        ?string $serverUri = null,
        ?string $secret = null,
    ) {
        if ($serverUri !== null) {
            $this->client = $this->withServer($serverUri)->client;
        }

        if ($secret !== null) {
            $this->client = $this->withSecret($secret)->client;
        }
    }

    public function withServer(string $serverUri): static
    {
        return new self($this->client->withOptions(['base_uri' => $serverUri]));
    }

    public function withSecret(string $secret): static
    {
        return new self($this->client->withOptions([
            'headers' => [
                'Authorization' => "Bearer {$secret}",
            ],
        ]));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws JsonException
     * @throws ReflectionException
     */
    public function getUser(string $userId): User
    {
        $response = $this->client->request('GET', sprintf(self::GetUserEndpoint, $userId));
        $userObject = $response->toArray();

        $hydrator = new JsonHydrator();
        /** @var User $user */
        $user = $hydrator->hydrate($userObject, User::class);
        return $user;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws JsonException
     * @throws RedirectionExceptionInterface
     * @throws ReflectionException
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getMembership(string $userId, string $orgId): Membership
    {
        $response = $this->client->request('GET', sprintf(self::GetMembershipsEndpoint, $userId));
        $membershipsArray = $response->toArray();

        $hydrator = new JsonHydrator();

        foreach ($membershipsArray['data'] ?? [] as $membershipArray) {
            /** @var Membership $membership */
            $membership = $hydrator->hydrate($membershipArray, Membership::class);

            if ($membership->organization->id === $orgId) {
                return $membership;
            }
        }

        throw new RuntimeException('unexpected error: missing membership');
    }
}
