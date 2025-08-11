<?php

namespace Bpato\WpChangeTriggerGithub\Admin;


class Settings {

	private $wp_change_trigger_github_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'wp_change_trigger_github_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'wp_change_trigger_github_page_init' ) );
	}

	public function wp_change_trigger_github_add_plugin_page() {
		add_management_page(
			'Wp Change Trigger Github', // page_title
			'Wp Change Trigger Github', // menu_title
			'manage_options', // capability
			'wp-change-trigger-github', // menu_slug
			array( $this, 'wp_change_trigger_github_create_admin_page' ) // function
		);
	}

	public function wp_change_trigger_github_create_admin_page() {
		$this->wp_change_trigger_github_options = get_option( 'wp_change_trigger_github_option_name' ); ?>

		<div class="wrap">
			<h2><?php echo __('Wp Change Trigger Github Settings','changuetriggergithub') ?></h2>
			<p><?php echo __('A WordPress plugin that fires GitHub Actions automatically when content is created or updated, and can also be triggered manually from the WordPress admin panel.','changuetriggergithub') ?></p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'wp_change_trigger_github_option_group' );
					do_settings_sections( 'wp-change-trigger-github-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function wp_change_trigger_github_page_init() {
		register_setting(
			'wp_change_trigger_github_option_group', // option_group
			'wp_change_trigger_github_option_name', // option_name
			array( $this, 'wp_change_trigger_github_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'wp_change_trigger_github_setting_section', // id
			'Settings', // title
			array( $this, 'wp_change_trigger_github_section_info' ), // callback
			'wp-change-trigger-github-admin' // page
		);

		add_settings_field(
			'repository_owner_0', // id
			'Repository Owner', // title
			array( $this, 'repository_owner_0_callback' ), // callback
			'wp-change-trigger-github-admin', // page
			'wp_change_trigger_github_setting_section' // section
		);

		add_settings_field(
			'repository_name_1', // id
			'Repository Name', // title
			array( $this, 'repository_name_1_callback' ), // callback
			'wp-change-trigger-github-admin', // page
			'wp_change_trigger_github_setting_section' // section
		);

		add_settings_field(
			'repository_workflow_name_2', // id
			'Repository Workflow Name', // title
			array( $this, 'repository_workflow_name_2_callback' ), // callback
			'wp-change-trigger-github-admin', // page
			'wp_change_trigger_github_setting_section' // section
		);

		add_settings_field(
			'personal_access_token_classic_3', // id
			'Personal Access Token (Classic)', // title
			array( $this, 'personal_access_token_classic_3_callback' ), // callback
			'wp-change-trigger-github-admin', // page
			'wp_change_trigger_github_setting_section' // section
		);
	}

	public function wp_change_trigger_github_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['repository_owner_0'] ) ) {
			$sanitary_values['repository_owner_0'] = sanitize_text_field( $input['repository_owner_0'] );
		}

		if ( isset( $input['repository_name_1'] ) ) {
			$sanitary_values['repository_name_1'] = sanitize_text_field( $input['repository_name_1'] );
		}

		if ( isset( $input['repository_workflow_name_2'] ) ) {
			$sanitary_values['repository_workflow_name_2'] = sanitize_text_field( $input['repository_workflow_name_2'] );
		}

		if ( isset( $input['personal_access_token_classic_3'] ) ) {
			$sanitary_values['personal_access_token_classic_3'] = sanitize_text_field( $input['personal_access_token_classic_3'] );
		}

		return $sanitary_values;
	}

	public function wp_change_trigger_github_section_info() {
		
	}

	public function repository_owner_0_callback() {
		printf(
			'<input class="regular-text" type="text" name="wp_change_trigger_github_option_name[repository_owner_0]" id="repository_owner_0" value="%s">',
			isset( $this->wp_change_trigger_github_options['repository_owner_0'] ) ? esc_attr( $this->wp_change_trigger_github_options['repository_owner_0']) : ''
		);
	}

	public function repository_name_1_callback() {
		printf(
			'<input class="regular-text" type="text" name="wp_change_trigger_github_option_name[repository_name_1]" id="repository_name_1" value="%s">',
			isset( $this->wp_change_trigger_github_options['repository_name_1'] ) ? esc_attr( $this->wp_change_trigger_github_options['repository_name_1']) : ''
		);
	}

	public function repository_workflow_name_2_callback() {
		printf(
			'<input class="regular-text" type="text" name="wp_change_trigger_github_option_name[repository_workflow_name_2]" id="repository_workflow_name_2" value="%s">',
			isset( $this->wp_change_trigger_github_options['repository_workflow_name_2'] ) ? esc_attr( $this->wp_change_trigger_github_options['repository_workflow_name_2']) : ''
		);
	}

	public function personal_access_token_classic_3_callback() {
		printf(
			'<input class="regular-text" type="text" name="wp_change_trigger_github_option_name[personal_access_token_classic_3]" id="personal_access_token_classic_3" value="%s">',
			isset( $this->wp_change_trigger_github_options['personal_access_token_classic_3'] ) ? esc_attr( $this->wp_change_trigger_github_options['personal_access_token_classic_3']) : ''
		);
	}

}
