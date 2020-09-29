<?php
/**
 * Page Header
 *
 * @package Baltic
 */
?>

<div id="page-header" class="page-header">
	<div class="container">
		<div class="page-header-inner">
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

				<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>

			<?php endif; ?>

			<?php
				/**
				 * woocommerce_archive_description hook.
				 *
				 * @hooked woocommerce_taxonomy_archive_description - 10
				 * @hooked woocommerce_product_archive_description - 10
				 */
				do_action( 'woocommerce_archive_description' );
			?>
		</div><!-- .page-header-inner -->
	</div><!-- .container -->
</div><!-- #page-header -->
