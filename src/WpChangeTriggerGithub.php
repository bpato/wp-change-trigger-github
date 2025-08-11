<?php

namespace Bpato\WpChangeTriggerGithub;

use Bpato\WpChangeTriggerGithub\Admin\Settings;
use Bpato\WpChangeTriggerGithub\Services\Clients\GithubApi;

class WpChangeTriggerGithub
{
    private static $me;

    const HOOK_ON_SAVE_OR_UPDATE = 'wp_after_insert_post';
    const HOOK_ON_CHANGE_STATUS = 'transition_post_status';

    const TRANSIENT_KEY = 'github_action_trigger_lock';

    public function __construct()
    {
        if ( is_admin() ) {
            $wp_change_trigger_github_settings = new Settings();
        }

        //add_action(self::HOOK_ON_SAVE_OR_UPDATE, [WpChangeTriggerGithub::class, 'execute_process_on_save_or_update'], 10, 1);
        add_action(self::HOOK_ON_CHANGE_STATUS, [WpChangeTriggerGithub::class, 'execute_process_on_changue_status'], 10, 1);
    }
    
    public static function get_instance(): self 
    {
        if (!self::$me) {
            self::$me = new self();
        }
        return self::$me;
    }


    public static function init(): void
    {
        self::get_instance();
    }

    public static function execute_process_on_changue_status(string $new_status)
    {
        error_log("transition_post_status llamado para {$new_status}");

        self::execute_process();
    }

    public static function execute_process_on_save_or_update(int $post_id)
    {
        error_log("wp_after_insert_post llamado para post {$post_id}");

        if ( wp_is_post_revision( (int) $post_id ) || wp_is_post_autosave( (int) $post_id ) ) return;
        if ( get_post_status( (int) $post_id ) !== 'publish' ) return;

        self::execute_process();
    }

    public static function execute_process()
    {
        if ( false === get_transient( self::TRANSIENT_KEY ) ) {

            $api = new GithubApi();
            $api->run();

            set_transient( self::TRANSIENT_KEY, 'locked', 5 );

        } else {
            error_log('GitHub workflow trigger temporary blocked by transient');
        }
    }
}




