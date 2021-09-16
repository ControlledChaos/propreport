<?php
/**
 * Form fields for user default editor option
 *
 * @package    Prop_Report
 * @subpackage Views
 * @category   Forms
 * @since      1.0.0
 */

// Alias namespaces.
use PropReport\Classes\Core as Core;

?>
<table class="form-table">
	<tr class="editor-options-user-options">
		<th scope="row"><?php _e( 'Default Editor', 'propreport' ); ?></th>
		<td>
		<?php wp_nonce_field( 'allow-user-settings', 'editor-options-user-settings' ); ?>
		<?php Core\Editor_Options :: editor_settings_default(); ?>
		</td>
	</tr>
</table>
<script>jQuery( 'tr.user-rich-editing-wrap' ).before( jQuery( 'tr.editor-options-user-options' ) );</script>
