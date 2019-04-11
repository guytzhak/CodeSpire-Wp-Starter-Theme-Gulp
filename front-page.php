<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


    <div id="page_content" class="home" role="main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="inner_content">
                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endwhile; else : ?>
    <p><?php _e( 'Sorry, no pages matched your criteria.', 'cs' ); ?></p>
<?php endif; ?>


<?php get_footer(); ?>
