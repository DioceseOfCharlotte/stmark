<?php
/**
 * Template Name: SMCS Form Wide
 * Template Post Type: post, page, gravityview, registration_pages, smcs_athletics
 * A template for a basic page with forms.
 *
 * @package Avada
 * @subpackage Templates
 */

?>

<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php get_header(); ?>
<section id="content" class="full-width smcs-form smcs-form-wide">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php echo fusion_render_rich_snippets_for_pages(); // WPCS: XSS ok. ?>
			<?php avada_featured_images_for_pages(); ?>
			<div class="post-content smcs-content smcs-content-wide">
				<?php the_content(); ?>
			</div>
		</div>
	<?php endwhile; ?>
</section>
<?php
get_footer();
