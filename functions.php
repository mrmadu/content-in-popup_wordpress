/* Регистрация скрипта functions.js */

add_action( 'wp_enqueue_scripts', 'theme_register_scripts', 1 );

function theme_register_scripts() {
 
  /** Register JavaScript Functions File */
  wp_register_script( 'functions-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'functions.js' ), array( 'jquery' ), '1.0', true );
 
  /** Localize Scripts */
  $php_array = array( 'admin_ajax' => admin_url( 'admin-ajax.php' ) );
  wp_localize_script( 'functions-js', 'php_array', $php_array );
 
}
 
/** Enqueue Scripts. */
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );
function theme_enqueue_scripts() {
 
  /** Enqueue JavaScript Functions File */
  wp_enqueue_script( 'functions-js' );
 
}

/* Ajax Post */
add_action( 'wp_ajax_theme_post_example', 'theme_post_example_init' );
add_action( 'wp_ajax_nopriv_theme_post_example', 'theme_post_example_init' );

function theme_post_example_init() {

/* Made Query */
$args = array( 'p' => $_POST['id'] );
$theme_post_query = new WP_Query( $args );
while( $theme_post_query->have_posts() ) : $theme_post_query->the_post();
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'has_post_thumbnail' );
$url = $thumb['0']; ?>
<div style="overflow: hidden;"><div id="post-div-pic" style="background-image: url(<?=$url?>);"><img src="<?=$url?>" width="100%" height="auto"></div></div>
<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<div class="entry-content"><?php the_content(); ?></div><!-- end .entry-content -->
</div>
<?php
endwhile;
exit;
}
