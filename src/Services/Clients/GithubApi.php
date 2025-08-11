<?php

namespace Bpato\WpChangeTriggerGithub\Services\Clients;

use Bpato\WpChangeTriggerGithub\Services\AbstractApi;

final class GithubApi extends AbstractApi 
{
    protected const ENDPOINT_METHOD = 'POST';
    protected const ENDPOINT_URI = 'https://api.github.com/repos/%OWNER%/%REPO%/actions/workflows/%WORKFLOW_ID%/dispatches';

    protected const HEADERS__API_VERSION = 'X-GitHub-Api-Version';

    protected array $clientOptions = [
        self::DEFAULT_HEADERS => [
            self::HEADERS__ACCEPT      => "application/vnd.github+json",
            self::HEADERS__API_VERSION => "2022-11-28",
        ],
        self::DEFAULT_DATA => [
            "ref" => "master"
        ]
    ];
}
