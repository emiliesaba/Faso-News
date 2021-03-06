<?php
/**
 * The template part for displaying Nothing Found message
 *
 * @package Voyage
 * @subpackage voyage
 * @since Voyage 1.0.5
 */
?>
<article id="post-0" class="post hentry no-results not-found">
	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'Nothing Found', 'voyage' ); ?></h1>
	</header>

	<div class="entry-content">
		<?php if ( is_home() ) { ?>
			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'voyage' ), admin_url( 'post-new.php' ) ); ?></p>
		<?php } else { ?>
			<?php if ( is_search() ) { ?> 
				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'voyage' ); ?></p>
			<?php } else { ?>
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'voyage' ); ?></p>
			<?php } ?>
				<?php get_search_form(); ?>
<script type="text/javascript">
	document.getElementById('s') && document.getElementById('s').focus();
</script>
		<?php } ?>
	</div>
</article>
