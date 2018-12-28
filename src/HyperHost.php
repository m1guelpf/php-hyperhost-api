<?php

namespace M1guelpf\HyperHostAPI;

use GuzzleHttp\Client;

class HyperHost
{
    /** @var \GuzzleHttp\Client */
    protected $client;

    /** @var string */
    protected $apiVersion;

    /**
     * @param \GuzzleHttp\Client $client
     * @param string             $apiToken
     */
    public function __construct($apiToken = null)
    {
        $this->client = new Client();

        $this->apiToken = $apiToken;

        $this->baseUrl = 'https://hyper.host/api';
    }

    /**
     * @param string $apiToken
     *
     * @return string
     */
    public function connect($apiToken)
    {
        $this->apiToken = $apiToken;

        return $this;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param \GuzzleHttp\Client $client
     *
     * @return void
     */
    public function setClient($client)
    {
        if ($client instanceof Client) {
            $this->client = $client;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getTeams()
    {
        return $this->get('team');
    }
  
    /**
     * @param int $teamId
     *
     * @return array
     */
    public function getTeam(int $teamId)
    {
        return $this->get("team/$teamId");
    }

    /**
     * @param string $name
     * @param string $slug
     *
     * @return array
     */
    public function createTeam(string $name, string $slug)
    {
        return $this->post('team', compact('name', 'slug'));
    }

    /**
     * @param int $teamId
     * @param string $slug
     *
     * @return array
     */
    public function inviteTeamMember(int $teamId, string $email)
    {
        return $this->post("team/$teamId/invitations", compact('email'));
    }

    /**
     * @return array
     */
    public function getPackages()
    {
        return $this->get('site');
    }

    /**
     * @param int  $packageId
     *
     * @return array
     */
    public function getSSOLink(int $packageId)
    {
        return $this->get("sso/$slug");
    }

    /**
     * @param string  $domain
     * @param string  $platform
     * @param string  $teamId
     *
     * @return array
     */
    public function createPackage(string $domain, int $platform, int $teamId)
    {
        return $this->post('site', [
          'domain' => $domain,
          'platform' => $platform,
          'team_id' => $teamId,
        ]);
    }
  
    /**
     * @param string  $host
     * @param string  $user
     * @param string  $password
     * @param string  $domain
     *
     * @return array
     */
    public function startMigration(string $host, string $user, string $password, string $domain)
    {
        return $this->post('migrate/test', [
          'source_hostname' => $host,
          'source_username' => $user,
          'source_password' => $password,
          'source_domain' => $domain,
        ]);
    }

    /**
     * @param string $resource
     * @param array  $query
     *
     * @return array
     */
    public function get($resource, array $query = [])
    {
      return $this->handleCall("GET", $resource, $query, []);
    }

    /**
     * @param string $resource
     * @param array  $rawdata
     *
     * @return array
     */
    public function post($resource, array $rawData = [])
    {
      return $this->handleCall("POST", $resource, [], $rawData);
    }

    /**
     * @param string $resource
     * @param array  $rawdata
     *
     * @return array
     */
    public function put($resource, array $rawData = [])
    {
        return $this->handleCall("PUT", $resource, [], $rawData);
    }

    /**
     * @param string $resource
     * @param array  $rawdata
     *
     * @return array
     */
    public function delete($resource, array $rawData = [])
    {
        return $this->handleCall("DELETE", $resource, [], $rawData);
    }

    /**
    * @param string $method HTTP method
    * @param string $resource Resource to invoke at the HyperHost API
    * @param array  $query Request query string to pass in the URL
    * @param array  $rawData Request body
    *
    * @return array
    */
    protected function handleCall($method, $resource, array $query, array $rawData)
    {
      $data['headers'] = [
        'User-Agent' => 'php-hyperhost-api'
      ];

      if (! empty($query)) {
        $data['query'] = array_unique(array_merge($query, ['api_token' => $this->apiToken]), SORT_REGULAR);
      } else {
        $data['query'] = ['api_token' => $this->apiToken];
      }

      if (! empty($rawData)) {
        $data['json'] = $rawData;
      }

      $results = $this->client
      ->request($method, "{$this->baseUrl}/{$resource}", $data)
      ->getBody()
      ->getContents();

      return json_decode($results, true);
    }
}
