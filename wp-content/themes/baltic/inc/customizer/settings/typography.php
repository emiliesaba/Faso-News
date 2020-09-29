<?php
/**
 * Typography settings
 *
 * @package Baltic
 */

namespace Baltic\Customizer\Settings;

use Baltic\Instance;
use Baltic\Options;
use Baltic\Webfonts;
use Baltic\Sanitize;
use Baltic\Utils;
use Baltic\Customizer\Controls;

class Typography {

	use Instance,
		Sanitize,
		Utils;

	public $default;

	public function __construct() {

		$this->default = Options::defaults();

		add_action( 'customize_register', [ $this, 'body_font' ] );
		add_action( 'customize_register', [ $this, 'heading_font' ] );
		add_action( 'customize_register', [ $this, 'blockquote_font' ] );
		add_action( 'customize_register', [ $this, 'code_font' ] );

		add_filter( 'wp_resource_hints',  [ $this, 'resource_hints'], 10, 2 );
		add_action( 'wp_enqueue_scripts', [ $this, 'webfont_loader_script'], 30 );

	}

	/**
	 * Base font setting group.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function body_font( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-body-font', [
			'title' 	=> esc_html__( 'Body', 'baltic' ),
			'panel'		=> BALTIC_DOMAIN . '-typography',
			'priority' 	=> 10,
		] );

		$wp_customize->add_setting( 'main__family', array(
			'default'           => $this->default['main__family'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control(	new Controls\Typography( $wp_customize, 'main__family', array(
			'type'        => 'baltic-font-family',
			'section'     => BALTIC_DOMAIN . '-body-font',
			'label'       => esc_html__( 'Font Family', 'baltic' ),
			'connect'     => 'main__weight',
		) ) );

		$wp_customize->add_setting( 'main__weight', array(
			'default'           => $this->default['main__weight'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_font_weight' ],
		) );
		$wp_customize->add_control(	new Controls\Typography( $wp_customize, 'main__weight', array(
			'type'        => 'baltic-font-weight',
			'section'     => BALTIC_DOMAIN . '-body-font',
			'label'       => esc_html__( 'Font Weight', 'baltic' ),
			'connect'     => 'main__family',
		) ) );

		$wp_customize->add_setting(	'main__transform', array(
			'default'           => $this->default['main__transform'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_choices' ],
		) );
		$wp_customize->add_control(	'main__transform', array(
			'type'     => 'select',
			'section'  => BALTIC_DOMAIN . '-body-font',
			'label'    => esc_html__( 'Text Transform', 'baltic' ),
			'choices'  => array(
				'inherit'    => esc_html__( 'Default', 'baltic' ),
				'none'       => esc_html__( 'None', 'baltic' ),
				'capitalize' => esc_html__( 'Capitalize', 'baltic' ),
				'uppercase'  => esc_html__( 'Uppercase', 'baltic' ),
				'lowercase'  => esc_html__( 'Lowercase', 'baltic' ),
			),
		) );

		$wp_customize->add_setting(	'main__size', array(
			'default'           => $this->default['main__size'],
			'transport'         => 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_responsive_unit' ],
		) );
		$wp_customize->add_control( new Controls\Responsive_Units( $wp_customize, 'main__size', [
			'type'        => 'baltic-responsive-units',
			'section'  	=> BALTIC_DOMAIN . '-body-font',
			'label'       => esc_html__( 'Font size', 'baltic' ),
			'input_attrs' => [ 'min' => 0, 'step' => 0.01 ],
			'units'       => [
				'rem' 	=> 'rem',
			]
		] ) );

		$wp_customize->add_setting(	'main__line-height', array(
			'default'           => $this->default['main__line-height'],
			'transport'         => 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_responsive_unit' ],
		) );
		$wp_customize->add_control( new Controls\Responsive_Units( $wp_customize, 'main__line-height', [
			'type'        => 'baltic-responsive-units',
			'section'  	=> BALTIC_DOMAIN . '-body-font',
			'label'       => esc_html__( 'Line height', 'baltic' ),
			'input_attrs' => [ 'min' => 0, 'step' => 0.01 ],
			'units'       => [
				'em'	=> 'em',
			],
		] ) );


	}

	/**
	 * Heading setting group.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function heading_font( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-heading_font', [
			'title' 	=> esc_html__( 'Heading', 'baltic' ),
			'panel'		=> BALTIC_DOMAIN . '-typography',
			'priority' 	=> 10,
		] );

		$wp_customize->add_setting( 'heading__family', array(
			'default'           => $this->default['heading__family'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control(	new Controls\Typography( $wp_customize, 'heading__family', array(
			'type'        => 'baltic-font-family',
			'section'     => BALTIC_DOMAIN . '-heading_font',
			'label'       => esc_html__( 'Font Family', 'baltic' ),
			'connect'     => 'heading__weight',
		) ) );

		$wp_customize->add_setting( 'heading__weight', array(
			'default'           => $this->default['heading__weight'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_font_weight' ],
		) );
		$wp_customize->add_control(	new Controls\Typography( $wp_customize, 'heading__weight', array(
			'type'        => 'baltic-font-weight',
			'section'     => BALTIC_DOMAIN . '-heading_font',
			'label'       => esc_html__( 'Font Weight', 'baltic' ),
			'connect'     => 'heading__family',
		) ) );

		$wp_customize->add_setting(	'heading__transform', array(
			'default'           => $this->default['heading__transform'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_choices' ],
		) );
		$wp_customize->add_control(	'heading__transform', array(
			'type'     => 'select',
			'section'  => BALTIC_DOMAIN . '-heading_font',
			'label'    => esc_html__( 'Text Transform', 'baltic' ),
			'choices'  => array(
				'inherit'    => esc_html__( 'Default', 'baltic' ),
				'none'       => esc_html__( 'None', 'baltic' ),
				'capitalize' => esc_html__( 'Capitalize', 'baltic' ),
				'uppercase'  => esc_html__( 'Uppercase', 'baltic' ),
				'lowercase'  => esc_html__( 'Lowercase', 'baltic' ),
			),
		) );

		$wp_customize->add_setting(	'heading__line-height', array(
			'default'           => $this->default['heading__line-height'],
			'transport'         => 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_responsive_unit' ],
		) );
		$wp_customize->add_control( new Controls\Responsive_Units( $wp_customize, 'heading__line-height', [
			'type'        	=> 'baltic-responsive-units',
			'section'  		=> BALTIC_DOMAIN . '-heading_font',
			'label'      	=> esc_html__( 'Line height', 'baltic' ),
			'input_attrs' 	=> [ 'min' => 0, 'step' => 0.01 ],
			'units'       => [
				'em'	=> 'em',
			],
		] ) );

		$wp_customize->add_setting(	'h1__size', array(
			'default'           => $this->default['h1__size'],
			'transport'         => 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_responsive_unit' ],
		) );
		$wp_customize->add_control( new Controls\Responsive_Units( $wp_customize, 'h1__size', [
			'type'        => 'baltic-responsive-units',
			'section'     => BALTIC_DOMAIN . '-heading_font',
			'label'       => esc_html__( 'H1 size', 'baltic' ),
			'input_attrs' => [ 'min' => 0, 'step' => 0.01 ],
			'units'       => [
				'rem' 	=> 'rem',
			],
		] ) );

		$wp_customize->add_setting(	'h2__size', array(
			'default'           => $this->default['h2__size'],
			'transport'         => 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_responsive_unit' ],
		) );
		$wp_customize->add_control( new Controls\Responsive_Units( $wp_customize, 'h2__size', [
			'type'        => 'baltic-responsive-units',
			'section'     => BALTIC_DOMAIN . '-heading_font',
			'label'       => esc_html__( 'H2 size', 'baltic' ),
			'input_attrs' => [ 'min' => 0, 'step' => 0.01 ],
			'units'       => [
				'rem' 	=> 'rem',
			],
		] ) );

		$wp_customize->add_setting(	'h3__size', array(
			'default'           => $this->default['h3__size'],
			'transport'         => 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_responsive_unit' ],
		) );
		$wp_customize->add_control( new Controls\Responsive_Units( $wp_customize, 'h3__size', [
			'type'        => 'baltic-responsive-units',
			'section'     => BALTIC_DOMAIN . '-heading_font',
			'label'       => esc_html__( 'H3 size', 'baltic' ),
			'input_attrs' => [ 'min' => 0, 'step' => 0.01 ],
			'units'       => [
				'rem' 	=> 'rem',
			],
		] ) );

		$wp_customize->add_setting(	'h4__size', array(
			'default'           => $this->default['h4__size'],
			'transport'         => 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_responsive_unit' ],
		) );
		$wp_customize->add_control( new Controls\Responsive_Units( $wp_customize, 'h4__size', [
			'type'        => 'baltic-responsive-units',
			'section'     => BALTIC_DOMAIN . '-heading_font',
			'label'       => esc_html__( 'H4 size', 'baltic' ),
			'input_attrs' => [ 'min' => 0, 'step' => 0.01 ],
			'units'       => [
				'rem' 	=> 'rem',
			],
		] ) );

		$wp_customize->add_setting(	'h5__size', array(
			'default'           => $this->default['h5__size'],
			'transport'         => 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_responsive_unit' ],
		) );
		$wp_customize->add_control( new Controls\Responsive_Units( $wp_customize, 'h5__size', [
			'type'        => 'baltic-responsive-units',
			'section'     => BALTIC_DOMAIN . '-heading_font',
			'label'       => esc_html__( 'H5 size', 'baltic' ),
			'input_attrs' => [ 'min' => 0, 'step' => 0.01 ],
			'units'       => [
				'rem' 	=> 'rem',
			],
		] ) );

		$wp_customize->add_setting(	'h6__size', array(
			'default'           => $this->default['h6__size'],
			'transport'         => 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_responsive_unit' ],
		) );
		$wp_customize->add_control( new Controls\Responsive_Units( $wp_customize, 'h6__size', [
			'type'        => 'baltic-responsive-units',
			'section'     => BALTIC_DOMAIN . '-heading_font',
			'label'       => esc_html__( 'H6 size', 'baltic' ),
			'input_attrs' => [ 'min' => 0, 'step' => 0.01 ],
			'units'       => [
				'rem' 	=> 'rem',
			],
		] ) );

	}

	/**
	 * Blocquote settings group.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function blockquote_font( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-blockquote_font', [
			'title' 	=> esc_html__( 'Blockquote', 'baltic' ),
			'panel'		=> BALTIC_DOMAIN . '-typography',
			'priority' 	=> 10,
		] );

		$wp_customize->add_setting( 'blockquote__family', array(
			'default'           => $this->default['blockquote__family'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control(	new Controls\Typography( $wp_customize, 'blockquote__family', array(
			'type'        => 'baltic-font-family',
			'section'     => BALTIC_DOMAIN . '-blockquote_font',
			'label'       => esc_html__( 'Font Family', 'baltic' ),
			'connect'     => 'blockquote__weight',
		) ) );

		$wp_customize->add_setting( 'blockquote__weight', array(
			'default'           => $this->default['blockquote__weight'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_font_weight' ],
		) );
		$wp_customize->add_control(	new Controls\Typography( $wp_customize, 'blockquote__weight', array(
			'type'        => 'baltic-font-weight',
			'section'     => BALTIC_DOMAIN . '-blockquote_font',
			'label'       => esc_html__( 'Font Weight', 'baltic' ),
			'connect'     => 'blockquote__family',
		) ) );

		$wp_customize->add_setting(	'blockquote__transform', array(
			'default'           => $this->default['blockquote__transform'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_choices' ],
		) );
		$wp_customize->add_control(	'blockquote__transform', array(
			'type'     => 'select',
			'section'  => BALTIC_DOMAIN . '-blockquote_font',
			'label'    => esc_html__( 'Text Transform', 'baltic' ),
			'choices'  => array(
				'inherit'    => esc_html__( 'Default', 'baltic' ),
				'none'       => esc_html__( 'None', 'baltic' ),
				'capitalize' => esc_html__( 'Capitalize', 'baltic' ),
				'uppercase'  => esc_html__( 'Uppercase', 'baltic' ),
				'lowercase'  => esc_html__( 'Lowercase', 'baltic' ),
			),
		) );

		$wp_customize->add_setting(	'blockquote__size', array(
			'default'           => $this->default['blockquote__size'],
			'transport'         => 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_responsive_unit' ],
		) );
		$wp_customize->add_control( new Controls\Responsive_Units( $wp_customize, 'blockquote__size', [
			'type'        => 'baltic-responsive-units',
			'section'  	=> BALTIC_DOMAIN . '-blockquote_font',
			'label'       => esc_html__( 'Font size', 'baltic' ),
			'input_attrs' => [ 'min' => 0, 'step' => 0.01 ],
			'units'       => [
				'rem' 	=> 'rem',
			],
		] ) );

		$wp_customize->add_setting(	'blockquote__line-height', array(
			'default'           => $this->default['blockquote__line-height'],
			'transport'         => 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_responsive_unit' ],
		) );
		$wp_customize->add_control( new Controls\Responsive_Units( $wp_customize, 'blockquote__line-height', [
			'type'        => 'baltic-responsive-units',
			'section'  	=> BALTIC_DOMAIN . '-blockquote_font',
			'label'       => esc_html__( 'Line height', 'baltic' ),
			'input_attrs' => [ 'min' => 0, 'step' => 0.01 ],
			'units'       => [
				'em'	=> 'em',
			],
		] ) );

	}

	/**
	 * Code font group.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function code_font( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-code_font', [
			'title' 	=> esc_html__( 'Code', 'baltic' ),
			'panel'		=> BALTIC_DOMAIN . '-typography',
			'priority' 	=> 10,
		] );

		$wp_customize->add_setting( 'code__family', array(
			'default'           => $this->default['code__family'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control(	new Controls\Typography( $wp_customize, 'code__family', array(
			'type'        => 'baltic-font-family',
			'section'     => BALTIC_DOMAIN . '-code_font',
			'label'       => esc_html__( 'Font Family', 'baltic' ),
			'connect'     => 'code__weight',
		) ) );

		$wp_customize->add_setting( 'code__weight', array(
			'default'           => $this->default['code__weight'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_font_weight' ],
		) );
		$wp_customize->add_control(	new Controls\Typography( $wp_customize, 'code__weight', array(
			'type'        => 'baltic-font-weight',
			'section'     => BALTIC_DOMAIN . '-code_font',
			'label'       => esc_html__( 'Font Weight', 'baltic' ),
			'connect'     => 'code__family',
		) ) );

		$wp_customize->add_setting(	'code__transform', array(
			'default'           => $this->default['code__transform'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_choices' ],
		) );
		$wp_customize->add_control(	'code__transform', array(
			'type'     => 'select',
			'section'  => BALTIC_DOMAIN . '-code_font',
			'label'    => esc_html__( 'Text Transform', 'baltic' ),
			'choices'  => array(
				'inherit'    => esc_html__( 'Default', 'baltic' ),
				'none'       => esc_html__( 'None', 'baltic' ),
				'capitalize' => esc_html__( 'Capitalize', 'baltic' ),
				'uppercase'  => esc_html__( 'Uppercase', 'baltic' ),
				'lowercase'  => esc_html__( 'Lowercase', 'baltic' ),
			),
		) );

		$wp_customize->add_setting(	'code__size', array(
			'default'           => $this->default['code__size'],
			'transport'         => 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_responsive_unit' ],
		) );
		$wp_customize->add_control( new Controls\Responsive_Units( $wp_customize, 'code__size', [
			'type'        => 'baltic-responsive-units',
			'section'  	=> BALTIC_DOMAIN . '-code_font',
			'label'       => esc_html__( 'Font size', 'baltic' ),
			'input_attrs' => [ 'min' => 0, 'step' => 0.01 ],
			'units'       => [
				'rem' 	=> 'rem',
			],
		] ) );

		$wp_customize->add_setting(	'code__line-height', array(
			'default'           => $this->default['code__line-height'],
			'transport'         => 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_responsive_unit' ],
		) );
		$wp_customize->add_control( new Controls\Responsive_Units( $wp_customize, 'code__line-height', [
			'type'        => 'baltic-responsive-units',
			'section'  	=> BALTIC_DOMAIN . '-code_font',
			'label'       => esc_html__( 'Line height', 'baltic' ),
			'input_attrs' => [ 'min' => 0, 'step' => 0.01 ],
			'units'       => [
				'em'	=> 'em',
			],
		] ) );

	}

	/**
	 * Ajax webfont callback.
	 *
	 * @return void
	 */
	public static function ajax_webfonts() {
		include( BALTIC_DIR . '/assets/google-fonts.json' );
		die();
	}

