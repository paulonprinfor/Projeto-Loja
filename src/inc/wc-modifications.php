<?php 

function fancy_lab_wc_modify () {
	
	add_action( 'woocommerce_before_main_content', 'fancy_lab_open_container', 5 );

	function fancy_lab_open_container(){
		echo '<div class="centered-container">';
	}

	add_action( 'woocommerce_after_main_content', 'fancy_lab_close_container', 5 );
	function fancy_lab_close_container(){
		echo '</div></div>';
	}

	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );


	if(is_shop()) {
		add_action( 'woocommerce_before_main_content', 'woocommerce_get_sidebar', 7 );

		add_action( 'woocommerce_after_shop_loop_item_title', 'the_excerpt', 1 );

	}
}

add_action('wp', 'fancy_lab_wc_modify');