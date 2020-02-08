<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div id="page_content" class="home" role="main">
	<section class="section-home__cover">
		<?php echo wp_get_attachment_image(get_field('cover_bg'), 'full'); ?>
		<div class="section-home__cover-content d-flex align-items-end justify-content-center">
			<div class="section-home__cover-content-inner">
				<?php the_field('cover_content'); ?>
			</div>
		</div>
	</section>
	<section class="section-home__about">
		<div class="container">
			<div class="row">
				<div class="col-xl-3 col-lg-4 col-md-5">
					<h2><?php the_field('about_title'); ?></h2>
				</div>
				<div class="col-xl-9 col-lg-8 col-md-7">
					<div class="entry">
						<?php the_field('about_content'); ?>
					</div>
					
					<?php if( have_rows('about_links') ):
						echo '<div class="links d-flex">';
						    while ( have_rows('about_links') ) : the_row();
								$link_text  = get_sub_field('text');
								$link  		= get_sub_field('link');
						    	echo "<a href='{$link['url']}' title='{$link['title']}' class='readmore'>{$link_text}</a>";
						    endwhile;
						echo '</div>';
					endif; ?>
					
				</div>
			</div>
		</div>
	</section>
	<section class="section-home__services">
		<div class="container">
			<div class="section__title border-top border-bottom d-flex justify-content-between align-items-center">
				<h2 class="m-0"><?php the_field('services_title'); ?></h2>
			</div>
			<?php if( have_rows('services_icons') ):
				echo '<div class="row">';
				while ( have_rows('services_icons') ) : the_row();
					
					$icon_id = get_sub_field('icon');
					$icon = wp_get_attachment_image($icon_id, 'full');
					$title = get_sub_field('title');
					$link = get_sub_field('link');
					
					echo "<div class='col text-center section-home__services-icon-col'><a href='{$link['url']}' title='{$link['title']}'><span class='icon d-flex justify-content-center align-items-center'>{$icon}</span><h3 class='h4 m-0'>{$title}</h3></a></div>";
				
				endwhile;
				echo '</div>';
			endif; ?>
		</div>
	</section>

	<section class="section-home__spec">
		<div class="container">
			<div class="section__title border-top border-bottom d-flex justify-content-between align-items-center">
				<h2 class="m-0"><?php the_field('spec_title'); ?></h2>
				<?php
				$link_text  = get_field('spec_more');
				$link  		= get_field('spec_more_link');
				echo "<a href='{$link['url']}' title='{$link['title']}' class='readmore'>{$link_text}</a>";
				?>
			</div>
		</div>
	</section>
	<?php the_content(); ?>
</div>

<?php endwhile; else : ?>
    <p><?php _e( 'Sorry, no pages matched your criteria.', 'cs' ); ?></p>
<?php endif; ?>


<?php get_footer(); ?>
