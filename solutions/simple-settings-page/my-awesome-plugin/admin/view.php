<?php

/**
 * Check user capabilities.
 */
if ( ! current_user_can( 'manage_options' ) ) {
	return;
}

/**
 * WordPress will add the "settings-updated" $_GET parameter to the URL.
 */
if ( isset( $_GET[ 'settings-updated' ] ) ) {

	add_settings_error(
        'my-awesome-plugin',
        'success',
        __( 'Settings Saved', 'my-awesome-plugin' ),
        'updated'
    );
}

/**
 * Show error and update messages.
 */
settings_errors( 'my-awesome-plugin' );
?>
	<div class="wrap">

		<h1><?= esc_html( get_admin_page_title() ); ?></h1>

		<form action="options.php" method="post">

            <?php
			// Outputs nonce, action, and option_page fields for a settings page.
			settings_fields( 'my-awesome-plugin' );

			// Outputs setting sections and their fields.
            do_settings_sections( 'my-awesome-plugin' );

			// Outputs save settings button.
			submit_button( 'Save Settings' );
            ?>

		</form>
	</div>

<?php
