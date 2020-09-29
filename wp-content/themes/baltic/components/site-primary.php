<?php
/**
 * Site primary
 *
 * @package Baltic
 */
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">

	<?php
	if( is_singular() ) {
		get_template_part( 'components/loop', 'singular' );
	} else {
		get_template_part( 'components/loop', 'index' );
	}
	?>

	</main><!-- #main -->
</div><!-- #primary -->
