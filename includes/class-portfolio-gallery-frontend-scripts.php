<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Class Portfolio_Gallery
 */
class Portfolio_Gallery_Frontend_Scripts {

	/**
	 * Portfolio_Gallery_Frontend_Scripts constructor.
	 */
	public function __construct() {
		add_action( 'portfolio_gallery_shortcode_scripts', array( $this, 'frontend_scripts' ), 10, 2 );
		add_action( 'portfolio_gallery_shortcode_scripts', array( $this, 'frontend_styles' ), 10, 2 );
		add_action( 'portfolio_gallery_localize_scripts', array( $this, 'localize_scripts' ), 10, 1 );
	}

	/**
	 * Enqueue styles
	 */
	public function frontend_styles( $id, $portfolio_view ) {
		$general_options = portfolio_gallery_get_default_general_options();

		wp_register_style( 'portfolio-all-css', plugins_url( '../assets/style/portfolio-all.css', __FILE__ ) );
		wp_enqueue_style( 'portfolio-all-css' );

		wp_register_style( 'style2-os-css', plugins_url( '../assets/style/style2-os.css', __FILE__ ) );
		wp_enqueue_style( 'style2-os-css' );

		wp_register_style( 'lightbox-css', plugins_url( '../assets/style/lightbox.css', __FILE__ ) );
		wp_enqueue_style( 'lightbox-css' );

		wp_enqueue_style( 'portfolio_gallery_colorbox_css', untrailingslashit( Portfolio_Gallery()->plugin_url() ) . '/assets/style/colorbox-' . $general_options['portfolio_gallery_light_box_style'] . '.css' );

		if ($portfolio_view == '5') {
			wp_register_style( 'animate-css', plugins_url( '../assets/style/animate.min.css', __FILE__ ) );
			wp_enqueue_style( 'animate-css' );
			wp_register_style( 'liquid-slider-css', plugins_url( '../assets/style/liquid-slider.css', __FILE__ ) );
			wp_enqueue_style( 'liquid-slider-css' );
		}
	}

