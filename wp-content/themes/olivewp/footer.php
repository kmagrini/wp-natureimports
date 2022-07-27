<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package OliveWP Theme
 */



if ( ! function_exists( 'olivewp_plus_activate' ) ) {
    do_action( 'olivewp_footer_widgets' );
    do_action('olivewp_scrolltotop');
}
else {
    do_action('olivewp_plus_footer_widgets');
    do_action('olivewp_plus_scrolltotop');
}
wp_footer(); ?>

</body>
</html>
