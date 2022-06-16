<?php

add_theme_support('post-thumbnails');

function load_scripts(){

  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', get_stylesheet_directory_uri() . '/src/js/plugins/jquery.js', false, '2.1.4', true);
    wp_enqueue_script('jquery');
  }

   wp_enqueue_script('plugins', get_stylesheet_directory_uri() . '/dist/plugins.min.js', null, '', true);
  wp_enqueue_script('scripts', get_stylesheet_directory_uri() . '/dist/scripts.min.js', null, '', true);

	wp_enqueue_style( 'styles', get_template_directory_uri() . '/dist/styles.min.css', array(), '1.0', 'all' );
}
add_action( 'wp_enqueue_scripts', 'load_scripts' );

if ( function_exists( 'register_nav_menu' ) ) {
  register_nav_menu( 'menu', 'Menu Principal');
  register_nav_menu( 'footer-menu', 'Menu do Rodapé');
}

add_theme_support('woocommerce', array(
  'thumbnail_image_width'   => 255,
    'single_image_width'    =>  255,
    'product_grid'          => array(
          'default_rows'    => 10,
          'min_rows'        => 5,
          'max_rows'        => 10,
          'default_columns' => 3,
          'min_columns'     => 3,
          'max_columns'     => 3,
  )
));

add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

if ( ! isset( $content_width ) ) {
  $content_width = 600;
}

function get_img_uri() {
  return get_template_directory_uri() . '/src/img';
}


// Função de mostrar banners

function get_banners(){
  global $banners;
  $banner = array();
  $args = array('post_type'=>'banner','post_status'=>'publish','posts_per_page'=>-1);
  
  $banners = new Wp_Query($args);

  while($banners->have_posts()){
      $banners->the_post();
      $banner_image = get_field('banner');
      $banner_responsive = get_field('banner_responsivo');
      $link = get_field('link');
      $banner_link_post = get_field('link_post');
      $banner_link_categoria = get_field('link_categoria');
      $banner_link_personalizado = get_field('link_personalizado');
      $banner_legenda = get_field('legenda');
      $banner_sublegenda = get_field('sublegenda');
      $banner_legenda_pos = get_field('posicao_legenda');
      $banner_legenda_style = get_field('estilo_legenda');
      
      $banner_link = '';
      $html = '<div>';
      if($link){ //verifica se tem link

          if($link == 'post'){
              $banner_link = $banner_link_post;
          }
          elseif($link == 'categoria'){
              $banner_link = get_category_link($banner_link_categoria);
          }
          elseif($link == 'personalizado'){
              $banner_link = $banner_link_personalizado;
          }

          $html .= '<a href="'.$banner_link.'">';
      }
      $html .= '<div class="banner-item">';

      $html .=    '<img src="'.$banner_image['url'].'" alt="'.get_the_title().'">';

      if ($banner_legenda) { //verifica se tem legenda 
          $html .= '<div class="legenda '.$banner_legenda_pos .'">
                      <div class="legenda-inner">
                          <h1 class="'.$banner_legenda_style.'"><span>'.$banner_legenda.'</span></h1>
                          <h4 class="'.$banner_legenda_style.'">'. $banner_sublegenda .'</h4>
                          <div class="banner-btn">Saiba mais</div>
                      </div>
                  </div>';
                }

      $html .= '</div>';

      if($link){ //fecha a tag de link
          $html .= '</a>';
          $banner_link = '';
      }

      $html .= '</div>';

     echo $html;
  }
  wp_reset_postdata();
}
