<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Petals
 */
?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header id="masthead" class="site-header">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'petals'); ?></a>

		<nav id="site-navigation" class="main-navigation">
			<button aria-controls="primary-menu" aria-expanded="false" class="menu-toggle"><svg class="menu-toggle-icon"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6"/></svg></button>
				<div class="site-branding">
			<?php
if (is_front_page() && is_home()):
?>
				<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
		</div><!-- .site-branding -->
			<?php
endif; ?>
			<h1 class="site-title menu-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
			<?php
wp_nav_menu(array('theme_location' => 'menu-1', 'menu_id' => 'primary-menu',));
?>
		</nav>
		<?php if (!is_paged() && is_front_page()): ?>
			<?php the_custom_logo(); ?>
			<?php
    $petals_description = get_bloginfo('description', 'display');
    if (($petals_description || is_customize_preview()) && get_theme_mod('petals_panel_header') == 0):
        if (function_exists('jetpack_social_menu')) jetpack_social_menu(); ?>
				<p class="site-description"><?php echo $petals_description; /* WPCS: xss ok. */ ?></p>
			<?php
    endif; ?>
		
		<?php if (get_theme_mod('petals_panel_header') == 1) { ?>
			<div class="front-panel-wrapper centrebg" style="background-image: url(<?php echo esc_url(header_image()) ?>)">
		<?php
    } else ?>
			<div class="front-panel-empty-wrapper">
				
		<div class="front-panel">
	<?php if (get_theme_mod('petals_blob', 1) == 1 && get_theme_mod('petals_panel_header') == 0): ?> <svg class="front-panel-blob" width="800" height="800" viewBox="0 0 600 600">
  <g transform="translate(300,300)">
    <path d="M133,-198.4C176.2,-179.1,217.7,-148.8,230.1,-108.8C242.4,-68.9,225.6,-19.4,210.2,24.3C194.7,68,180.5,106.1,156.4,137.7C132.3,169.3,98.4,194.5,60.4,205.7C22.4,216.8,-19.8,214,-67.9,209.7C-115.9,205.3,-169.8,199.6,-191.1,169C-212.5,138.3,-201.3,82.8,-204.8,31.9C-208.3,-19,-226.5,-65.4,-213.6,-99.2C-200.8,-133.1,-156.9,-154.5,-116.1,-174.8C-75.3,-195.2,-37.7,-214.6,3.6,-220.2C44.9,-225.8,89.7,-217.6,133,-198.4Z" fill="#EF6079FF"/>
  </g>