	/**
	 * Enqueue scripts
	 */
	public function frontend_scripts( $id, $portfolio_view ) {
		$view_slug = portfolio_gallery_get_view_slag_by_id( $id );

		if ( ! wp_script_is( 'jquery' ) ) {
			wp_enqueue_script( 'jquery' );
		}
		wp_register_script( 'jquery.pcolorbox-js', plugins_url( '../assets/js/jquery.colorbox.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'jquery.pcolorbox-js' );

		wp_register_script( 'hugeitmicro-min-js', plugins_url( '../assets/js/jquery.hugeitmicro.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'hugeitmicro-min-js' );

		wp_register_script( 'front-end-js-'.$view_slug, plugins_url( '../assets/js/view-' . $view_slug . '.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'front-end-js-'.$view_slug );

		wp_register_script( 'custom-js', plugins_url( '../assets/js/custom.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'custom-js' );

		if ($portfolio_view == '5'){
			wp_register_script( 'easing-js', plugins_url( '../assets/js/jquery.easing.min.js', __FILE__ ), array( 'jquery' ), '1.3.0', true );
			wp_enqueue_script( 'easing-js' );
			wp_register_script( 'touch_swipe-js', plugins_url( '../assets/js/jquery.touchSwipe.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'touch_swipe-js' );
			wp_register_script( 'liquid-slider-js', plugins_url( '../assets/js/jquery.liquid-slider.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'liquid-slider-js' );
		}
	}

	public function localize_scripts( $id ) {
		$portfolio_param = portfolio_gallery_get_default_general_options();
		$view_slug = portfolio_gallery_get_view_slag_by_id( $id );

		$lightbox = array(
			'lightbox_transition'     => $portfolio_param['portfolio_gallery_light_box_transition'],
			'lightbox_speed'          => $portfolio_param['portfolio_gallery_light_box_speed'],
			'lightbox_fadeOut'        => $portfolio_param['portfolio_gallery_light_box_fadeout'],
			'lightbox_title'          => $portfolio_param['portfolio_gallery_light_box_title'],
			'lightbox_scalePhotos'    => $portfolio_param['portfolio_gallery_light_box_scalephotos'],
			'lightbox_scrolling'      => $portfolio_param['portfolio_gallery_light_box_scrolling'],
			'lightbox_opacity'        => ( $portfolio_param['portfolio_gallery_light_box_opacity'] / 100 ) + 0.001,
			'lightbox_open'           => $portfolio_param['portfolio_gallery_light_box_open'],
			'lightbox_returnFocus'    => $portfolio_param['portfolio_gallery_light_box_returnfocus'],
			'lightbox_trapFocus'      => $portfolio_param['portfolio_gallery_light_box_trapfocus'],
			'lightbox_fastIframe'     => $portfolio_param['portfolio_gallery_light_box_fastiframe'],
			'lightbox_preloading'     => $portfolio_param['portfolio_gallery_light_box_preloading'],
			'lightbox_overlayClose'   => $portfolio_param['portfolio_gallery_light_box_overlayclose'],
			'lightbox_escKey'         => $portfolio_param['portfolio_gallery_light_box_esckey'],
			'lightbox_arrowKey'       => $portfolio_param['portfolio_gallery_light_box_arrowkey'],
			'lightbox_loop'           => $portfolio_param['portfolio_gallery_light_box_loop'],
			'lightbox_closeButton'    => $portfolio_param['portfolio_gallery_light_box_closebutton'],
			'lightbox_previous'       => $portfolio_param['portfolio_gallery_light_box_previous'],
			'lightbox_next'           => $portfolio_param['portfolio_gallery_light_box_next'],
			'lightbox_close'          => $portfolio_param['portfolio_gallery_light_box_close'],
			'lightbox_html'           => $portfolio_param['portfolio_gallery_light_box_html'],
			'lightbox_photo'          => $portfolio_param['portfolio_gallery_light_box_photo'],
			'lightbox_innerWidth'     => $portfolio_param['portfolio_gallery_light_box_innerwidth'],
			'lightbox_innerHeight'    => $portfolio_param['portfolio_gallery_light_box_innerheight'],
			'lightbox_initialWidth'   => $portfolio_param['portfolio_gallery_light_box_initialwidth'],
			'lightbox_initialHeight'  => $portfolio_param['portfolio_gallery_light_box_initialheight'],
			'lightbox_slideshow'      => $portfolio_param['portfolio_gallery_light_box_slideshow'],
			'lightbox_slideshowSpeed' => $portfolio_param['portfolio_gallery_light_box_slideshowspeed'],
			'lightbox_slideshowAuto'  => $portfolio_param['portfolio_gallery_light_box_slideshowauto'],
			'lightbox_slideshowStart' => $portfolio_param['portfolio_gallery_light_box_slideshowstart'],
			'lightbox_slideshowStop'  => $portfolio_param['portfolio_gallery_light_box_slideshowstop'],
			'lightbox_fixed'          => $portfolio_param['portfolio_gallery_light_box_fixed'],
			'lightbox_reposition'     => $portfolio_param['portfolio_gallery_light_box_reposition'],
			'lightbox_retinaImage'    => $portfolio_param['portfolio_gallery_light_box_retinaimage'],
			'lightbox_retinaUrl'      => $portfolio_param['portfolio_gallery_light_box_retinaurl'],
			'lightbox_retinaSuffix'   => $portfolio_param['portfolio_gallery_light_box_retinasuffix'],
			'lightbox_maxWidth'       => $portfolio_param['portfolio_gallery_light_box_maxwidth'],
			'lightbox_maxHeight'      => $portfolio_param['portfolio_gallery_light_box_maxheight'],
			'lightbox_sizeFix'        => $portfolio_param['portfolio_gallery_light_box_size_fix']
		);

		if ( $portfolio_param['portfolio_gallery_light_box_size_fix'] == 'false' ) {
			$lightbox['lightbox_width'] = '';
		} else {
			$lightbox['lightbox_width'] = $portfolio_param['portfolio_gallery_light_box_width'];
		}

		if ( $portfolio_param['portfolio_gallery_light_box_size_fix'] == 'false' ) {
			$lightbox['lightbox_height'] = '';
		} else {
			$lightbox['lightbox_height'] = $portfolio_param['portfolio_gallery_light_box_height'];
		}

		$pos = $portfolio_param['portfolio_gallery_slider_title_position'];
		switch ( $pos ) {
			case 1:
				$lightbox['lightbox_top']    = '10%';
				$lightbox['lightbox_bottom'] = 'false';
				$lightbox['lightbox_left']   = '10%';
				$lightbox['lightbox_right']  = 'false';
				break;
			case 2:
				$lightbox['lightbox_top']    = '10%';
				$lightbox['lightbox_bottom'] = 'false';
				$lightbox['lightbox_left']   = 'false';
				$lightbox['lightbox_right']  = 'false';
				break;
			case 3:
				$lightbox['lightbox_top']    = '10%';
				$lightbox['lightbox_bottom'] = 'false';
				$lightbox['lightbox_left']   = 'false';
				$lightbox['lightbox_right']  = '10%';
				break;
			case 4:
				$lightbox['lightbox_top']    = 'false';
				$lightbox['lightbox_bottom'] = 'false';
				$lightbox['lightbox_left']   = '10%';
				$lightbox['lightbox_right']  = 'false';
				break;
			case 5:
				$lightbox['lightbox_top']    = 'false';
				$lightbox['lightbox_bottom'] = 'false';
				$lightbox['lightbox_left']   = 'false';
				$lightbox['lightbox_right']  = 'false';
				break;
			case 6:
				$lightbox['lightbox_top']    = 'false';
				$lightbox['lightbox_bottom'] = 'false';
				$lightbox['lightbox_left']   = 'false';
				$lightbox['lightbox_right']  = '10%';
				break;
			case 7:
				$lightbox['lightbox_top']    = 'false';
				$lightbox['lightbox_bottom'] = '10%';
				$lightbox['lightbox_left']   = '10%';
				$lightbox['lightbox_right']  = 'false';
				break;
			case 8:
				$lightbox['lightbox_top']    = 'false';
				$lightbox['lightbox_bottom'] = '10%';
				$lightbox['lightbox_left']   = 'false';
				$lightbox['lightbox_right']  = 'false';
				break;
			case 9:
				$lightbox['lightbox_top']    = 'false';
				$lightbox['lightbox_bottom'] = '10%';
				$lightbox['lightbox_left']   = 'false';
				$lightbox['lightbox_right']  = '10%';
				break;
		}


		wp_localize_script( 'front-end-js-'.$view_slug, 'param_obj', $portfolio_param );
		wp_localize_script( 'jquery.pcolorbox-js', 'lightbox_obj', $lightbox );
		?>

		<?php
	}
}

new Portfolio_Gallery_Frontend_Scripts();