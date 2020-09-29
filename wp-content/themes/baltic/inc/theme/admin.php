<?php
/**
 * Admin
 *
 * @package Baltic
 */

namespace Baltic;

class Admin {

	use Instance;

	public function __construct() {

		//add_action( 'admin_menu', 	[ $this, 'admin_menu' ] );

		add_action( 'admin_menu', 	[ $this, 'add_metabox' ] );
		add_action( 'save_post', 	[ $this, 'metabox_save' ], 1, 2 );

	}

	public function admin_menu() {

		add_theme_page(
			esc_html__( 'Baltic', 'baltic' ),
			esc_html__( 'Baltic', 'baltic' ),
			'edit_theme_options',
			'about-' . BALTIC_DOMAIN,
			[ $this, 'admin_about' ]
		);

	}

	public function admin_about() {}

	public function add_metabox() {

		$types = [ 'post', 'page', 'product' ];

		foreach ( $types as $type ) {
			add_meta_box( 'baltic_metabox',
				esc_html__( 'Meta Settings', 'baltic' ),
				[ $this, 'metabox_view' ],
				$type,
				'side',
				'default'
			);
		}

	}

	public function metabox_view() {

		wp_nonce_field( 'baltic_save_metabox', 'baltic_metabox_nonce' );

		$layout = Options::get_custom_field( '_layout' );
		$breadcrumb = Options::get_custom_field( '_breadcrumb' );

		?>
		<table class="form-table">
			<tbody>

				<tr valign="top">
					<th scope="row"><label for="baltic-layout"><?php esc_html_e( 'Layout', 'baltic' );?></label></th>
					<td>
						<select name="baltic[_layout]" id="baltic-layout">
							<option value=""<?php selected( $layout, '' ); ?>><?php esc_html_e( 'Default', 'baltic' ); ?></option>
							<option value="content-sidebar"<?php selected( $layout, 'content-sidebar' ); ?>><?php esc_html_e( 'Content Sidebar', 'baltic' ); ?></option>
							<option value="sidebar-content"<?php selected( $layout, 'sidebar-content' ); ?>><?php esc_html_e( 'Sidebar Content', 'baltic' ); ?></option>
							<option value="full-width"<?php selected( $layout, 'full-width' ); ?>><?php esc_html_e( 'Full Width', 'baltic' ); ?></option>
							<option value="narrow"<?php selected( $layout, 'narrow' ); ?>><?php esc_html_e( 'Narrow', 'baltic' ); ?></option>
						</select>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="baltic-breadcrumb"><?php esc_html_e( 'Breadcrumb', 'baltic' );?></label></th>
					<td>
						<select name="baltic[_breadcrumb]" id="baltic-breadcrumb">
							<option value=""<?php selected( $breadcrumb, '' ); ?>><?php esc_html_e( 'Default', 'baltic' ); ?></option>
							<option value="hide"<?php selected( $breadcrumb, 'hide' ); ?>><?php esc_html_e( 'Hide', 'baltic' ); ?></option>
							<option value="show"<?php selected( $breadcrumb, 'show' ); ?>><?php esc_html_e( 'Show', 'baltic' ); ?></option>
						</select>
					</td>
				</tr>

			</tbody>
		</table>
		<?php
	}

	public function metabox_save( $post_id, $post ) {

		if ( isset( $_POST['baltic'] ) ) {
			$baltic = array_map( 'sanitize_text_field', wp_unslash( $_POST['baltic'] ) );
			$data = wp_parse_args(
				$baltic,
				array(
					'_layout' 		=> '',
					'_breadcrumb'	=> ''
				)
			);

			$this->save_custom_field( $data, 'baltic_save_metabox', 'baltic_metabox_nonce', $post );
		}

	}

	public function save_custom_field( array $data, $nonce_action, $nonce_name, $post ) {

		// Verify the nonce.
		if ( isset( $_POST[ $nonce_name ] ) && wp_verify_nonce( sanitize_key( $_POST[ $nonce_name ] ), $nonce_action ) ) {

			// Don't try to save the data under autosave, ajax, or future post.
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
			if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
				return;
			}
			if ( defined( 'DOING_CRON' ) && DOING_CRON ) {
				return;
			}

			// Grab the post object.
			if ( null !== $deprecated ) {
				$post = get_post( $deprecated );
			} else {
				$post = get_post( $post );
			}

			// Don't save if WP is creating a revision (same as DOING_AUTOSAVE?).
			if ( 'revision' === get_post_type( $post ) ) {
				return;
			}

			// Check that the user is allowed to edit the post.
			if ( ! current_user_can( 'edit_post', $post->ID ) ) {
				return;
			}

			// Cycle through $data, insert value or delete field.
			foreach ( (array) $data as $field => $value ) {
				// Save $value, or delete if the $value is empty.
				if ( $value ) {
					update_post_meta( $post->ID, $field, $value );
				} else {
					delete_post_meta( $post->ID, $field );
				}
			}

		}

	}

}
