<?php
/**
 * Soccer Club functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package soccer-club
 * @since soccer-club 1.0
 */

if ( ! function_exists( 'soccer_club_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since soccer-club 1.0
	 *
	 * @return void
	 */
	function soccer_club_support() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		add_theme_support( 'align-wide' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

		add_theme_support( 'responsive-embeds' );

   		add_theme_support( 'woocommerce' );
		
		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );
	}

endif;

add_action( 'after_setup_theme', 'soccer_club_support' );

if ( ! function_exists( 'soccer_club_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @since soccer-club 1.0
	 *
	 * @return void
	 */
	function soccer_club_styles() {

		// Register theme stylesheet.
		wp_register_style(
			'soccer-club-style',
			get_template_directory_uri() . '/style.css',
			array(),
			wp_get_theme()->get( 'Version' )
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'soccer-club-style' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'soccer_club_styles' );


// Add block patterns
require get_template_directory() . '/inc/block-pattern.php';

// Add block Style
require get_template_directory() . '/inc/block-style.php';

// Get Started
require get_template_directory() . '/get-started/getstart.php';

// Add Customizer
require get_template_directory() . '/inc/customizer.php';

function soccer_club_page_redirect() {
 global $pagenow;
 if (isset($_GET['activated']) && ('themes.php' == $pagenow) && is_admin()) {
 wp_safe_redirect(admin_url("themes.php?page=soccer-club"));
 }
}

// Redirect To The Getting Started Page After Theme Activation
add_action('after_setup_theme', 'soccer_club_page_redirect');

// Upsell
if ( class_exists( 'WP_Customize_Section' ) ) {
	class Soccer_Club_Upsell_Section extends WP_Customize_Section {
		public $type = 'soccer-club-upsell';
		public $button_text = '';
		public $url = '';
		public $background_color = '';
		public $text_color = '';
		protected function render() {
			$background_color = ! empty( $this->background_color ) ? esc_attr( $this->background_color ) : '#e21e22';
			$text_color       = ! empty( $this->text_color ) ? esc_attr( $this->text_color ) : '#fff';
			?>
			<li id="accordion-section-<?php echo esc_attr( $this->id ); ?>" class="soccer_club_upsell_section accordion-section control-section control-section-<?php echo esc_attr( $this->id ); ?> cannot-expand">
				<h3 class="accordion-section-title" style="color:#fff; background:<?php echo esc_attr( $background_color ); ?>;border-left-color:<?php echo esc_attr( $background_color ); ?>;">
					<?php echo esc_html( $this->title ); ?>
					<a href="<?php echo esc_url( $this->url ); ?>" class="button button-secondary alignright" target="_blank" style="margin-top: -4px;"><?php echo esc_html( $this->button_text ); ?></a>
				</h3>
			</li>
			<?php
		}
	}
}