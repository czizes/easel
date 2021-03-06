<?php

add_action('customize_register', 'easel_customize_register');
add_action('customize_preview_init', 'easel_customize_preview');
add_action('wp_head', 'easel_customize_wp_head', 19);
add_filter('body_class', 'easel_customize_body_class');

function easel_customize_body_class($classes = array()){
	$classes[] = 'scheme-'.get_theme_mod('easel-customize-select-scheme', 'mecha');
	if (get_theme_mod('easel-customize-checkbox-rounded', false)) $classes[] = 'rounded-posts';
	if (function_exists('ceo_pluginfo') && get_theme_mod('easel-customize-comic-in-column', false)) $classes[] = 'cnc';
	return $classes;
}

function easel_customize_register( $wp_customize ) {
	global $css_array;

	$wp_customize->remove_section('colors');
	$wp_customize->remove_section('title_tagline');
	$wp_customize->add_section('easel-scheme-options' , array('title' => __('Options','easel'), 'priority' => 10));	
//	$wp_customize->add_section('easel-background-colors' , array('title' => __('Background Colors','easel')));
	$wp_customize->add_section('colors' , array('title' => __('Background Colors','easel'), 'description' => __('some description here','easel'), 'priority' => 20));
	$wp_customize->add_section('easel-text-colors' , array('title' => __('Text Colors','easel'), 'priority' => 30));	
	$wp_customize->add_section('easel-link-colors' , array('title' => __('Link Colors','easel'), 'priority' => 40));
	$wp_customize->add_section('easel-logo-options', array('title' => __('Logo','easel'), 'priority' => 50));
	
	$css_array = array(
			// Background Colors	
			array('slug' => 'page_background', 'description' => '#page', 'section' => 'colors', 'label' => 'Entire Content Area'),
			array('slug' => 'header_background', 'description' => '#header', 'section' => 'colors', 'label' => 'Header'),
			array('slug' => 'menubar_background', 'description' => '#menubar-wrapper', 'section' => 'colors', 'label' => 'Menubar'),
			array('slug' => 'menubar_submenu_background', 'description' => '.menu ul li ul li a', 'section' => 'colors', 'label' => 'Menubar Dropdown'),
			array('slug' => 'menubar_mouseover_background', 'description' => '.menu ul li a:hover', 'section' => 'colors', 'label' => 'Menubar When Mouseover'),
			array('slug' => 'breadcrumb_background', 'description' => '#breadcrumb-wrapper', 'section' => 'colors', 'label' => 'Breadcrumbs'),
			array('slug' => 'content_wrapper_background', 'description' => '#content-wrapper', 'section' => 'colors', 'label' => 'Content Area Below Menubar'),
			array('slug' => 'subcontent_wrapper_background', 'description' => '#subcontent-wrapper', 'section' => 'colors', 'label' => 'Content Area Below Comic'),
			array('slug' => 'narrowcolumn_widecolumn_background', 'description' => '#content-column', 'section' => 'colors', 'label' => 'Content Column'),
			array('slug' => 'post_page_navigation_background', 'description' => '.uentry, #comment-wrapper, #wp-paginav, #pagenav', 'section' => 'colors', 'label' => 'Entire Post Area'),
			array('slug' => 'post_info_background', 'description' => '.post-info', 'section' => 'colors', 'label' => 'Top Section of a Post'),
			array('slug' => 'comment_background', 'description' => '.comment, #comment-wrapper #wp-paginav', 'section' => 'colors', 'label' => 'Comment Section'),
			array('slug' => 'comment_meta_data_background', 'description' => '.comment-meta-data', 'section' => 'colors', 'label' => 'Comment Info. Line'),
			array('slug' => 'bypostauthor_background', 'description' => '.bypostauthor', 'section' => 'colors', 'label' => 'Comments Made By Post Author'),
			array('slug' => 'bypostauthor_meta_data_background', 'description' => '.bypostauthor .comment-meta-data', 'section' => 'colors', 'label' => 'Info. Line Of Post Author'),
			array('slug' => 'footer_background', 'description' => '#footer', 'section' => 'colors', 'label' => 'Footer'),
			// Text Colors 
			array('slug' => 'content_text_color', 'description' => 'body', 'section' => 'easel-text-colors', 'label' => 'Sitewide Textcolor'),
			array('slug' => 'header_textcolor', 'description' => '#header', 'section' => 'easel-text-colors', 'label' => ''),
			array('slug' => 'header_description_textcolor', 'description' => '.header-info .description', 'section' => 'easel-text-colors', 'label' => 'Site Tagline'),
			array('slug' => 'breadcrumb_textcolor', 'description' => '#breadcrumb-wrapper', 'section' => 'easel-text-colors', 'label' => ''),
			array('slug' => 'lrsidebar_widgettitle_textcolor', 'description' => 'h2.widget-title', 'section' => 'easel-text-colors', 'label' => 'Widget Titles'),
			array('slug' => 'lrsidebar_textcolor', 'description' => '.sidebar', 'section' => 'easel-text-colors', 'label' => 'Sidebar Textcolor'),
			array('slug' => 'posttitle_textcolor', 'description' => 'h2.post-title', 'section' => 'easel-text-colors', 'label' => 'Non-Link Post Titles'),
			array('slug' => 'pagetitle_textcolor', 'description' => 'h2.page-title', 'section' => 'easel-text-colors', 'label' => 'Page Titles'),
			array('slug' => 'postinfo_textcolor', 'description' => '.post-info', 'section' => 'easel-text-colors', 'label' => ''),
			array('slug' => 'post_page_navigation_textcolor', 'description' => '.uentry, #comment-wrapper, #wp-paginav', 'section' => 'easel-text-colors', 'label' => 'Post/Page Comments'),
			array('slug' => 'footer_textcolor', 'description' => '#footer', 'section' => 'easel-text-colors', 'label' => 'Footer'),
			array('slug' => 'footer_copyright_textcolor', 'description' => '.copyright-info', 'section' => 'easel-text-colors', 'label' => 'Copyright'),
			// Link Colors
			array('slug' => 'content_link_acolor', 'description' => 'body a:link', 'section' => 'easel-link-colors', 'label' => ''),
			array('slug' => 'content_link_vcolor', 'description' => 'body a:visited', 'section' => 'easel-link-colors', 'label' => ''),
			array('slug' => 'content_link_hcolor', 'description' => 'body a:hover', 'section' => 'easel-link-colors', 'label' => ''),
			array('slug' => 'header_title_acolor', 'description' => '#header h1 a', 'section' => 'easel-link-colors', 'label' => ''),
			array('slug' => 'header_title_hcolor', 'description' => '#header h1 a:hover', 'section' => 'easel-link-colors', 'label' => ''),
			array('slug' => 'menubar_top_acolor', 'description' => '.menu ul li a:link, .menu ul li a:visited, .mininav-prev a, .mininav-next a', 'section' => 'easel-link-colors', 'label' => ''),
			array('slug' => 'menubar_hcolor', 'description' => '.menu ul li a:hover, .menu ul li a.selected, .menu ul li ul li a:hover', 'section' => 'easel-link-colors', 'label' => ''),
			array('slug' => 'menubar_sub_acolor', 'description' => '.menu ul li ul li a:link, .menu ul li ul li a:visited', 'section' => 'easel-link-colors', 'label' => ''),
			array('slug' => 'breadcrumb_acolor', 'description' => '.breadcrumbs a', 'section' => 'easel-link-colors', 'label' => ''),
			array('slug' => 'breadcrumb_hcolor', 'description' => '.breadcrumbs a:hover', 'section' => 'easel-link-colors', 'label' => ''),
			array('slug' => 'sidebar_acolor', 'description' => '.sidebar .widget a', 'section' => 'easel-link-colors', 'label' => ''),
			array('slug' => 'sidebar_hcolor', 'description' => '.sidebar .widget a:hover', 'section' => 'easel-link-colors', 'label' => ''),
			array('slug' => 'postpagenav_acolor', 'description' => '.entry a, .blognav a, #paginav a, #pagenav a', 'section' => 'easel-link-colors', 'label' => ''),
			array('slug' => 'postpagenav_hcolor', 'description' => '.entry a:hover, .blognav a:hover, #paginav a:hover, #pagenav a:hover', 'section' => 'easel-link-colors', 'label' => ''),
			array('slug' => 'footer_acolor', 'description' => '#footer a', 'section' => 'easel-link-colors', 'label' => ''),
			array('slug' => 'footer_hcolor', 'description' => '#footer a:hover', 'section' => 'easel-link-colors', 'label' => ''),
			array('slug' => 'footer_copyright_acolor', 'description' => '.copyright-info a', 'section' => 'easel-link-colors', 'label' => 'Copyright'),
			array('slug' => 'footer_copyright_hcolor', 'description' => '.copyright-info a:hover', 'section' => 'easel-link-colors', 'label' => ''),
			);
	// Additions for CE
	if (function_exists('ceo_pluginfo')) {
		$css_array[] = array('slug' => 'comic_wrap_background', 'description' => '#comic-wrap', 'section' => 'colors', 'label' => 'Comic Area');
		$css_array[] = array('slug' => 'comic_wrap_textcolor', 'description' => '#comic-wrap', 'section' => 'easel-text-colors', 'label' => '');
		$css_array[] = array('slug' => 'comic_nav_background', 'description' => 'table#comic-nav-wrapper', 'section' => 'colors', 'label' => 'Default Comic Navigation');
	}
	$priority_value = 11;
	foreach ($css_array as $setinfo) {
		$setinfo_register_name = 'easel-customize['.$setinfo['slug'].']';
		$wp_customize->add_setting($setinfo_register_name, array('default' => ''));
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$setinfo['slug'], 
					array('label' => $setinfo['description'], 'description' => $setinfo['label'], 'section' => $setinfo['section'], 'settings' => $setinfo_register_name, 'priority' => $priority_value)
					)
				);
		$priority_value++;
	}
	
	$wp_customize->add_setting( 'easel-customize-select-scheme', array('default' => 'boxed'));
	$wp_customize->add_control( 'easel-customize-select-scheme-control' , array(
				'label' => __('Choose a default scheme.','easel'),
				'settings' => 'easel-customize-select-scheme',
				'section' => 'easel-scheme-options',
				'type' => 'select',
				'choices' => array(
					'none' => 'No Scheme',
					'boxed' => 'Boxed',
					'sandy' => 'Sandy',
					'mecha' => 'Mecha',
					'ceasel' => 'CEasel',
					'high' => 'High Society'
					)
				)); 
	
	$wp_customize->add_setting( 'easel-customize-checkbox-rounded', array('default' => false));
	$wp_customize->add_control( 'easel-customize-checkbox-rounded-control', array(
				'settings' => 'easel-customize-checkbox-rounded',
				'label'    => __( 'Rounded corners on Post/Page Navigation Sections','easel'),
				'section'  => 'easel-scheme-options',
				'type'     => 'checkbox'
				));
				
	$wp_customize->add_setting( 'easel-customize-checkbox-header-hotspot', array('default' => false));
	$wp_customize->add_control( 'easel-customize-checkbox-header-hotspot-control', array(
				'settings' => 'easel-customize-checkbox-header-hotspot',
				'label'    => __( 'Make the header title and description become a clickable hotspot for the entire header? (If you do the logo will not display right)','easel'),
				'section'  => 'header_image',
				'type'     => 'checkbox'
				));
				
	$wp_customize->add_setting( 'easel-customize[logo]', array('default' => ''));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'easel-customize-logo-image', array('label' => __( 'Logo, 120px height x 160px width', 'easel' ), 'section'  => 'easel-logo-options', 'settings' => 'easel-customize[logo]')));

	if (function_exists('ceo_pluginfo')) {
		$wp_customize->add_setting( 'easel-customize-comic-in-column', array('default' => false));
		$wp_customize->add_control( 'easel-customize-comic-in-column-control', array(
					'settings' => 'easel-customize-comic-in-column',
					'label'    => __('Put the Comic in the content column?','easel'),
					'section'  => 'easel-scheme-options',
					'type'     => 'checkbox'
					));
	}