	/**
	 * Add preconnect for Google Fonts.
	 *
	 * @access public
	 * @param array  $urls           URLs to print for resource hints.
	 * @param string $relation_type  The relation type the URLs are printed.
	 * @return array $urls           URLs to print for resource hints.
	 */
	public static function resource_hints( $urls, $relation_type ) {

		$webfont_loder = $this->webfont_loader();

		if ( ! empty( $webfont_loder ) && 'preconnect' === $relation_type ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		}
		return $urls;

	}

	/**
	 * Webfont loader script.
	 *
	 * @return void
	 */
	public function webfont_loader_script() {

		$webfont_loder = $this->webfont_loader();

		if ( is_customize_preview() ) {
			wp_enqueue_script( 'webfont-loader',
				BALTIC_URI . '/assets/js/webfontloader/webfontloader.js',
				[],
				'1.6.28',
				false
			);
		}

		if ( ! empty( $webfont_loder ) ) :

			wp_enqueue_script( 'webfont-loader',
				BALTIC_URI . '/assets/js/webfontloader/webfontloader.js',
				[],
				'1.6.28',
				false
			);

			wp_add_inline_script(
				'webfont-loader',
				'WebFont.load({google:{families:[\'' . join( '\', \'', $webfont_loder ) . '\']}});',
				'after'
			);

		endif;

	}

