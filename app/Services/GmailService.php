<?php

require __DIR__.'/../vendor/autoload.php';
use Google_Client;
use Google_Service_Gmail;

class GmailService
{
    private $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setAuthConfig('credentials.json');
        $this->client->addScope('https://www.googleapis.com/auth/gmail.readonly');
        // You can add other scopes as needed
    }

    public function listMessages($userId = 'me', $maxResults = 100, $pageToken = null, $query = null, $labelIds = [], $includeSpamTrash = false)
    {
        $this->client = getClient();
        $service = new Google_Service_Gmail($this->client);

        $params = [
            'maxResults' => $maxResults,
            'pageToken' => $pageToken,
            'q' => $query,
            'labelIds' => $labelIds,
            'includeSpamTrash' => $includeSpamTrash,
        ];

        return $service->users_messages->listUsersMessages($userId, $params);
    }
}