/*	foreach ($css_array as $setting) {
		$wp_customize->get_setting($setting['slug'])->transport='postMessage';
	} */
	if ($wp_customize->is_preview() && !is_admin())
		add_action('wp_footer', 'easel_customize_preview');
}

function easel_customize_preview() {
	global $settings_array;
	if (!empty($settings_array)) {
    ?>
    <script type="text/javascript">
    ( function( $ ){
	<?php foreach ($settings_array as $setting) { ?>
    wp.customize('<?php echo $setting['slug']; ?>',function( value ) {
        value.bind(function(to) {
            $('<?php echo $setting['element']; ?>').css('<?php echo $setting['style']; ?>', to ? to : '' );
        });
    });
	<?php } ?>
    } )( jQuery )
    </script>
    <?php
	}
}

function easel_customize_wp_head() {
	global $settings_array;
	$important = '';
	$settings_array = array(
			// background colors
			array('slug' => 'page_background', 'element' => '#page', 'style' => 'background-color', 'default' => '', 'important' => false),
			array('slug' => 'header_background', 'element' => '#header', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'menubar_background', 'element' => '#menubar-wrapper', 'style' => 'background-color', 'default' => '#000000',  'important' => false),
			array('slug' => 'menubar_submenu_background', 'element' => '.menu ul li ul li a', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'menubar_mouseover_background', 'element' => '.menu ul li a:hover, .menu ul li a.selected', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'breadcrumb_background', 'element' => '#breadcrumb-wrapper', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'content_wrapper_background', 'element' => '#content-wrapper', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'subcontent_wrapper_background', 'element' => '#subcontent-wrapper', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'narrowcolumn_widecolumn_background', 'element' => '.narrowcolumn, .widecolumn', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'post_page_navigation_background', 'element' => '.uentry, #comment-wrapper, #wp-paginav, .blognav, #pagenav', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'post_info_background', 'element' => '.post-info', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'comment_background', 'element' => '.comment, #comment-wrapper #wp-paginav', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'comment_meta_data_background', 'element' => '.comment-meta-data', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'bypostauthor_background', 'element' => '.bypostauthor', 'style' => 'background-color', 'default' => '',  'important' => true),
			array('slug' => 'bypostauthor_meta_data_background', 'element' => '.bypostauthor .comment-meta-data', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'footer_background', 'element' => '#footer', 'style' => 'background-color', 'default' => '',  'important' => false),
			// text colors
			array('slug' => 'content_text_color', 'element' => 'body', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'header_textcolor', 'element' => '#header', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'header_description_textcolor', 'element' => '.header-info', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'breadcrumb_textcolor', 'element' => '#breadcrumb-wrapper', 'style' => 'color', 'default' => '#fff',  'important' => false),
			array('slug' => 'lrsidebar_widgettitle_textcolor', 'element' => 'h2.widget-title', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'lrsidebar_textcolor', 'element' => '.sidebar', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'posttitle_textcolor', 'element' => 'h2.post-title', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'pagetitle_textcolor', 'element' => 'h2.page-title', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'postinfo_textcolor', 'element' => '.post-info', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'post_page_navigation_textcolor', 'element' => '.uentry, #comment-wrapper, #wp-paginav', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'footer_text', 'element' => '#footer', 'style' => 'color', 'default' => '#FFFFFF',  'important' => false),
			array('slug' => 'footer_copyright_textcolor', 'element' => '.copyright-info', 'style' => 'color', 'default' => '#CCC',  'important' => false),
			// link colors
			array('slug' => 'content_link_acolor', 'element' => 'a:link, a:visited', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'content_link_vcolor', 'element' => 'a:visited', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'content_link_hcolor', 'element' => 'a:hover', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'content_link_vcolor', 'element' => 'a:visited', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'header_title_acolor', 'element' => '#header h1 a:link, #header h1 a:visited', 'style' => 'color', 'default' => '#fcff00',  'important' => false),
			array('slug' => 'header_title_hcolor', 'element' => '#header h1 a:hover', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'menubar_top_acolor', 'element' => '.menu ul li a:link, .menu ul li a:visited, .mininav-prev a, .mininav-next a', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'menubar_hcolor', 'element' => '.menu ul li a:hover, .menu ul li a.selected, .menu ul li ul li a:hover', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'menubar_sub_acolor', 'element' => '.menu ul li ul li a:link, .menu ul li ul li a:visited', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'breadcrumb_acolor', 'element' => '.breadcrumbs a', 'style' => 'color', 'default' => '#fcff00',  'important' => false),
			array('slug' => 'breadcrumb_hcolor', 'element' => '.breadcrumbs a:hover', 'style' => 'color', 'default' => '#f00',  'important' => false),
			array('slug' => 'sidebar_acolor', 'element' => '.sidebar .widget a', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'sidebar_hcolor', 'element' => '.sidebar .widget a:hover', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'postpagenav_acolor', 'element' => '.entry a, .blognav a, #paginav a, #pagenav a', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'postpagenav_hcolor', 'element' => '.entry a:hover, .blognav a:hover, #paginav a:hover, #pagenav a:hover', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'footer_acolor', 'element' => '#footer a', 'style' => 'color', 'default' => '#ffdf00',  'important' => false),
			array('slug' => 'footer_hcolor', 'element' => '#footer a:hover', 'style' => 'color', 'default' => '#F00',  'important' => false),
			array('slug' => 'footer_copyright_acolor', 'element' => '.copyright-info a', 'style' => 'color', 'default' => '#FFFFFF',  'important' => false),
			array('slug' => 'footer_copyright_hcolor', 'element' => '.copyright-info a:hover, .blognav a:hover, #paginav a:hover', 'style' => 'color', 'default' => '#F00',  'important' => false),
			);
	if (function_exists('ceo_pluginfo')) {
		$settings_array[] = array('slug' => 'comic_wrap_background', 'element' => '#comic-wrap', 'style' => 'background-color', 'default' => '',  'important' => true);
		$settings_array[] = array('slug' => 'comic_wrap_textcolor', 'element' => '#comic-wrap', 'style' => 'color', 'default' => '',  'important' => true);
		$settings_array[] = array('slug' => 'comic_nav_background', 'element' => 'table#comic-nav-wrapper', 'style' => 'background-color', 'default' => '',  'important' => true);
	}
	$output = '';
	$style_output = '';
	$default_settings = false;
	$customize = get_theme_mod('easel-customize');
	if (!empty($customize)) {
		foreach ($settings_array as $setting) {
			if (isset($customize[$setting['slug']])) $content = $customize[$setting['slug']];
			$important = ($setting['important']) ? '!important' : '';
			if (!empty($content)) $style_output .= $setting['element'].' { '.$setting['style'].': '.$content.$important.'; } ';
		}
	} else {
		// if no theme mod value, set defaults (new install)
		$default_settings = true;
 		foreach ($settings_array as $setting) {
			$content = $setting['default'];
			$important = ($setting['important']) ? '!important' : '';
			if (!empty($content)) {
				$style_output .= $setting['element'].' { '.$setting['style'].': '.$content.$important.'; } ';
			}
		}
	}
	if (isset($customize['logo']) && !empty($customize['logo'])) {
		$style_output .= '.header-info { display: inline-block; float: left; padding: 0; }';
		$style_output .= '.header-info h1 { margin: 0; padding: 0; background: url("'.$customize['logo'].'") top left no-repeat; background-size: contain; display: cover; }';
		$style_output .= '.header-info h1 a { padding: 0; margin: 0; height: 120px; width: 180px; text-indent: -9999px; white-space: nowrap; overflow: hidden; display: block;}';
		$style_output .= '.header-info .description { display: none!important; }';
	}
	if (!empty($style_output)) {
		$output .= '<style type="text/css">'."\r\n";
		$output .= $style_output;
		if (!empty($customize))
			$output .= 'body { background-position: fixed; }';
		$output .= "\r\n</style>\r\n";
		echo $output;
	}
}
