<?php
/**
 * Petals Theme Customizer
 *
 * @package Petals
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function petals_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
        function petals_sanitize_checkbox( $checked ){ 
            return ( ( isset( $checked ) && true == $checked ) ? true : false );
        }
	
	function petals_sanitize_file( $file, $setting ) {
            $mimes = array(
                'jpg|jpeg|jpe' => 'image/jpeg',
                'gif'          => 'image/gif',
                'png'          => 'image/png'
            );
		
	    $file_ext = wp_check_filetype( $file, $mimes );
            return ( $file_ext['ext'] ? $file : $setting->default );
        }

	$wp_customize->add_panel( 'petals_theme_options' , array(
    		'title'      => __( 'Theme Options', 'petals' ),
    		'priority'   => 1,
	) );
	
	$wp_customize->add_setting( 'petals_link_colour', array(
		'default' => '#EF6079FF',
		'sanitize_callback'  => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'petals_link_colour', array(
		'label' => __('Link Color', 'petals'),
		'section' => 'colors',
		'settings' => 'petals_link_colour',
	) ) );
	
	$wp_customize->add_setting( 'petals_button_bgcolour', array(
		'default' => '#EF6079FF',
		'sanitize_callback'  => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'petals_button_bgcolour', array(
		'label' => __('Button Background Color', 'petals'),
		'description' => __('This will not apply to buttons that you have individually changed the color of', 'petals' ),
		'section' => 'colors',
		'settings' => 'petals_button_bgcolour',
	) ) );
	
	$wp_customize->add_section( 'petals_frontpanel' , array(
    		'title'      => __( 'Front Page Panels', 'petals' ),
    		'priority'   => 30,
		'panel'      => 'petals_theme_options',
	) );
	
	$wp_customize->add_setting( 'petals_panel_colour', array(
		'default' => '#fff',
		'sanitize_callback'  => 'sanitize_hex_color',
	) );

	$wp_customize->add_setting( 'petals_panel_header', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'petals_sanitize_checkbox',
	) );
	
	$wp_customize->add_control( 'petals_panel_header', array(
  		'type' => 'checkbox',
  		'section' => 'petals_frontpanel',
  		'label' => __( 'Bold Front Page Design', 'petals' ),
		'description' => __( "This makes your header fill your reader's screen - try it! 
				Note: This will prevent the blob and panel background colour 
				Front Panel options from having an impact until your bold design is disabled.", 'petals' ),
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'petals_panel_colour', array(
		'label' => __('Panel Background Color', 'petals' ),
		'section' => 'petals_frontpanel',
		'settings' => 'petals_panel_colour',
	) ) );
	
	$wp_customize->add_setting( 'petals_small_text', array(
  		'capability' => 'edit_theme_options',
  		'default' => __('This can be edited from your Customizer', 'petals' ),
  		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( 'petals_small_text', array(
  		'type' => 'text',
  		'section' => 'petals_frontpanel',
  		'label' => __( 'Panel Description', 'petals' ),
  		'description' => __( 'This appears next to your header image, above your header text' , 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_top_text', array(
  		'capability' => 'edit_theme_options',
  		'default' => __('Wildlife & Floral Exhibition', 'petals' ),
  		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( 'petals_top_text', array(
 	 	'type' => 'text',
  		'section' => 'petals_frontpanel',
  		'label' => __( 'Panel Heading', 'petals' ),
  		'description' => __( 'This appears next to your header image', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_bottom_text', array(
  		'capability' => 'edit_theme_options',
  		'default' => __( 'Members Exclusive', 'petals' ),
  		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( 'petals_bottom_text', array(
  		'type' => 'text',
  		'section' => 'petals_frontpanel',
  		'label' => __( 'Panel Subtitle', 'petals' ),
  		'description' => __( 'This appears next to your header image, below your header text', 'petals' ),
	) );
	
	if ( get_theme_mod( 'petals_panel_header' ) == 0 ) {
		$wp_customize->add_setting( 'petals_blob', array(
  			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback'  => 'petals_sanitize_checkbox',
		) );
	
		$wp_customize->add_control( 'petals_blob', array(
  			'type' => 'checkbox',
  			'section' => 'petals_frontpanel',
  			'label' => __( 'Display Blob', 'petals' ),
			'description' => __( 'This displays a blob behind your header, you can change the color if you wish', 'petals' ),
		) );
	}
	
	$wp_customize->add_setting( 'petals_panel_button', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'petals_sanitize_checkbox',
	) );
	
	$wp_customize->add_control( 'petals_panel_button', array(
  		'type' => 'checkbox',
  		'section' => 'petals_frontpanel',
  		'label' => __( 'Display a Button', 'petals' ),
		'description' => __( 'This allows you to link to a specific page, you can change the color of the button if you wish', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_panel_buttontext', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'sanitize_text_field',
	) );
	
	$wp_customize->add_control( 'petals_panel_buttontext', array(
  		'type' => 'text',
  		'section' => 'petals_frontpanel',
  		'label' => __( 'Button Text', 'petals' ),
		'description' => __( 'What should the button say?', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_panel_buttonlink', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'esc_url_raw',
	) );
	
	$wp_customize->add_control( 'petals_panel_buttonlink', array(
  		'type' => 'url',
  		'section' => 'petals_frontpanel',
  		'label' => __( 'Button Link', 'petals' ),
		'description' => __( 'Where does the button lead to?', 'petals' ),
	) );

	if ( get_theme_mod( 'petals_panel_header' ) == 0 ) {
		$wp_customize->add_setting( 'petals_blob_colour', array(
			'default' => '#EF6079FF',
			'sanitize_callback'  => 'petals_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'petals_blob_colour', array(
			'label' => __( 'Blob Color', 'petals' ),
			'section' => 'petals_frontpanel',
			'settings' => 'petals_blob_colour',
		) ) );
	}
	
	$wp_customize->add_setting( 'petals_button_colour', array(
		'default' => '#c74359',
		'sanitize_callback'  => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'petals_button_colour', array(
		'label' => __( 'Button Color', 'petals' ),
		'section' => 'petals_frontpanel',
		'settings' => 'petals_button_colour',
	) ) );
	
	$wp_customize->add_section( 'petals_promotion' , array(
    		'title'      => __( 'Promotion Panel', 'petals' ),
    		'priority'   => 30,
		'panel'      => 'petals_theme_options',
	) );
	
	$wp_customize->add_setting( 'petals_display_promotion', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'petals_sanitize_checkbox',
		'default' => 1,
	) );
	
	$wp_customize->add_control( 'petals_display_promotion', array(
  		'type' => 'checkbox',
  		'section' => 'petals_promotion',
  		'label' => __( 'Display Promotion Panel', 'petals' ),
		'default' => 1,
		'description' => __( 'This displays a bold panel for information to stand out to your readers' , 'petals' ),
	) );

    	$wp_customize->add_setting( 'petals_promotion_image', array(
       	 	'transport'     => 'refresh',
       	 	'height'        => 180,
      	 	'width'        => 160,
	 	'sanitize_callback'  => 'petals_sanitize_file',
	 	'default' => get_template_directory_uri().'/resources/rain.png',
  	 ));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'petals_promotion_image', array(
        	'label' => __( 'Promotion Image', 'petals' ),
        	'section' => 'petals_promotion',
        	'settings' => 'petals_promotion_image',
    	))); 
	
	$wp_customize->add_setting( 'petals_promotion_heading', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'sanitize_text_field',
		'default' => __( "Discover what's available", 'petals' )
	) );
	
	$wp_customize->add_control( 'petals_promotion_heading', array(
  		'type' => 'text',
  		'section' => 'petals_promotion',
  		'label' => __( 'Promotion Heading Text', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_promotion_subtitle', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'sanitize_text_field',
		'default' => __( "From birds to plants, there's a world to explore", 'petals' )
	) );
	
	$wp_customize->add_control( 'petals_promotion_subtitle', array(
  		'type' => 'text',
  		'section' => 'petals_promotion',
  		'label' => __( 'Promotion Subtitle', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_promotion_button', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'default' => 1,
		'sanitize_callback'  => 'petals_sanitize_checkbox',
	) );
	
	$wp_customize->add_control( 'petals_promotion_button', array(
  		'type' => 'checkbox',
  		'section' => 'petals_promotion',
  		'label' => __( 'Display a Button', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_promotion_button_text', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'sanitize_text_field',
		'default' => __( 'Explore now!', 'petals' ),
	) );
	
	$wp_customize->add_control( 'petals_promotion_button_text', array(
  		'type' => 'text',
  		'section' => 'petals_promotion',
  		'label' => __( 'Button Text', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_promotion_button_link', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'esc_url_raw',
		'default' => '#',
	) );
	
	$wp_customize->add_control( 'petals_promotion_button_link', array(
  		'type' => 'url',
  		'section' => 'petals_promotion',
  		'label' => __( 'Button Link', 'petals' ),
		'description' => __( 'Where does the button lead to?', 'petals' ),
	) );

	$wp_customize->add_setting( 'petals_promotion_spacing', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'default'  => '20',
		'sanitize_callback'  => 'absint',
	) );
	
	$wp_customize->add_control( 'petals_promotion_spacing', array(
  		'type' => 'number',
  		'section' => 'petals_promotion',
  		'label' => __( 'Spacing Between Header', 'petals' ),
		'description' => __( 'Measured in px; increase the number to largen the space between your header and promotion', 'petals' ),
	) );
	
	$wp_customize->add_section( 'petals_block_one' , array(
    		'title'      => __( 'Block One', 'petals' ),
    		'priority'   => 30,
		'panel'      => 'petals_theme_options',
	) );
	
	$wp_customize->add_setting( 'petals_display_block_one', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'petals_sanitize_checkbox',
		'default' => 1,
	) );
	
	$wp_customize->add_control( 'petals_display_block_one', array(
  		'type' => 'checkbox',
  		'section' => 'petals_block_one',
  		'label' => __( 'Display Block One', 'petals' ),
		'description' => __( 'Blocks allow you to display important content side-by-side, along with a call-to-action button' , 'petals' ),
	) );
	
   	 $wp_customize->add_setting('petals_block_one_image', array(
     	   	'transport'     => 'refresh',
     	   	'height'        => 400,
     	   	'width'        => 600,
	   	'sanitize_callback'  => 'petals_sanitize_file',
		'default' => get_template_directory_uri().'/resources/mountains.png',
  	 ));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'petals_block_one_image', array(
      	  	'label' => __('Block One Image', 'petals'),
      	 	'section' => 'petals_block_one',
     	  	'settings' => 'petals_block_one_image',
   	))); 
	
	$wp_customize->add_setting( 'petals_block_one_heading', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'sanitize_text_field',
		'default' => __( 'Edit these in your Customizer', 'petals' )
	) );
	
	$wp_customize->add_control( 'petals_block_one_heading', array(
  		'type' => 'text',
  		'section' => 'petals_block_one',
  		'label' => __( 'Block Heading', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_block_one_text', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'sanitize_text_field',
		'default' => __( 'Create something beautiful that stands out to your readers using three blocks! These can be edited with great ease in your Customizer. See below for some inspiration', 'petals' ) 
	) );
	
	$wp_customize->add_control( 'petals_block_one_text', array(
  		'type' => 'textarea',
  		'section' => 'petals_block_one',
  		'label' => __( 'Block Text', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_block_one_cta', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'default' => 1,
		'sanitize_callback'  => 'petals_sanitize_checkbox',
	) );
	
	$wp_customize->add_control( 'petals_block_one_cta', array(
  		'type' => 'checkbox',
  		'section' => 'petals_block_one',
  		'label' => __( 'Display a Call-to-Action Button', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_block_one_cta_text', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'sanitize_text_field',
		'default' => __( 'You can also add your own button!', 'petals' ) 
	) );
	
	$wp_customize->add_control( 'petals_block_one_cta_text', array(
  		'type' => 'text',
  		'section' => 'petals_block_one',
  		'label' => __( 'Button Text', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_block_one_cta_link', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'esc_url_raw',
		'default' => '#',
	) );
	
	$wp_customize->add_control( 'petals_block_one_cta_link', array(
  		'type' => 'url',
  		'section' => 'petals_block_one',
  		'label' => __( 'Button Link', 'petals' ),
	) );
	
	$wp_customize->add_section( 'petals_block_two' , array(
    		'title'      => __( 'Block Two', 'petals' ),
    		'priority'   => 30,
		'panel'      => 'petals_theme_options',
	) );
	
	$wp_customize->add_setting( 'petals_display_block_two', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'petals_sanitize_checkbox',
	) );
	
	$wp_customize->add_control( 'petals_display_block_two', array(
  		'type' => 'checkbox',
  		'section' => 'petals_block_two',
  		'label' => __( 'Display Block Two', 'petals' ),
		'description' => __( 'Blocks allow you to display important content side-by-side, along with a call-to-action button' , 'petals' ),
	) );
	
   	 $wp_customize->add_setting('petals_block_two_image', array(
     	   	'transport'     => 'refresh',
     	   	'height'        => 400,
     	   	'width'        => 600,
	   	'sanitize_callback'  => 'petals_sanitize_file',
		 'default' => get_template_directory_uri().'/resources/sunset.png',
  	 ));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'petals_block_two_image', array(
      	  	'label' => __('Block Two Image', 'petals'),
      	 	'section' => 'petals_block_two',
     	  	'settings' => 'petals_block_two_image',
   	))); 
	
	$wp_customize->add_setting( 'petals_block_two_heading', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'sanitize_text_field',
		'default' => __( 'Sunsets of a Lifetime', 'petals' ),
	) );
	
	$wp_customize->add_control( 'petals_block_two_heading', array(
  		'type' => 'text',
  		'section' => 'petals_block_two',
  		'label' => __( 'Block Heading', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_block_two_text', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'sanitize_text_field',
		'default' => __( 'Each evening, the sun gently lowers itself down for the night, leaving some remarkable sights to enjoy.', 'petals' ),
	) );
	
	$wp_customize->add_control( 'petals_block_two_text', array(
  		'type' => 'textarea',
  		'section' => 'petals_block_two',
  		'label' => __( 'Block Text', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_block_two_cta', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'default' => 1,
		'sanitize_callback'  => 'petals_sanitize_checkbox',
	) );
	
	$wp_customize->add_control( 'petals_block_two_cta', array(
  		'type' => 'checkbox',
  		'section' => 'petals_block_two',
 		'label' => __( 'Display a Call-to-Action Button', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_block_two_cta_text', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'sanitize_text_field',
		'default' => __( 'Enter your own button here', 'petals' ),
	) );
	
	$wp_customize->add_control( 'petals_block_two_cta_text', array(
  		'type' => 'text',
  		'section' => 'petals_block_two',
  		'label' => __( 'Button Text', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_block_two_cta_link', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'esc_url_raw',
		'default' => '#',
	) );
	
	$wp_customize->add_control( 'petals_block_two_cta_link', array(
  		'type' => 'url',
  		'section' => 'petals_block_two',
  		'label' => __( 'Button Link', 'petals' ),
	) );
	
	$wp_customize->add_section( 'petals_block_three' , array(
    		'title'      => __( 'Block Three', 'petals' ),
    		'priority'   => 30,
		'panel'      => 'petals_theme_options',
	) );
	
	$wp_customize->add_setting( 'petals_display_block_three', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'petals_sanitize_checkbox',
	) );
	
	$wp_customize->add_control( 'petals_display_block_three', array(
  		'type' => 'checkbox',
  		'section' => 'petals_block_three',
  		'label' => __( 'Display Block Three', 'petals' ),
		'description' => __( 'Blocks allow you to display important content side-by-side, along with a call-to-action button' , 'petals' ),
	) );
	
   	 $wp_customize->add_setting('petals_block_three_image', array(
     	   	'transport'     => 'refresh',
     	   	'height'        => 400,
     	   	'width'        => 600,
	   	'sanitize_callback'  => 'petals_sanitize_file',
		'default' => get_template_directory_uri().'/resources/items.png',
  	 ));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'petals_block_three_image', array(
      	  	'label' => __('Block Three Image', 'petals'),
      	 	'section' => 'petals_block_three',
     	  	'settings' => 'petals_block_three_image',
   	))); 
	
	$wp_customize->add_setting( 'petals_block_three_heading', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'sanitize_text_field',
		'default' => __( 'Shop', 'petals' ),
	) );
	
	$wp_customize->add_control( 'petals_block_three_heading', array(
  		'type' => 'text',
  		'section' => 'petals_block_three',
  		'label' => __( 'Block Heading', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_block_three_text', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'sanitize_text_field',
		'default' => __( 'Each tour concludes with a visit to the gift shop, filled with merchandise created by the local villages. Items are unique, hand-crafted and make the perfect gift for all. You can also visit our online store.', 'petals' ),
	) );
	
	$wp_customize->add_control( 'petals_block_three_text', array(
  		'type' => 'textarea',
  		'section' => 'petals_block_three',
  		'label' => __( 'Block Text', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_block_three_cta', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'default' => 1,
		'sanitize_callback'  => 'petals_sanitize_checkbox',
	) );
	
	$wp_customize->add_control( 'petals_block_three_cta', array(
  		'type' => 'checkbox',
  		'section' => 'petals_block_three',
  		'label' => __( 'Display a Call-to-Action Button', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_block_three_cta_text', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'sanitize_text_field',
		'default' => __( 'Purchase now!', 'petals' ),
	) );
	
	$wp_customize->add_control( 'petals_block_three_cta_text', array(
  		'type' => 'text',
  		'section' => 'petals_block_three',
  		'label' => __( 'Button Text', 'petals' ),
	) );
	
	$wp_customize->add_setting( 'petals_block_three_cta_link', array(
  		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback'  => 'esc_url_raw',
		'default' => '#',
	) );
	
	$wp_customize->add_control( 'petals_block_three_cta_link', array(
  		'type' => 'url',
  		'section' => 'petals_block_three',
  		'label' => __( 'Button Link', 'petals' ),
	) );
	
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'petals_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'petals_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'petals_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function petals_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function petals_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function petals_customize_preview_js() {
	wp_enqueue_script( 'petals-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'petals_customize_preview_js' );
