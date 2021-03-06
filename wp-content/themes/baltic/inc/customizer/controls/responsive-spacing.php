<?php
/**
 * Responsive spacing
 *
 * @package Baltic
 */

namespace Baltic\Customizer\Controls;

class Responsive_Spacing extends \WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'baltic-responsive-spacing';

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $linked_choices = '';

	/**
	 * The unit type.
	 *
	 * @access public
	 * @var array
	 */
	public $unit_choices = [ 'px' => 'px' ];

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		$this->json['default'] = $this->setting->default;
		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		}

		$val = maybe_unserialize( $this->value() );

		if ( ! is_array( $val ) || is_numeric( $val ) ) {

			$val = array(
				'desktop'      => array(
					'top'    => $val,
					'right'  => '',
					'bottom' => $val,
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => $val,
					'right'  => '',
					'bottom' => $val,
					'left'   => '',
				),
				'mobile'       => array(
					'top'    => $val,
					'right'  => '',
					'bottom' => $val,
					'left'   => '',
				),
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);
		}

		/* Control Units */
		$units = [
			'desktop-unit' => 'px',
			'tablet-unit'  => 'px',
			'mobile-unit'  => 'px',
		];

		foreach ( $units as $unit_key => $unit_value ) {
			if ( ! isset( $val[ $unit_key ] ) ) {
				$val[ $unit_key ] = $unit_value;
			}
		}

		$this->json['value']          = $val;
		$this->json['choices']        = $this->choices;
		$this->json['link']           = $this->get_link();
		$this->json['id']             = $this->id;
		$this->json['label']          = esc_html( $this->label );
		$this->json['linked_choices'] = $this->linked_choices;
		$this->json['unit_choices']   = $this->unit_choices;
		$this->json['inputAttrs']     = '';
		foreach ( $this->input_attrs as $attr => $value ) {
			$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
		}
		$this->json['inputAttrs'] = maybe_serialize( $this->input_attrs() );

	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<label class='baltic-responsive-spacing' for="" >

			<# if ( data.label ) { #>
				<span class="customize-control-title">{{{ data.label }}}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# }

			desktop_unit_val = 'px';
			tablet_unit_val  = 'px';
			mobile_unit_val  = 'px';

			if ( data.value['desktop-unit'] ) {
				desktop_unit_val = data.value['desktop-unit'];
			}

			if ( data.value['tablet-unit'] ) {
				tablet_unit_val = data.value['tablet-unit'];
			}

			if ( data.value['mobile-unit'] ) {
				mobile_unit_val = data.value['mobile-unit'];
			} #>


			<div class="baltic-spacing-responsive-outer-wrapper">
			<#
			value_desktop = '';
			value_tablet  = '';
			value_mobile  = '';

			if ( data.value['desktop'] ) {
				value_desktop = data.value['desktop'];
			}

			if ( data.value['tablet'] ) {
				value_tablet = data.value['tablet'];
			}

			if ( data.value['mobile'] ) {
				value_mobile = data.value['mobile'];
			} #>
			<div class="input-wrapper baltic-spacing-responsive-wrapper">

				<ul class="baltic-spacing-wrapper desktop active">

					<# _.each( data.choices, function( choiceLabel, choiceID ) { #>
					<li {{{ data.inputAttrs }}} class='baltic-spacing-input-item'>
						<input type='number' class='baltic-spacing-input baltic-spacing-desktop' data-id= '{{ choiceID }}' value='{{ value_desktop[ choiceID ] }}'>
						<span class="baltic-spacing-title">{{{ data.choices[ choiceID ] }}}</span>
					</li>
					<# }); #>

					<# if ( data.linked_choices ) { #>
					<li class="baltic-spacing-input-item-link">
						<span class="dashicons dashicons-admin-links baltic-spacing-connected wp-ui-highlight" data-element-connect="{{ data.id }}" title="{{ data.title }}"></span>
						<span class="dashicons dashicons-editor-unlink baltic-spacing-disconnected" data-element-connect="{{ data.id }}" title="{{ data.title }}"></span>
					</li>
					<# } #>

					<li>
						<ul class="baltic-spacing-responsive-units baltic-spacing-desktop-responsive-units">
							<#_.each( data.unit_choices, function( unit_key ) {
								unit_class = '';
								if ( desktop_unit_val === unit_key ) {
									unit_class = 'active';
								}
							#><li class='single-unit {{ unit_class }}' data-unit='{{ unit_key }}' >
								<span class="unit-text">{{{ unit_key }}}</span>
							</li><#
							});#>
						</ul>
					</li>

				</ul>

				<ul class="baltic-spacing-wrapper tablet">

					<# _.each( data.choices, function( choiceLabel, choiceID ) { #>
					<li {{{ data.inputAttrs }}} class='baltic-spacing-input-item'>
						<input type='number' class='baltic-spacing-input baltic-spacing-tablet' data-id='{{ choiceID }}' value='{{ value_tablet[ choiceID ] }}'>
						<span class="baltic-spacing-title">{{{ data.choices[ choiceID ] }}}</span>
					</li>
					<# }); #>

					<# if ( data.linked_choices ) { #>
					<li class="baltic-spacing-input-item-link">
						<span class="dashicons dashicons-admin-links baltic-spacing-connected wp-ui-highlight" data-element-connect="{{ data.id }}" title="{{ data.title }}"></span>
						<span class="dashicons dashicons-editor-unlink baltic-spacing-disconnected" data-element-connect="{{ data.id }}" title="{{ data.title }}"></span>
					</li>
					<# } #>

					<li>
						<ul class="baltic-spacing-responsive-units baltic-spacing-tablet-responsive-units">
							<#_.each( data.unit_choices, function( unit_key ) {
								unit_class = '';
								if ( tablet_unit_val === unit_key ) {
									unit_class = 'active';
								}
							#><li class='single-unit {{ unit_class }}' data-unit='{{ unit_key }}' >
								<span class="unit-text">{{{ unit_key }}}</span>
							</li><#
							});#>
						</ul>
					</li>

				</ul>

				<ul class="baltic-spacing-wrapper mobile">

					<# _.each( data.choices, function( choiceLabel, choiceID ) { #>
					<li {{{ data.inputAttrs }}} class='baltic-spacing-input-item'>
						<input type='number' class='baltic-spacing-input baltic-spacing-mobile' data-id='{{ choiceID }}' value='{{ value_mobile[ choiceID ] }}'>
						<span class="baltic-spacing-title">{{{ data.choices[ choiceID ] }}}</span>
					</li>
					<# }); #>

					<# if ( data.linked_choices ) { #>
					<li class="baltic-spacing-input-item-link">
						<span class="dashicons dashicons-admin-links baltic-spacing-connected wp-ui-highlight" data-element-connect="{{ data.id }}" title="{{ data.title }}"></span>
						<span class="dashicons dashicons-editor-unlink baltic-spacing-disconnected" data-element-connect="{{ data.id }}" title="{{ data.title }}"></span>
					</li>
					<# } #>

					<li>
						<ul class="baltic-spacing-responsive-units baltic-spacing-mobile-responsive-units">
							<#_.each( data.unit_choices, function( unit_key ) {
								unit_class = '';
								if ( mobile_unit_val === unit_key ) {
									unit_class = 'active';
								}
							#><li class='single-unit {{ unit_class }}' data-unit='{{ unit_key }}' >
								<span class="unit-text">{{{ unit_key }}}</span>
							</li><#
							});#>
						</ul>
					</li>

				</ul>
			</div>

			<div class="baltic-spacing-responsive-units-screen-wrap">
				<div class="unit-input-wrapper baltic-spacing-unit-wrapper">
					<input type='hidden' class='baltic-spacing-unit-input baltic-spacing-desktop-unit' data-device='desktop' value='{{desktop_unit_val}}'>
					<input type='hidden' class='baltic-spacing-unit-input baltic-spacing-tablet-unit' data-device='tablet' value='{{tablet_unit_val}}'>
					<input type='hidden' class='baltic-spacing-unit-input baltic-spacing-mobile-unit' data-device='mobile' value='{{mobile_unit_val}}'>
				</div>
				<ul class="baltic-spacing-responsive-buttons">
					<li class="desktop active">
						<button type="button" class="preview-desktop active" data-device="desktop">
							<i class="dashicons dashicons-desktop"></i>
						</button>
					</li>
					<li class="tablet">
						<button type="button" class="preview-tablet" data-device="tablet">
							<i class="dashicons dashicons-tablet"></i>
						</button>
					</li>
					<li class="mobile">
						<button type="button" class="preview-mobile" data-device="mobile">
							<i class="dashicons dashicons-smartphone"></i>
						</button>
					</li>
				</ul>
			</div>

			</div>
		</label>

		<?php
	}

	/**
	 * Render the control's content.
	 *
	 * @see WP_Customize_Control::render_content()
	 */
	protected function render_content() {}
}
