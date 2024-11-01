<?php

/**
 * @link              https://vicsothemes.com/
 * @since             1.0.1
 * @package           Vicso_Sale_Countdown_Timer_For_Woocommerce
 *
 * Plugin Name:       VICSO Sale Countdown Timer for WooCommerce
 * Description:       VICSO Sale Countdown Timer for WooCommerce allow you to easily display a countdown counter on the WooCommerce single product page and incitement users to place orders right away.
 * Version:           1.0.1
 * Author:            Victor
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       vicso-timer
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'VICSOTIMER_URL', plugins_url( '/', __FILE__ ) );

/**
 * Currently plugin version.
 */

define( 'VICSO_SALE_COUNTDOWN_TIMER_FOR_WOOCOMMERCE_VERSION', '1.0.0' );

/**
 * Enqueue the plugin's styles.
 */

function vicso_sale_countdown_timer_for_woocommerce_styles() 
	{
		wp_register_style( 'vicso-sale-countdown-timer-styles', VICSOTIMER_URL . 'public/css/vicso-sale-countdown-timer-for-woocommerce-public.css' );
		wp_enqueue_style( 'vicso-sale-countdown-timer-styles' );
	}
add_action( 'wp_enqueue_scripts', 'vicso_sale_countdown_timer_for_woocommerce_styles' );

/**
 * Main plugin function
 */

function vicso_sale_countdown_timer_for_woocommerce() 
	{

		global $product;
		$sale_date = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );

		if ( !empty( $sale_date ) ) {
			?>

			<script>
				let countDownDate = <?php echo $sale_date; ?> * 1000;
				let x = setInterval(function() {
					let now = new Date().getTime();
					let distance = countDownDate - now;

					let days = Math.floor(distance / (1000 * 60 * 60 * 24));
					let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
					let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
					let seconds = Math.floor((distance % (1000 * 60)) / 1000);

					document.getElementById("vicso__day-value").innerHTML = days;
					document.getElementById("vicso__hour-value").innerHTML = hours;
					document.getElementById("vicso__minute-value").innerHTML = minutes;
					document.getElementById("vicso__second-value").innerHTML = seconds;

				}, 1000);
			</script>

			<div id="vicso__conter-wrapper">
				<ul>
					<li class="vicso__data-value-item">
						<span id="vicso__day-value"></span>
						<div class="vicso__data-value-item-description">Days</div>
					</li>
					<li class="vicso__data-value-item">
						<span id="vicso__hour-value"></span>
						<div class="vicso__data-value-item-description">Hours</div>
					</li>
					<li class="vicso__data-value-item">
						<span id="vicso__minute-value"></span>
						<div class="vicso__data-value-item-description">Minutes</div>
					</li>
					<li class="vicso__data-value-item">
						<span id="vicso__second-value"></span>
						<div class="vicso__data-value-item-description">Seconds</div>
					</li>
				</ul>
			</div>

			<?php
		}
	}
add_action( 'woocommerce_before_add_to_cart_form', 'vicso_sale_countdown_timer_for_woocommerce', 20 );