	/**
	 * Webfont loader method.
	 *
	 * @return void
	 */
	public function webfont_loader() {

		$body_font[] = [
			'family' => Options::get_option( 'main__family' ),
			'weight' => Options::get_option( 'main__weight' )
		];
		$heading_font[] = [
			'family' => Options::get_option( 'heading__family' ),
			'weight' => Options::get_option( 'heading__weight' ),
		];
		$blocquote_font[] = [
			'family' => Options::get_option( 'blockquote__font' ),
			'weight' => Options::get_option( 'blockquote__weight' ),
		];

		$code_font[] = [
			'family' => Options::get_option( 'code__font' ),
			'weight' => Options::get_option( 'code__weight' ),
		];

	 	$webfont = [];
		$fonts = array_merge( $body_font, $heading_font, $blocquote_font, $code_font );
		$google_fonts = Webfonts::get_google_fonts();

		$new = [];

		foreach ( $fonts as $key => $value) {
			$new[ $value['family'] ][] = $value['weight'];
		}

		foreach ( $new as $font => $variants ) {

			// Determine if this is indeed a google font or not.
			// If it's not, then just remove it from the array.
			if ( ! array_key_exists( $font, $google_fonts ) ) {
				unset( $new[ $font ] );
				continue;
			}

			// Get all valid font variants for this font.
			$font_variants = array();
			if ( isset( $google_fonts[ $font ][0] ) ) {
				$font_variants = $google_fonts[ $font ][0];
			}
			foreach ( $variants as $variant ) {

				// If this is not a valid variant for this font-family
				// then unset it and move on to the next one.
				if ( ! in_array( $variant, $font_variants, true ) ) {
					$variant_key = array_search( $variant, $new[ $font ], true );
					unset( $new[ $font ][ $variant_key ] );
					continue;
				}
			}
		}

		foreach ( $new as $font => $weights ) {
			foreach ( $weights as $key => $value ) {
				if ( 'italic' === $value ) {
					$weights[ $key ] = '400i';
				} else {
					$weights[ $key ] = str_replace( array( 'regular', 'bold', 'italic' ), array( '400', '', 'i' ), $value );
				}
			}
			$webfont[] = $font . ':' . join( ',', $weights ) .':cyrillic,cyrillic-ext,devanagari,greek,greek-ext,khmer,latin,latin-ext,vietnamese,hebrew,arabic,bengali,gujarati,tamil,telugu,thai';
		}

		return $webfont;

	}

}
