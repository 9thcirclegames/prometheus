<?php
class ET_Builder_Module_FullWidth_LanguageSwitcher extends ET_Builder_Module {
	function init() {
		$this->name            = esc_html__( 'Fullwidth WPML Switcher', 'et_builder' );
		$this->slug            = 'et_pb_fullwidth_language_switcher';
    $this->fullwidth       = true;
		$this->use_row_content = true;
		$this->decode_entities = true;

		$this->whitelisted_fields = array(
			'skip_missing',
      'show_flags',
      'switcher_layout',
      'show_native_language_names',
      'show_displayed_language_names',
      'switcher_prefix',
      'missing_url',
			'admin_label',
			'module_id',
			'module_class',
			'max_width',
			'max_width_tablet',
			'max_width_phone',
		);
    
    $this->fields_defaults = array(
			'show_flags'   => array( 'on' ),
      'show_native_language_names'   => array( 'on' ),
      'show_displayed_language_names'   => array( 'off' ),
		);
    
	}

	function get_fields() {
		$fields = array(
      'skip_missing' => array(
				'label'             => esc_html__( 'Skip Missing', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'0'  => esc_html__( 'Don\'t Skip', 'et_builder' ),
					'1' => esc_html__( 'Skip', 'et_builder' ),
				),
				'description'        => esc_html__( 'Skip links to missing translations.', 'et_builder' ),
        'tab_slug'           => 'advanced',
			),
      'switcher_layout' => array(
				'label'             => esc_html__( 'Layout', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'menu'  => esc_html__( 'Dropdown Menu', 'et_builder' ),
					'bar' => esc_html__( 'Horizontal Bar', 'et_builder' ),
				),
				'description'        => esc_html__( 'Set the layout for the switcher', 'et_builder' ),
			),
			'missing_url' => array(
				'label'           => esc_html__( 'Link URL for Missing Content', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'description'     => esc_html__( 'This will add a link to this page if the translation is missing.', 'et_builder' ),
        'tab_slug'           => 'advanced',
			),
      'show_flags' => array(
				'label'             => esc_html__( 'Show Flags', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'description'        => esc_html__( 'Show the language flags.', 'et_builder' ),
			),
			'show_native_language_names' => array(
				'label'             => esc_html__( 'Show Native Language Names', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'description'        => esc_html__( 'Show the native language names', 'et_builder' ),
			),
			'show_displayed_language_names' => array(
				'label'             => esc_html__( 'Show Displayed Language Names', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'description'        => esc_html__( 'Show the language names as it\'s written in the currently displayed language', 'et_builder' ),
			),
			'switcher_prefix' => array(
				'label'           => esc_html__( 'Selector Prefix', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'description'     => esc_html__( 'Set the string to prefix the selector.', 'et_builder' ),
			),
			'max_width' => array(
				'label'           => esc_html__( 'Max Width', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'mobile_options'  => true,
				'validate_unit'   => true,
			),
			'max_width_tablet' => array(
				'type' => 'skip',
			),
			'max_width_phone' => array(
				'type' => 'skip',
			),
			'disabled_on' => array(
				'label'           => esc_html__( 'Disable on', 'et_builder' ),
				'type'            => 'multiple_checkboxes',
				'options'         => array(
					'phone'   => esc_html__( 'Phone', 'et_builder' ),
					'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
					'desktop' => esc_html__( 'Desktop', 'et_builder' ),
				),
				'additional_att'  => 'disable_on',
				'option_category' => 'configuration',
				'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
			),
			'admin_label' => array(
				'label'       => esc_html__( 'Admin Label', 'et_builder' ),
				'type'        => 'text',
				'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
			'module_id' => array(
				'label'           => esc_html__( 'CSS ID', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
			'module_class' => array(
				'label'           => esc_html__( 'CSS Class', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
		);

		return $fields;
	}

  function language_switcher() {
    $languages = apply_filters( 'wpml_active_languages', NULL, array( 'skip_missing' => (int)$this->shortcode_atts['skip_missing'], 'link_empty_to' => $this->shortcode_atts['missing_url'] ) );
    
    $content = '<div class="wpml-wrapper-dropdown" tabindex="1"><i class="fa fa-globe fa-lg"></i>&nbsp;<span>' . $this->shortcode_atts['switcher_prefix'] . '</span><ul class="wpmldropdown">';
    if( !empty( $languages ) ) {
        foreach( $languages as $language ){
            $native_name = $language['native_name'];
            $displayed_name = $language['translated_name'];
            $name = (($this->shortcode_atts['show_native_language_names'] === "on") ? ($native_name . ' ' . ($this->shortcode_atts['show_displayed_language_names'] === "on" && !$language['active'] ? '(' . $displayed_name . ')' : '')) : ($this->shortcode_atts['show_displayed_language_names'] === "on" ? $displayed_name : ''));
            $flag = ($this->shortcode_atts['show_flags'] === "on" ? '<img src="' . $language['country_flag_url'] . '" style="display: inline;" class="iclflag" alt="' . $language['url'] . '" title="' . $name . '" />' : '');
 
            $content .= '<li><a href="' . (!$language['active'] ? $language['url'] : '#') . '">' . $flag . '&nbsp;' . $name . '</a></li>';
       }
    }
    $content .= '</ul></div>';
    return $content;
    
}

	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id        = $this->shortcode_atts['module_id'];
		$module_class     = $this->shortcode_atts['module_class'];
		$max_width        = $this->shortcode_atts['max_width'];
		$max_width_tablet = $this->shortcode_atts['max_width_tablet'];
		$max_width_phone  = $this->shortcode_atts['max_width_phone'];

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		if ( '' !== $max_width_tablet || '' !== $max_width_phone || '' !== $max_width ) {
			$max_width_values = array(
				'desktop' => $max_width,
				'tablet'  => $max_width_tablet,
				'phone'   => $max_width_phone,
			);

			et_pb_generate_responsive_css( $max_width_values, '%%order_class%%', 'max-width', $function_name );
		}

		$output = sprintf(
			'<div%2$s class="et_pb_language_switcher et_pb_module%3$s">
				%1$s
			</div> <!-- .et_pb_language_switcher -->',
			$this->language_switcher(),
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' )
		);

		return $output;
	}
}
new ET_Builder_Module_FullWidth_LanguageSwitcher;