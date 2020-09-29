<?php

function shk_corporate_header_layout_customizer($wp_customize) {

    class shk_corporate_Image_Radio_Button_Custom_Control extends WP_Customize_Control {

        /**
         * The type of control being rendered
         */
        public $type = 'image_radio_button';

        public function enqueue() {
            add_action('customize_controls_print_styles', array($this, 'print_styles'));
        }

        public function print_styles() {
            ?><style>
                /*Blue child*/
                #customize-control-appointment_options-header_classic_layout_setting .image_radio_button_control .radio-button-label > img {
                    margin-top: 5%;
                }

            </style>
            <?php
        }

        /**
         * Render the control in the customizer
         */
        public function render_content() {
            ?>
            <div class="image_radio_button_control">
                <?php if (!empty($this->label)) { ?>
                    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php } ?>
                <?php if (!empty($this->description)) { ?>
                    <span class="customize-control-description"><?php echo esc_html($this->description); ?></span>
                <?php } ?>

                <?php foreach ($this->choices as $key => $value) { ?>
                    <label class="radio-button-label">
                        <input type="radio" name="<?php echo esc_attr($this->id); ?>" value="<?php echo esc_attr($key); ?>" <?php $this->link(); ?> <?php checked(esc_attr($key), $this->value()); ?>/>
                        <img src="<?php echo esc_attr($value['image']); ?>" alt="<?php echo esc_attr($value['name']); ?>" title="<?php echo esc_attr($value['name']); ?>" />
                    </label>
                <?php } ?>
            </div>
            <?php
        }

    }

    $shk_corporate_header_setting = wp_parse_args(get_option('appointment_options', array()), appointment_theme_setup_data());


    /* Header Layout section */
    $wp_customize->add_section('header_classic_layout_setting', array(
        'title' => esc_html__('Header Layout', 'shk-corporate'),
        'panel' => 'header_options'
    ));

    // Header Layout settings
    if ((!has_custom_logo() && $shk_corporate_header_setting['enable_header_logo_text'] == 'nomorenow') || $shk_corporate_header_setting['enable_header_logo_text'] == 1 || $shk_corporate_header_setting['upload_image_logo'] != '') {

        $wp_customize->add_setting('appointment_options[header_classic_layout_setting]', array(
            'default' => 'default',
            'sanitize_callback' => 'shk_corporate_sanitize_radio',
            'type' => 'option'
        ));
    } else {

        $wp_customize->add_setting('appointment_options[header_classic_layout_setting]', array(
            'default' => 'classic',
            'sanitize_callback' => 'shk_corporate_sanitize_radio',
            'type' => 'option'
        ));
    }
    $wp_customize->add_control(new shk_corporate_Image_Radio_Button_Custom_Control($wp_customize, 'appointment_options[header_classic_layout_setting]',
                    array(
                'label' => esc_html__('Header Layout Setting', 'shk-corporate'),
                'section' => 'header_classic_layout_setting',
                'choices' => array(
                    'default' => array(
                        'image' => SHK_CORPORATE_TEMPLATE_DIR_URI . '/images/shk-header-standard.png',
                        'name' => esc_html__('Header Standard', 'shk-corporate')
                    ),
                    'classic' => array(
                        'image' => SHK_CORPORATE_TEMPLATE_DIR_URI . '/images/shk-header-classic.png',
                        'name' => esc_html__('Header Classic', 'shk-corporate')
                    )
                )
                    )
    ));
}

add_action('customize_register', 'shk_corporate_header_layout_customizer');

//radio box sanitization function
function shk_corporate_sanitize_radio($input, $setting) {

    $input = sanitize_key($input);

    $choices = $setting->manager->get_control($setting->id)->choices;

    //return if valid 
    return ( array_key_exists($input, $choices) ? $input : $setting->default );
}
