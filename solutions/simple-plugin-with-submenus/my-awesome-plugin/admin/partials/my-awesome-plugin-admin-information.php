<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://dorokhov.dev
 * @since      1.0.0
 *
 * @package    My_Awesome_Plugin
 * @subpackage My_Awesome_Plugin/admin/partials
 */
?>

<?php

/**
 * Check user capabilities.
 */
if ( ! current_user_can( 'manage_options' ) ) {
	return;
}

?>
    <div class="wrap">

        <h1><?= esc_html( get_admin_page_title() ); ?></h1>

        <p>This is an information page.</p>
    </div>

<?php