</svg>
	<?php
    endif; ?>
			<h6 class="small-panel-text"> <?php echo esc_attr(get_theme_mod('petals_small_text', __('This can be edited from your Customizer', 'petals'))); ?> </h6>
			<h1 class="top-panel-text"> <?php echo esc_attr(get_theme_mod('petals_top_text', __('Wildlife & Floral Exhibition', 'petals'))); ?> </h1>
			<h3 class ="bottom-panel-text"> <?php echo esc_attr(get_theme_mod('petals_bottom_text', __('Members Exclusive', 'petals'))); ?> </h3>
			<?php if (get_theme_mod('petals_panel_button', 1) == 1): ?> 
			<a class="panel-button button" href="<?php echo esc_attr(get_theme_mod('petals_panel_buttonlink', '#', 'petals')); ?>">
					<?php echo esc_attr(get_theme_mod('petals_panel_buttontext', __('Enter your own button here', 'petals'))); ?>
			</a>
			<?php
    endif; ?>
			</div>
			<?php if (get_theme_mod('petals_panel_header') == 0) { ?>
			<img class="custom-header" src="
			<?php header_image(); ?>" width="<?php get_custom_header()->width; ?>" height="<?php get_custom_header()->height; ?>" 
			alt="">
				<?php
    } ?> <!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->
	<?php if (!is_paged() && get_theme_mod('petals_display_promotion', 1) == 1): ?>
	<div class="petals-promotion">
		<?php if (get_theme_mod('petals_promotion_image')): ?>
		<div class="promotion-image centrebg" style="background-image: url(<?php echo esc_url(get_theme_mod('petals_promotion_image')); ?>)">
		<?php
        endif; ?>
		<?php if (!get_theme_mod('petals_promotion_image')): ?>
		<div class="promotion-image centrebg" style="background-image: url(<?php echo esc_url(get_template_directory_uri() . '/resources/rain.png') ?>) ">
		<?php
        endif; ?>
			<div class="promotion-text">
			<h1 class="promotion-title"> <?php echo esc_attr(get_theme_mod('petals_promotion_heading', __('Discover what\'s available', 'petals'))); ?> </h1>
			<h3 class ="promotion-subtitle"> <?php echo esc_attr(get_theme_mod('petals_promotion_subtitle', __('From birds to plants, there\'s a world to explore', 'petals'))); ?> </h3>
					<?php if (get_theme_mod('petals_promotion_button', 1) == 1): ?> 
			<a class="promotion-button panel-button" href="<?php echo esc_url(get_theme_mod('petals_promotion_button_link', '#')); ?>">
					<?php echo esc_attr(get_theme_mod('petals_promotion_button_text', __('Explore now!', 'petals'))); ?>
			</a>
			<?php
        endif; ?>
			</div>
		</div>
	</div>
	<?php
    endif; ?>
	<?php if (is_home() && !is_paged()): ?>
	<div class="petals-block-wrapper">
	<?php if (get_theme_mod('petals_display_block_one', 1) == 1): ?>
		<div class="petals-block-one">
			<?php if (get_theme_mod('petals_block_one_image')): ?>
				<img src="<?php echo esc_url(get_theme_mod('petals_block_one_image')); ?>">
			<?php
            endif; ?>
			<?php if (!get_theme_mod('petals_block_one_image')): ?>
			<img src="<?php echo esc_url(get_template_directory_uri() . '/resources/mountains.png') ?>">
			<?php
            endif; ?>
			<div class="block-one-contents-wrapper">
				<h2 class ="block-one-heading"> <?php echo esc_attr(get_theme_mod('petals_block_one_heading', __('Edit these in your Customizer', 'petals'))); ?></h2>
				<p class ="block-one-text"> <?php echo esc_attr(get_theme_mod('petals_block_one_text', __('Create something beautiful that stands out to your readers using three blocks! These can be edited with great ease in your Customizer. See below for some inspiration.', 'petals'))); ?></p>
				<?php if (get_theme_mod('petals_block_one_cta', 1)): ?>
				<a class="block-one-button promotion-button panel-button" href="<?php echo esc_url(get_theme_mod('petals_block_one_cta_link', '#')); ?>">
					<?php echo esc_attr(get_theme_mod('petals_block_one_cta_text', __('You can also add your own button!', 'petals'))); ?>
				</a>
				<?php
            endif; ?>
			</div>
		</div>
	<?php
        endif; ?>
	<?php if (get_theme_mod('petals_display_block_two', 0) == 1): ?>
		<div class="petals-block-two">
			<div class="block-two-contents-wrapper">
				<h2 class ="block-two-heading"> <?php echo esc_attr(get_theme_mod('petals_block_two_heading', __('Sunsets of a Lifetime', 'petals'))); ?></h2>
				<p class ="block-two-text"> <?php echo esc_attr(get_theme_mod('petals_block_two_text', __('Each evening, the sun gently lowers itself down for the night, leaving some remarkable sights to enjoy, and offering the chance to take some fantastic pictures. ', 'petals'))); ?></p>
				<?php if (get_theme_mod('petals_block_two_cta', 1) == 1): ?> 
				<a class="block-two-button promotion-button panel-button" href="<?php echo esc_attr(get_theme_mod('petals_block_two_cta_link', __('Enter your own button here', 'petals'))); ?>">
					<?php echo esc_attr(get_theme_mod('petals_block_two_cta_text', __('Enter your own button here', 'petals'))); ?>
				</a>
				<?php
            endif; ?>
			</div>
			<?php if (get_theme_mod('petals_block_two_image')): ?>
				<img src="<?php echo esc_url(get_theme_mod('petals_block_two_image')); ?>">
			<?php
            endif; ?>
			<?php if (!get_theme_mod('petals_block_two_image')): ?>
			<img src="<?php echo esc_url(get_template_directory_uri() . '/resources/sunset.png') ?>">
			<?php
            endif; ?>
		</div>
	<?php
        endif; ?>
		<?php if (get_theme_mod('petals_display_block_three', 0) == 1): ?>
		<div class="petals-block-three">
			<?php if (get_theme_mod('petals_block_three_image')): ?>
				<img src="<?php echo esc_url(get_theme_mod('petals_block_three_image')); ?>">
			<?php
            endif; ?>
			<?php if (!get_theme_mod('petals_block_three_image')): ?>
			<img src="<?php echo esc_url(get_template_directory_uri() . '/resources/items.png') ?>">
			<?php
            endif; ?>
			<div class="block-three-contents-wrapper">
				<h2 class ="block-three-heading"> <?php echo esc_attr(get_theme_mod('petals_block_three_heading', __('Shop', 'petals'))); ?></h2>
				<p class ="block-three-text"> <?php echo esc_attr(get_theme_mod('petals_block_three_text', __('Each tour concludes with a visit to the gift shop, filled with merchandise created by the local villages. Items are unique, hand-crafted and make the perfect gift for all. You can also visit our online store.', 'petals'))); ?></p>
				<?php if (get_theme_mod('petals_block_three_cta', 1) == 1): ?> 
				<a class="block-three-button promotion-button panel-button" href="<?php echo esc_url(get_theme_mod('petals_block_three_cta_link', '#')); ?>">
					<?php echo esc_attr(get_theme_mod('petals_block_three_cta_text', __('Purchase now!', 'petals'))); ?>
				</a>
				<?php
            endif; ?>
			</div>
		</div>
	<?php
        endif; ?>
	<?php
    endif; ?>
	</div>
	<?php
endif; ?>
	<div id="content" class="site-content">
