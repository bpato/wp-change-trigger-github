<?php

namespace Bpato\WpChangeTriggerGithub\Services;

trait SettingsTrait
{
    protected function getOwner(): string
    {
        $wp_change_trigger_github_options = get_option( 'wp_change_trigger_github_option_name', [] );
        
        return $wp_change_trigger_github_options['repository_owner_0'] ?? '';
    }

    protected function getRepositoryName(): string
    {
        $wp_change_trigger_github_options = get_option( 'wp_change_trigger_github_option_name', [] );
        
        return $wp_change_trigger_github_options['repository_name_1'] ?? '';
    }

    protected function getWorkflowName(): string
    {
        $wp_change_trigger_github_options = get_option( 'wp_change_trigger_github_option_name', [] );
        
        return $wp_change_trigger_github_options['repository_workflow_name_2'] ?? '';
    }

    // Personal Access Token (Classic)
    protected function getAccessToken(): string
    {
        $wp_change_trigger_github_options = get_option( 'wp_change_trigger_github_option_name', [] );
        
        return $wp_change_trigger_github_options['personal_access_token_classic_3'] ?? '';
    }
}