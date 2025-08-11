<?php

namespace Bpato\WpChangeTriggerGithub\Services;

abstract class AbstractApi
{
    use SettingsTrait;

    protected const ENDPOINT_URI = '';
    protected const ENDPOINT_METHOD = '';
    protected array $clientOptions = [];

    protected const DEFAULT_HEADERS = 'headers';
    protected const DEFAULT_DATA = 'data';

    protected const HEADERS__ACCEPT = 'Accept';
    protected const HEADERS__AUTH = 'Authorization';
    protected const HEADERS__USER_AGENT = 'User-Agent';

    public function __construct()
    {
        
    }

    public function run()
    {
        try {
            $response = $this->call_api();
            $this->log('Called to ' . $this->getEndpointUri() . ':');
            $this->log($response);
        } catch (\Throwable $th) {
            $this->log($th->getMessage(), true);
        }
    }

    private function getEndpointUri()
    {
        return strtr($this::ENDPOINT_URI, [
            '%OWNER%' => $this->getOwner(),
            '%REPO%' => $this->getRepositoryName(),
            '%WORKFLOW_ID%' => $this->getWorkflowName()
        ]);
    }

    private function call_api()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->getEndpointUri());
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this::ENDPOINT_METHOD); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ( isset($this->clientOptions[self::DEFAULT_HEADERS])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->clientOptions[self::DEFAULT_DATA]));
        }

        $headers = [
            self::HEADERS__AUTH . ': ' . strtr('Bearer %TOKEN%', ['%TOKEN%' => $this->getAccessToken()]),
            self::HEADERS__USER_AGENT . ': WpChangueTriggerGithub/1.0 (https://github.com/bpato/wp-change-trigger-github)' 
        ];

        foreach ($this->clientOptions[self::DEFAULT_HEADERS] as $key => $value) {
            $headers[] = "{$key}: {$value}";
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            throw new \Exception("cURL error: $error_msg");
        }

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return ['http_code' => $http_code, 'response' => $response];
    }

    protected function log($data, $shouldNotDie = false)
    {
        if ( is_array( $data ) || is_object( $data ) ) {
            error_log( print_r( $data, true ) );
        } else {
            error_log( $data );
        }

        if ($shouldNotDie) {
            exit;
        }
    }
}