<?php
/**
 * Select
 *
 * @package Baltic
 */

namespace Baltic\Customizer\Controls;

class Select extends \WP_Customize_Control {

	/**
	 * The type of control being rendered
	 */
	public $type = 'baltic-select';

	public $multiple = 1;

	public function to_json() {
		parent::to_json();
		$this->json['multiple'] = $this->multiple;
		$this->json['value'] = $this->value();
		$this->json['choices'] = $this->choices;
		$this->json['link'] = $this->get_link();


		$this->json['inputAttrs'] = '';
		foreach ( $this->input_attrs as $attr => $value ) {
			$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
		}
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
		<#
		data = _.defaults( data, {
			label: '',
			description: '',
			inputAttrs: '',
			'data-id': '',
			choices: {},
			multiple: 1,
			value: ( 1 < data.multiple ) ? [] : '',
			placeholder: false
		} );

		if ( 1 < data.multiple && data.value && _.isString( data.value ) ) {
			data.value = [ data.value ];
		}
		if ( data.label ) { #>
			<span class="customize-control-title">{{{ data.label }}}</span>
		<# } #>
		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>
		<div class="customize-control-content">
			<label><span class="screen-reader-text">{{{ data.label }}}</span>
			<select
				data-id="{{ data['data-id'] }}"
				{{{ data.inputAttrs }}}
				<# if ( 1 < data.multiple ) { #>
					data-multiple="{{ data.multiple }}" multiple="multiple"
				<# } #>
				>
				<# if ( data.placeholder ) { #>
					<option value=""<# if ( '' === data.value ) { #> selected<# } #>></option>
				<# } #>
				<# _.each( data.choices, function( optionLabel, optionKey ) { #>
					<#
					selected = ( data.value === optionKey );
					if ( 1 < data.multiple && data.value ) {
						selected = _.contains( data.value, optionKey );
					}
					if ( _.isObject( optionLabel ) ) {
						#>
						<optgroup label="{{ optionLabel[0] }}">
							<# _.each( optionLabel[1], function( optgroupOptionLabel, optgroupOptionKey ) { #>
								<#
								selected = ( data.value === optgroupOptionKey );
								if ( 1 < data.multiple && data.value ) {
									selected = _.contains( data.value, optgroupOptionKey );
								}
								#>
								<option value="{{ optgroupOptionKey }}"<# if ( selected ) { #> selected<# } #>>{{{ optgroupOptionLabel }}}</option>
							<# } ); #>
						</optgroup>
					<# } else { #>
						<option value="{{ optionKey }}"<# if ( selected ) { #> selected<# } #>>{{{ optionLabel }}}</option>
					<# } #>
				<# } ); #>
			</select>
			</label>
		</div>
		<?php
	}

}
